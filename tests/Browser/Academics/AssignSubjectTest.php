<?php

namespace Tests\Browser\Academics;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AssignSubjectTest extends DuskTestCase
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


    public function testAssignSubjectCreate(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('assign-subject')
            ->click('#main-content > section.admin-visitor-area > div > div:nth-child(1) > div.offset-lg-5.col-lg-3.text-right.col-md-6.col-sm-6 > a')
            ->waitForText('Assign Subject create')
            ->click('#search_student > div > div:nth-child(2) > div')
            ->click('#search_student > div > div:nth-child(2) > div > ul > li:nth-child(2)')
            ->pause(4000)
            ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control')
            ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.open > ul > li:nth-child(2)')
            ->click('#search_student > div > div.col-lg-12.mt-20.text-right > button')
            ->assertSee('Assign Subject')
            ->click('#assign-subject-4 > div > div:nth-child(1) > div')
            ->click('#assign-subject-4 > div > div:nth-child(1) > div > ul > li:nth-child(2)')
            ->click('#assign-subject-4 > div > div:nth-child(2) > div')
            ->click('#assign-subject-4 > div > div:nth-child(2) > div > ul > li:nth-child(2)')
            ->click('#addNewSubject')
            ->pause(4000)
            ->click('#assign-subject-6 > div > div:nth-child(1) > div')
            ->click('#assign-subject-6 > div > div:nth-child(1) > div > ul > li.option.selected.focus')
            ->click('#assign-subject-6 > div > div:nth-child(2) > div')
            ->click('#assign-subject-6 > div > div:nth-child(2) > div > ul > li:nth-child(3)')
            ->click('#addNewSubject')
            ->pause(4000)
            ->click('#removeSubject')
            ->click('#assign_subject > div > div.col-lg-12.mt-20.text-right > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

    public function testSearchAssignSubject(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('assign-subject')
            ->click('#search_student > div > div:nth-child(2) > div')
            ->click('#search_student > div > div:nth-child(2) > div > ul > li:nth-child(2)')
            ->pause(4000)
            ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control')
            ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.open > ul > li:nth-child(2)')
            ->click('#search_student > div > div.col-lg-12.mt-20.text-right > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }
    
}
