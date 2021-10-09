<?php

namespace Tests\Browser\AdminSection;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminSetUpTest extends DuskTestCase
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
                    ->assertSee('dashboard');
        });
    }

    public function testAddNewPurPoseType(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('setup-admin')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(1) > div > div')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(1) > div > div > ul > li:nth-child(2)')          
            ->type('name','visit&admission')
            ->type('description','Social media')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

    
    public function testAddNewComplainType(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('setup-admin')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(1) > div > div')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(1) > div > div > ul > li:nth-child(3)')          
            ->type('name','studentbe')
            ->type('description','Social media')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

    
    public function testAddNewSourceType(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('setup-admin')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(1) > div > div')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(1) > div > div > ul > li:nth-child(4)')          
            ->type('name','google')
            ->type('description','Social media')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

    
    public function testAddNewReferenaceType(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('setup-admin')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(1) > div > div')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(1) > div > div > ul > li:nth-child(5)')          
            ->type('name','Admin')
            ->type('description','Admin')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }
    
    // public function testEAddNewType(){
    //     $this->browse(function (Browser $browser){
    //         $browser
    //         ->visit('setup-admin')
    //         ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-9 > div.row.base-setup.mt-30 > div > div > div > div:nth-child(1) > div > div.permission_header.d-flex.align-items-center.justify-content-between > div.arrow.collapsed')
    //         ->click('#Role1 > div > ul > li > ul > li > div > div > button')
    //         ->click('#Role1 > div > ul > li > ul > li > div > div > div > a:nth-child(1)')        
    //         ->select('type','3')
    //         ->type('name','Social Media')
    //         ->type('description','Social media')
    //         ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div:nth-child(2) > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
    //         ->waitFor('.toast-message',5)
    //         ->assertSee('Operation successful');
    //     });
    // }


}
