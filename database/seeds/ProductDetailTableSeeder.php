<?php

use Illuminate\Database\Seeder;

class ProductDetailTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_detail')->delete();
        
        \DB::table('product_detail')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'سایز',
                'created_at' => '2017-01-27 17:32:20',
                'updated_at' => '2017-01-27 17:32:20',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'رنگ',
                'created_at' => '2017-01-27 18:48:45',
                'updated_at' => '2017-01-27 18:48:45',
            ),
        ));
        
        
    }
}