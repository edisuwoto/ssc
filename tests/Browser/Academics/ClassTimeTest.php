<?php

namespace Tests\Browser\Academics;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ClassTimeTest extends DuskTestCase
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

    public function testAddnewClassTime(){
        $this->browse(function (Browser $browser){
            $browser
                ->visit('class-time')
                // ->script("$('.time').removeClass('time')")
                ->type('period','1st')
                ->pause(4000) 
                 ->type('start_time','6:00 AM')
                
                // ->type('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(3) > div.col > div > input','10:20 PM')
                ->pause(4000)
                ->type('end_time','7:00 AM')
                // ->type('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(4) > div.col > div > input','9:31 PM')        
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
        });
    }

    // public function testAddnewClassTime2nd(){
    //     $this->browse(function (Browser $browser){
    //         $browser
    //             ->visit('class-time')
    //             // ->script("$('.time').removeClass('time')")
    //             ->type('period','2nd')
    //             ->pause(4000) 
    //              ->type('start_time','10:05 AM')
                
    //             // ->type('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(3) > div.col > div > input','10:20 PM')
    //             ->pause(4000)
    //             ->type('end_time','10:50 AM')
    //             // ->type('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(4) > div.col > div > input','9:31 PM')        
    //             ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
    //             ->waitFor('.toast-message',5)
    //             ->assertSee('Operation successful');
    //     });
    // }
    // public function testAddnewClassTime3nd(){
    //     $this->browse(function (Browser $browser){
    //         $browser
    //             ->visit('class-time')
    //             // ->script("$('.time').removeClass('time')")
    //             ->type('period','3rd')
    //             ->pause(4000) 
    //              ->type('start_time','10:05 AM')
                
    //             // ->type('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(3) > div.col > div > input','10:20 PM')
    //             ->pause(4000)
    //             ->type('end_time','10:50 AM')
    //             // ->type('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(4) > div.col > div > input','9:31 PM')        
    //             ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
    //             ->waitFor('.toast-message',5)
    //             ->assertSee('Operation successful');
    //     });
    // }
    // public function testAddnewClassTimeIsBreak(){
    //     $this->browse(function (Browser $browser){
    //         $browser
    //             ->visit('class-time')
    //             ->type('period','3rd')
    //             ->pause(4000)
    //             ->type('start_time','8:31 PM')
    //             ->pause(4000)
    //             ->type('end_time','9:31 PM')
    //             ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-15 > div > div > label')
    //             ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
    //             ->waitFor('.toast-message',5)
    //             ->assertSee('Operation successful');
    //     });
    // }

    // public function testClassTimeEdit(){
    //     $this->browse(function(Browser $browser){
    //         $browser
    //         ->visit('class-time')
    //         ->click('#table_id > tbody > tr.even > td:nth-child(5) > div > button')
    //         ->pause(1000)
    //         ->click('#table_id > tbody > tr.even > td:nth-child(5) > div > div > a:nth-child(1)')
    //         ->assertSee('Edit Class Time')
    //         ->pause(1000)
    //         ->type('start_time','10:31 AM')
    //         ->pause(1000)
    //         ->type('end_time','11:31 AM')
    //         ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div:nth-child(2) > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
    //         ->waitFor('.toast-message',5)
    //         ->assertSee('Operation successful');
    //     });
    // }





}
