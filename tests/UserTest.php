<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function testisAdmin(){
         $user =  App\User::find(1);
         $this->assertTrue($user->isAdmin());
         $user =  App\User::find(2);
         $this->assertFalse($user->isAdmin());

    }


}
