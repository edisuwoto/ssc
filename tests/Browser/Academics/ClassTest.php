<?php

namespace Tests\Browser\Academics;

use App\User;
use App\SmClass;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ClassTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginTest()
    {
        $this->browse(function (Browser $browser) {
            $browser
                    // ->visit('logout')
                    ->visit('/login')
                    ->type('email','admin@infixedu.com')
                    ->type('password','123456')
                    ->click('#btnsubmit')
                    ->waitForText('Welcome')
                    ->assertSee('Welcome');
        });
    }
    public function testAddClass(){

        $this->browse(function (Browser $browser) {
            $browser
                     ->loginAs(User::find(1))
                    ->visit('class')
                    ->type('name','1')
                    ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-30 > div > div:nth-child(3) > label')
                    ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-30 > div > div:nth-child(4) > label')
                  
                    ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                                    
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
                   
        });
    }

    public function testAddClassTwo(){

        $this->browse(function (Browser $browser) {
            $browser
                    ->loginAs(User::find(1))
                    ->visit('class')
                    ->type('name','2')
                    ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-30 > div > div:nth-child(3) > label')
                    ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                                    
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
                   
        });
    }

    public function testAddClassThree(){

        $this->browse(function (Browser $browser) {
            $browser
                     ->loginAs(User::find(1))
                    ->visit('class')
                    ->type('name','3')
                    ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-30 > div > div:nth-child(3) > label')
                    ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                                    
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
                   
        });
    }

    public function testClassEditOne(){
        $this->browse(function (Browser $browser){
            $browser
            ->loginAs(User::find(1))
             ->visit('class')
             ->click('#table_id > tbody > tr:nth-child(1) > td:nth-child(3) > div > button')
             ->pause(2000)
             ->click('#table_id > tbody > tr:nth-child(1) > td:nth-child(3) > div > div > a:nth-child(1)')
             ->assertSee('Edit Class') 
             ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div:nth-child(2) > div.col-lg-3 > div > div > form > div > div > div.row.mt-30 > div > div:nth-child(5) > label')    
             ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div:nth-child(2) > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
             ->waitFor('.toast-message',5)
             ->assertSee('Operation successful');
            });
    }

    public function testClassDelete(){
        $this->browse(function (Browser $browser){
            $class_id=SmClass::latest()->first();
            $browser
                 ->loginAs(User::find(1))
                ->visit('class')
                ->click('#table_id > tbody > tr:nth-child(3) > td:nth-child(3) > div > button')    
                ->pause(2000)        
                ->click('#table_id > tbody > tr:nth-child(3) > td:nth-child(3) > div > div > a:nth-child(2)')               
                ->whenAvailable('#deleteClassModal'.$class_id->id.' > div > div > div.modal-body', function ($modal) {
                    $modal
                 ->click('div.mt-40.d-flex.justify-content-between > a > button')
                 ->assertPathIs('/class');
                 })
                 
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
              
        });
    }
}
