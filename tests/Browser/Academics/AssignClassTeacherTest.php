<?php

namespace Tests\Browser\Academics;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AssignClassTeacherTest extends DuskTestCase
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
    public function testAssignClassTeacher(){
        $this->browse(function (Browser $browser){
            $browser
                ->visit('assign-class-teacher')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(1) > div > div')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(1) > div > div > ul > li:nth-child(2)')
                ->pause(8000)
                ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control')
                ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.open > ul > li:nth-child(2)')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(4) > div > div:nth-child(3) > label')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(5) > div > button')             
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');


        });
    }

    public function testAssignClassTeacherDelete(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('assign-class-teacher')
            ->click('#table_id > tbody > tr > td:nth-child(4) > div > button')
            ->click('#table_id > tbody > tr > td:nth-child(4) > div > div > a:nth-child(2)')
            ->whenAvailable('#deleteClassModal1 > div > div > div.modal-body',function($modal){
                $modal
                ->click('div.mt-40.d-flex.justify-content-between > button.primary-btn.fix-gr-bg')
                ->assertPathIs('/assign-class-teacher');
            })
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }
    public function testAgainAssignClassTeacher(){
        $this->testAssignClassTeacher();
    }

    
}
