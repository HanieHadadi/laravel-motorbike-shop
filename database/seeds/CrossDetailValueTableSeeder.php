<?php

use Illuminate\Database\Seeder;

class CrossDetailValueTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cross_detail_value')->delete();
        
        \DB::table('cross_detail_value')->insert(array (
            0 => 
            array (
                'id' => 1,
                'detail_value_id' => 1,
                'detail_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'detail_value_id' => 2,
                'detail_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'detail_value_id' => 3,
                'detail_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}