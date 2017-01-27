<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductDetailValueTest extends TestCase
{
    use DatabaseMigrations;

    public  function testRegisterNewValue(){
        $this->call('POST', '/detailValue',array('value'=>'tested_value','detail'=>1));
        $this->assertSessionMissing('errors');
    }

}
