<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductDetailTest extends TestCase
{


    public  function testRegisterNewDetail(){
        $this->call('POST', '/detail',array('title'=>'tested_detail'));
        $this->assertSessionMissing('errors');
    }
    public function testFindEachDetail(){
        $this->call('POST', '/eachDetailVal',array('detail'=>1));
        $this->assertSessionMissing('errors');
    }

}
