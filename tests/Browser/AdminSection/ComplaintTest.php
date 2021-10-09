<?php

namespace Tests\Browser\AdminSection;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Components\DatePicker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ComplaintTest extends DuskTestCase
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

    public function testAddNewComplaint(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('complaint')
            ->type('complaint_by','visitor')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(3) > div > div')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(3) > div > div > ul > li:nth-child(2)')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(4) > div > div')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(4) > div > div > ul > li:nth-child(2)')
            ->type('phone','31094831')

            // ->within(new DatePicker, function ($browser) {
            //     $browser->selectDate(2021, 7, 10);
            // })
            ->type('assigned','nayem')
            ->type('description','visit to nayem')
            ->attach('file',public_path('/uploads/visitor/staff.jpg'))
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }
}
