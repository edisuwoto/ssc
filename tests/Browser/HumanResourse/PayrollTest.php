<?php

namespace Tests\Browser\HumanResourse;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PayrollTest extends DuskTestCase
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


    public function testStaffAttendanceReprot(){
        $this->browser(function (Browser $browser){
            $browser
            ->visit('payroll')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div:nth-child(2) > div > div > form > div > div:nth-child(1) > div')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div:nth-child(2) > div > div > form > div > div.col-lg-12.mt-20.text-right > button')
            ->click('#search_student > div > div.col-lg-12.mt-20.text-right > button')
            ->assertPathIs('/payroll')            
            ->click('#table_id > tbody > tr > td:nth-child(8) > div > button')
            ->click('#table_id > tbody > tr > td:nth-child(8) > div > div > a')
             ->click('#main-content > form > section > div > div > div:nth-child(1) > div.d-flex.justify-content-between.mb-20 > div:nth-child(2) > button')
             ->type('earningsType','test1')
             ->type('earningsValue','100')
             ->click('#row2 > td.pt-30 > button')
             ->click('#main-content > form > section > div > div > div:nth-child(2) > div.d-flex.justify-content-between.mb-20 > div:nth-child(2) > button')
             ->type('deductionstype','detest')
             ->type('deductionsValue','200')
            ->click('#main-content > form > section > div > div > div:nth-child(3) > div.d-flex.justify-content-between.mb-20 > div:nth-child(2) > button')
            ->click('#main-content > form > section > div > div > div:nth-child(3) > div.col-lg-12.mt-20.text-right > button');

        });
    }
}
