<?php

namespace Tests\Browser\HumanResourse;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DesignationTest extends DuskTestCase
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
    public function testAddNewDes(){
        $this->browse(function (Browser $browser){
            $browser
                ->visit('designation')
                ->type('title','Professor')
                ->click('#main-content > section.admin-visitor-area.up_admin_visitor.up_st_admin_visitor.pl_22 > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
        });
    }

    public function testEditNewDes(){
        $this->browse(function (Browser $browser){
            $browser
                ->visit('designation')
                ->click('#table_id > tbody > tr:nth-child(3) > td:nth-child(2) > div > button')
                ->click('#table_id > tbody > tr:nth-child(3) > td:nth-child(2) > div > div > a:nth-child(1)')           
                ->type('title','Asoc.Professor')
                ->click('#main-content > section.admin-visitor-area.up_admin_visitor.up_st_admin_visitor.pl_22 > div > div:nth-child(2) > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
        });
    }

    public function testDelete(){
        $this->browse(function (Browser $browser){
            $browser
                    ->visit('designation')
                    ->click('#table_id > tbody > tr:nth-child(3) > td:nth-child(2) > div > button')
                    ->click('#table_id > tbody > tr:nth-child(3) > td:nth-child(2) > div > div > a:nth-child(2)')
                    ->whenAvailable('#deleteDesignationModal2 > div > div > div.modal-body', function ($modal) {
                        $modal
                     ->click('div.mt-40.d-flex.justify-content-between > button.primary-btn.fix-gr-bg')
                     ->assertPathIs('/section');
                     })
                     
                    ->waitFor('.toast-message',5)
                    ->assertSee('Operation successful');
        });
    }

}
