<?php

namespace Tests\Browser\StudentInfo;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DisableStudentTest extends DuskTestCase
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

    
    public function testDeleteDisabledStudentTest()
    {
        $this->browse(function (Browser $browser) {
            $browser
                    // ->visit('logout')
                    ->visit('disabled-student')
                    ->click('#main-content > section.admin-visitor-area.up_admin_visitor.full_wide_table > div > form > div > div > div > div > div:nth-child(2) > div')
                    ->click('#main-content > section.admin-visitor-area.up_admin_visitor.full_wide_table > div > form > div > div > div > div > div:nth-child(2) > div > ul > li:nth-child(2)')
                    ->click('#main-content > section.admin-visitor-area.up_admin_visitor.full_wide_table > div > form > div > div > div > div > div.col-lg-12.mt-20.text-right > button')
                    ->click('#table_id > tbody > tr > td.sorting_1')
                    ->pause(1000)
                    ->click('#table_id > tbody > tr.child > td > ul > li > span.dtr-data > div > button')
                    ->click('#table_id > tbody > tr.child > td > ul > li > span.dtr-data > div > div > a:nth-child(2)')
                    ->whenAvailable('#deleteStudentModal > div > div > div.modal-body',function($modal){
                        $modal
                        ->click('div.mt-40.d-flex.justify-content-between > form > button')
                        ->assertpathIs('/disabled-student');
                    })
                
                    ->waitFor('.toast-message',5)
                    ->assertSee('Operation successful');
        });
    }
    public function testEnableDisabledStudentTest()
    {
        $this->browse(function (Browser $browser) {
            $browser
                    // ->visit('logout')
                    ->visit('disabled-student')
                    ->click('#main-content > section.admin-visitor-area.up_admin_visitor.full_wide_table > div > form > div > div > div > div > div:nth-child(2) > div')
                    ->click('#main-content > section.admin-visitor-area.up_admin_visitor.full_wide_table > div > form > div > div > div > div > div:nth-child(2) > div > ul > li:nth-child(2)')
                    ->click('#main-content > section.admin-visitor-area.up_admin_visitor.full_wide_table > div > form > div > div > div > div > div.col-lg-12.mt-20.text-right > button')
                    ->click('#table_id > tbody > tr > td.sorting_1')
                    ->pause(1000)
                    ->click('#table_id > tbody > tr.child > td > ul > li > span.dtr-data > div > button')
                    ->click('#table_id > tbody > tr.child > td > ul > li > span.dtr-data > div > div > a:nth-child(3)')
                    ->whenAvailable('#enableStudentModal > div > div > div.modal-body',function($modal){
                        $modal
                        ->click('div.mt-40.d-flex.justify-content-between > form > button')
                        ->assertpathIs('/disabled-student');
                    })
              
                    ->waitFor('.toast-message',5)
                    ->assertSee('Operation successful');
        });
    }
}
