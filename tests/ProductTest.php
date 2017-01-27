<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{


    /**
     * @var Int
     */
    public $productValueId = null;

    /**
     *
     */
    public function setUp()
    {

        parent::setUp();

        $productValue = App\ProductDetailValue::find(1);
        if(sizeof($productValue->toArray()) == 0){
            //insert_new_detail and then insert Related value for it
            $this->call('POST', '/detail',array('title'=>'testing_detail'));
            if($this->assertSessionMissing('errors')){
                $inserted_detail = App\ProductDetail::orderBy('create_time','DESC')->get();
                $this->call('POST', '/detailValue',array('detail'=>$inserted_detail->id,'value'=>'testing_value'));
                if($this->assertSessionMissing('errors')){
                    $detail_value_inserted = App\ProductDetailValue::orderBy('create_time','DESC')->get();
                }
            }
        }
        $this->productValueId = $productValue->id;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegisterNewProduct()
    {

        $path = __DIR__.'/file.jpg';
        $newFile = __DIR__.'/'.uniqid().'.jpg';
        file_put_contents($newFile,file_get_contents($path));
        $file = new \Illuminate\Http\UploadedFile($newFile,'file.jpg','image/jpg',filesize($newFile),null,true);
        /* @var $response \Illuminate\Http\Response */
        $response = $this->call('POST', 'insert',array('title'=>'test_characters',
                                                       'image' => $file,
                                                       'description'=>'Lorem ipsum dolor sit amet, sonet assentior eu mea, wisi nemore eirmod an per.',

        ));
        $this->assertSessionMissing('errors');
        $this->assertTrue($response->isRedirect('http://localhost'));
    }
    public function testIndex()
    {

        $res = $this->call('GET', '/');
        $this->assertResponseOk();
        $this->assertViewHas('allProduct');
        $this->assertViewHas('details');
        $this->assertViewHas('getArray');
        $lastProductOnView = $res->original['allProduct'];
        $this->assertLessThan(7,count($lastProductOnView));
    }

    public function testPermission(){
        $user = App\User::find(1);
        $this->be($user);
        $this->call('GET', 'insert');
        $this->assertViewHas('all_product_details');
        $this->assertViewHas('all_detail_values');

        $user = App\User::find(2);
        $this->be($user);
        $res = $this->call('GET', 'insert');
        $this->assertTrue($res->isRedirect('http://localhost'));

    }

    /**
     * @dataProvider providerTestSearch
     */
    public function testSearch($testCase){

        $res = $this->call('GET', 'search',$testCase);
        $this->assertViewHas('allProduct');
        $this->assertViewHas('getArray');
        $this->assertViewHas('details');
        $lastProductOnView = $res->original['allProduct'];
        $this->assertLessThan(7,count($lastProductOnView));

    }



    public function providerTestSearch()
    {
        return array(
            array(array('filter'=>'price','sort'=>'ASC')),
            array(array('filter'=>'price','sort'=>'DESC')),
            array(array('filter'=>'time','sort'=>'DESC')),
            array(array('filter'=>'time','sort'=>'ASC')),
            array(array('filter'=>'time','sort'=>'DESC','value-1'=>'')),
            array(array('filter'=>'time','sort'=>'ASC','value-1'=>'')),
            array(array('filter'=>'price','sort'=>'ASC','value-1'=>'')),
            array(array('filter'=>'price','sort'=>'DESC','value-1'=>'')),
            array(array()),
        );
    }
    public  function testShow(){
        $this->call('get', 'show/kwgxzbkymr');
        $this->assertViewHas('product');
        $this->assertViewHas('productDetailWithValues');
        $response = $this->call('GET', 'show',array());
        $this->assertEquals(404, $response->status());

    }
}


