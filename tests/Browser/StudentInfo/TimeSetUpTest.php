<?php

namespace Tests\Browser\StudentInfo;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TimeSetUpTest extends DuskTestCase
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

    public function testAddTimeStup(){
        $this->browse(function (Browser $browser) {
            $browser
            ->visit('studentabsentnotification')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div:nth-child(1) > div.col-lg-2 > a')
            ->pause(8000)
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div.row.mt-20 > div.col-lg-3 > div > div > form > div > div > div:nth-child(1) > div.col > div > input')
            ->pause(2000)
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div.row.mt-20 > div.col-lg-3 > div > div > form > div > div > div:nth-child(3) > div > div')
            ->pause(1000)
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div.row.mt-20 > div.col-lg-3 > div > div > form > div > div > div:nth-child(3) > div > div > ul > li:nth-child(2)')
            ->click('')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div.row.mt-20 > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

    public function testAddTimeStup2nd(){
        $this->browse(function (Browser $browser) {
            $browser
            ->visit('studentabsentnotification')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div.row.mt-20 > div.col-lg-3 > div > div > form > div > div > div:nth-child(1) > div.col > div > input')
            ->pause(2000)
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div.row.mt-20 > div.col-lg-3 > div > div > form > div > div > div:nth-child(3) > div > div')
            ->pause(1000)
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div.row.mt-20 > div.col-lg-3 > div > div > form > div > div > div:nth-child(3) > div > div > ul > li:nth-child(3)')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div.row.mt-20 > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

}
