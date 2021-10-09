<?php

namespace Tests\Browser\Academics;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SubjectTest extends DuskTestCase
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


    public function testAddNewOptionalSubject(){
        $this->browse(function (Browser $browser){
            $browser
                ->visit('subject')
                ->type('subject_name','Bangla')     
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(2) > div > div > div:nth-child(1) > label')
                ->type('subject_code','BA123')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(4) > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
        });
    }

    public function testAddNewOptionalEnglishSubject(){
        $this->browse(function (Browser $browser){
            $browser
                ->visit('subject')
                ->type('subject_name','English')     
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(2) > div > div > div:nth-child(1) > label')
                ->type('subject_code','EN123')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(4) > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
        });
    }

    
    public function testAddNewOptionalMATHSubject(){
        $this->browse(function (Browser $browser){
            $browser
                ->visit('subject')
                ->type('subject_name','MATH')     
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(2) > div > div > div:nth-child(1) > label')
                ->type('subject_code','MT123')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(4) > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
        });
    }

    public function testEditSubject(){
        $this->browse(function (Browser $browser){
            $browser
             ->visit('subject')
             ->click('#table_id > tbody > tr > td:nth-child(5) > div > button')
             ->click('#table_id > tbody > tr > td:nth-child(5) > div > div > a:nth-child(1)')
             ->type('subject_name','Bangla')     
             ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div:nth-child(2) > div.col-lg-3 > div > div > form > div > div > div:nth-child(2) > div > div > div:nth-child(1) > label')
             ->type('subject_code','BA423')
             ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div:nth-child(2) > div.col-lg-3 > div > div > form > div > div > div:nth-child(4) > div > button')
             ->waitFor('.toast-message',5)
             ->assertSee('Operation successful');
        });
    }

    public function testDeleteSubject(){
        $this->browse(function (Browser $browser){
            $browser
             ->visit('subject')
             ->click('#table_id > tbody > tr > td:nth-child(5) > div > button')
             ->click('#table_id > tbody > tr > td:nth-child(5) > div > div > a:nth-child(2)')
             ->whenAvailable('#deleteSubjectModal1 > div > div > div.modal-body', function ($modal) {
                $modal
             ->click('div.mt-40.d-flex.justify-content-between > a > button')
             ->assertPathIs('/subject');
             })        
             ->waitFor('.toast-message',5)
             ->assertSee('Operation successful');
        });
    }

}
