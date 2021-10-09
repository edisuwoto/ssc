<?php

namespace Tests\Browser\HumanResourse;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PayrollReprotTest extends DuskTestCase
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
    public function testPlayrollReprot(){
        $this->browse(function (Browser $browser) {
            $browser
            
            ->loginAs(User::find(1))
            ->visit('payroll-report')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div:nth-child(2) > div > div > form > div > div:nth-child(1) > div')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div:nth-child(2) > div > div > form > div > div:nth-child(1) > div > ul > li:nth-child(7)')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div:nth-child(2) > div > div > form > div > div.col-lg-12.mt-20.text-right > button')
            ->assertSee('Payroll Report');

           
        });
    }
}
