<?php

use Illuminate\Database\Seeder;

class PriceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('price')->delete();
        
        \DB::table('price')->insert(array (
            0 => 
            array (
                'id' => 1,
                'real_price' => 322000,
                'discount' => 0,
                'created_at' => '2017-01-27 17:33:43',
                'updated_at' => '2017-01-27 17:33:43',
            ),
            1 => 
            array (
                'id' => 2,
                'real_price' => 315000,
                'discount' => 0,
                'created_at' => '2017-01-27 17:39:53',
                'updated_at' => '2017-01-27 17:39:53',
            ),
            2 => 
            array (
                'id' => 3,
                'real_price' => 410000,
                'discount' => 0,
                'created_at' => '2017-01-27 17:47:51',
                'updated_at' => '2017-01-27 17:47:51',
            ),
            3 => 
            array (
                'id' => 4,
                'real_price' => 800000,
                'discount' => 0,
                'created_at' => '2017-01-27 18:48:16',
                'updated_at' => '2017-01-27 18:48:16',
            ),
            4 => 
            array (
                'id' => 5,
                'real_price' => 100000,
                'discount' => 0,
                'created_at' => '2017-01-27 18:50:57',
                'updated_at' => '2017-01-27 18:50:57',
            ),
            5 => 
            array (
                'id' => 6,
                'real_price' => 900000,
                'discount' => 0,
                'created_at' => '2017-01-27 18:52:48',
                'updated_at' => '2017-01-27 18:52:48',
            ),
            6 => 
            array (
                'id' => 7,
                'real_price' => 9200000,
                'discount' => 0,
                'created_at' => '2017-01-27 18:56:43',
                'updated_at' => '2017-01-27 18:56:43',
            ),
        ));
        
        
    }
}