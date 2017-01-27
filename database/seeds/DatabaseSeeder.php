<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(ProductDetailValueTableSeeder::class);
        $this->call(ProductDetailTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(PriceTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(CrossUserRoleTableSeeder::class);
        $this->call(CrossProductPriceTableSeeder::class);
        $this->call(CrossProductDetailValueTableSeeder::class);
        $this->call(CrossDetailValueTableSeeder::class);
    }
}
