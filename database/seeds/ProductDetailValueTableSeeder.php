<?php

use Illuminate\Database\Seeder;

class ProductDetailValueTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_detail_value')->delete();
        
        \DB::table('product_detail_value')->insert(array (
            0 => 
            array (
                'id' => 1,
                'value' => '16',
                'created_at' => '2017-01-27 17:32:27',
                'updated_at' => '2017-01-27 17:32:27',
            ),
            1 => 
            array (
                'id' => 2,
                'value' => '12',
                'created_at' => '2017-01-27 17:32:32',
                'updated_at' => '2017-01-27 17:32:32',
            ),
            2 => 
            array (
                'id' => 3,
                'value' => 'صورتی',
                'created_at' => '2017-01-27 18:48:54',
                'updated_at' => '2017-01-27 18:48:54',
            ),
        ));
        
        
    }
}