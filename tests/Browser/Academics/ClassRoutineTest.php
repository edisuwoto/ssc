<?php

namespace Tests\Browser\Academics;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ClassRoutineTest extends DuskTestCase
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
    public function testClassRoutineNew(){
        $this->browse(function (Browser $browser){
            $browser
            ->loginAs(User::find(1))
            ->visit('class-routine-new')
            ->click('#search_student > div > div:nth-child(2) > div')         
            ->click('#search_student > div > div:nth-child(2) > div > ul > li.option.selected.focus')
            ->pause(4000)
            ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control')
            ->pause(1000)
            ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.open > ul > li:nth-child(2)')
            ->click('#search_student > div > div.col-lg-12.mt-20.text-right > button')
            ->assertSee('CLASS PERIOD')
            ->click('#main-content > section.mt-20 > div > div:nth-child(2) > div > table > tbody > tr:nth-child(1) > td:nth-child(2) > div > a')
            ->whenAvailable('#showDetaildModalBody',function($modal){
                $modal
                ->click('div > form > div > div:nth-child(1) > div:nth-child(7) > div > div')
                ->click('div > form > div > div:nth-child(1) > div:nth-child(7) > div > div > ul > li:nth-child(2)')
                ->pause(4000)
                ->click('#teacher-div > div > div.nice-select.w-100.bb.niceSelectModal.form-control')
                ->click('#teacher-div > div > div.nice-select.w-100.bb.niceSelectModal.form-control.open > ul > li:nth-child(2)')
                ->pause(4000)
                ->click('div > form > div > div:nth-child(1) > div:nth-child(9) > div > div')
                ->click('div > form > div > div:nth-child(1) > div:nth-child(9) > div > div > ul > li:nth-child(2)')
                ->pause(8000)
                ->click('#otherdays > div > div.col-lg-8 > label')
                ->pause(1000)
                ->click('div > form > div > div.col-lg-12.text-center.mt-40 > div > button.primary-btn.fix-gr-bg.submit')
                ->assertPathIs('/class-routine-new');
            })
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }
    public function testDeleteClassRoutineNew(){
        $this->browse(function (Browser $browser){
            $browser
            ->loginAs(User::find(1))
            ->visit('class-routine-new')
            ->click('#search_student > div > div:nth-child(2) > div')         
            ->click('#search_student > div > div:nth-child(2) > div > ul > li.option.selected.focus')
            ->pause(4000)
            ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control')
            ->pause(1000)
            ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.open > ul > li:nth-child(2)')
            ->click('#search_student > div > div.col-lg-12.mt-20.text-right > button')
            ->assertSee('CLASS PERIOD')
            ->click('#main-content > section.mt-20 > div > div:nth-child(2) > div > table > tbody > tr:nth-child(2) > td:nth-child(2) > a:nth-child(8)')
            ->whenAvailable('#showDetaildModalBody',function($modal){
                $modal
                ->click('div.mt-40.d-flex.justify-content-between > a')
                ->assertpathIs('/class-routine-new');
            })
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');


        });
    }

    // public function testClassRoutineNew(){
    //     $this->browse(function (Browser $browser){
    //         $browser
    //         ->loginAs(User::find(1))
    //         ->visit('class-routine-new')
    //         ->click('#search_student > div > div:nth-child(2) > div')         
    //         ->click('#search_student > div > div:nth-child(2) > div > ul > li.option.selected.focus')
    //         ->pause(4000)
    //         ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control')
    //         ->pause(1000)
    //         ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.open > ul > li:nth-child(2)')
    //         ->click('#search_student > div > div.col-lg-12.mt-20.text-right > button')
    //         ->assertSee('CLASS PERIOD');
    //         ->click('#main-content > section.mt-20 > div > div:nth-child(2) > div > table > tbody > tr:nth-child(2) > td:nth-child(2) > a:nth-child(7)')
    //         ->whenAvailable('#showDetaildModalBody',function($modal){
    //             $modal
    //             ->click('div.mt-40.d-flex.justify-content-between > a')
    //             ->assertpathIs('/class-routine-new');
    //         })
    //     });
    //  }
}
