<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('Users')->delete();
        
        \DB::table('Users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@bike.com',
                'password' => '$2y$10$Djtc.TdT2R8KYKAgDIQ/Hex5LzlyLWpk4vra8NV/TVZIJgqIA1Ay6',
                'remember_token' => '9Th4IVvFFKMepbDXisl6Wo8iGwKd27nScUbokrsCFexKaOu4mmKEPeEZM9Bd',
                'created_at' => '2017-01-27 17:27:48',
                'updated_at' => '2017-01-27 21:23:20',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'simpleUser',
                'email' => 'simpleUser@bike.com',
                'password' => '$2y$10$vAS1qbbPemRUB6ifsSciCOaYQt2/yuvHyvctVcMRl7.P1S1mMYHF.',
                'remember_token' => NULL,
                'created_at' => '2017-01-27 21:23:45',
                'updated_at' => '2017-01-27 21:23:45',
            ),
        ));
        
        
    }
}