<?php

namespace Tests\Browser\AdminSection;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PostalDispatchTest extends DuskTestCase
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
            ->visit('postal-dispatch')
            ->type('to_title','visitor')
            ->type('reference_no','12312')
            ->type('address','narsigndi')
            ->type('note','no comments')
            ->type('from_title','Yeho')  
            
            ->attach('file',public_path('/uploads/visitor/staff.jpg'))
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }
    public function testEditComplaint(){
        $this->browse(function (Browser $browser){
            $browser
                ->visit('postal-dispatch')
                ->click('#table_id > tbody > tr > td:nth-child(7) > div > button')  
                 ->click('#table_id > tbody > tr > td:nth-child(7) > div > div > a:nth-child(1)')
                 ->type('to_title','Edit visitor')
                 ->type('reference_no','12312')
                 ->type('address','narsigndi')
                 ->type('note','no comments')
                 ->type('from_title','Yeho')                   
                 ->waitFor('.toast-message',5)
                 ->assertSee('Operation successful');

                });
     }

}
