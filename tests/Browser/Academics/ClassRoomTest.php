<?php

namespace Tests\Browser\Academics;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ClassRoomTest extends DuskTestCase
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

    public function testNewClassRoom(){
        $this->browse(function (Browser $browser){
            $browser
                ->visit('class-room')
                ->type('room_no','109')
                ->type('capacity','30')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(3) > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
        });
    }

    public function testEditClassRoom(){
        $this->browse(function (Browser $browser){
            $browser
                ->visit('class-room')
                ->click('#table_id > tbody > tr.even > td:nth-child(3) > div > button')
                ->click('#table_id > tbody > tr.even > td:nth-child(3) > div > div > a:nth-child(1)')
                ->type('room_no','108')
                ->type('capacity','30')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div:nth-child(2) > div.col-lg-3 > div > div > form > div > div > div:nth-child(3) > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
        });
    }

    public function testDeleteteClassRoom(){
        $this->browse(function (Browser $browser){
            $browser
                ->visit('class-room')
                ->click('#table_id > tbody > tr:nth-child(3) > td:nth-child(3) > div > button')
                ->click('#table_id > tbody > tr:nth-child(3) > td:nth-child(3) > div > div > a:nth-child(2)')
                ->whenAvailable('#deleteClassModal4 > div > div > div.modal-body',function($modal){
                    $modal
                    ->click('div.mt-40.d-flex.justify-content-between > button.primary-btn.fix-gr-bg')
                    ->assertPathIs('/class-room');
                })
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
        });
    }
}
