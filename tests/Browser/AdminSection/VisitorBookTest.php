<?php

namespace Tests\Browser\AdminSection;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Components\DatePicker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class VisitorBookTest extends DuskTestCase
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

    public function testAddVisitor(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('visitor')
            ->type('name','visit')
            ->type('phone','visit')
            ->type('visitor_id','123112')
            ->type('no_of_person','2')
            ->within(new DatePicker, function ($browser) {
                $browser->selectDate(2021, 7, 10);
            })
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

 
}
