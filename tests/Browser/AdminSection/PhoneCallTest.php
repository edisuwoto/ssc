<?php

namespace Tests\Browser\AdminSection;

use App\SmPhoneCallLog;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PhoneCallTest extends DuskTestCase
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

    public function testAddNewPhoneCall(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('phone-call')
            ->type('name','2nd test')
            ->type('phone','12312')
            ->type('call_duration','10')
            ->type('description','no comments')          
            ->radio('call_type','I')  
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->assertPathIs('/phone-call')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

    public function testEditPhoneCall(){
      
        $this->browse(function (Browser $browser){
            $phoneCall=SmPhoneCallLog::first();
            $browser
            ->visit('phone-call')
            ->click('#table_id > tbody > tr.child > td > ul > li:nth-child(2) > span.dtr-data > div > button')
            ->click('#table_id > tbody > tr.child > td > ul > li:nth-child(2) > span.dtr-data > div > div > a:nth-child(1)')
            ->assertPathIs('/phone-call/'.$phoneCall->id)      
            ->type('name','update test')
            ->type('phone','12312')
            ->type('call_duration','10')
            ->type('description','no comments')          
            ->radio('call_type','I')  
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

    public function testDeletePhoneCall(){
     
        $this->browse(function (Browser $browser){
            $browser
            ->visit('phone-call')
            ->click('#table_id > tbody > tr.child > td > ul > li:nth-child(2) > span.dtr-data > div > button')
            ->click('#table_id > tbody > tr.child > td > ul > li:nth-child(2) > span.dtr-data > div > div > a:nth-child(2)')
            ->whenAvailable('#deleteCallLogModal1 > div > div > div.modal-body',function($madal){
                $modal
                ->click('div.mt-40.d-flex.justify-content-between > button.primary-btn.fix-gr-bg')
                ->assertPathIs('/phone-call');
                
            })
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');

        });
    }
}
