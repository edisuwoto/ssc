<?php

namespace Tests\Browser\LessonPlan;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class lessonTest extends DuskTestCase
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
                    ->visit('/login')
                    ->type('email','admin@infixedu.com')
                    ->type('password','123456')
                    ->click('#btnsubmit')
                    ->waitForText('Welcome')
                    ->assertSee('Welcome');
        });
    }

    public function testCreateLessonTest()
    {
        $this->browse(function (Browser $browser) {
            $browser
                    ->visit('/lesson')
                    ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > form > div > div.col-lg-3 > div:nth-child(1) > div > div.white-box > div > div:nth-child(1) > div > div')
                    ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > form > div > div.col-lg-3 > div:nth-child(1) > div > div.white-box > div > div:nth-child(1) > div > div > ul > li:nth-child(2)')
                    ->pause(4000)
                    ->click('#select_subject_div > div.nice-select.w-100.bb.niceSelect.form-control')
                    ->click('#select_subject_div > div.nice-select.w-100.bb.niceSelect.form-control.open > ul > li:nth-child(2)')        
                    ->type('lesson','lesson-01')
                  
                    ->waitFor('.toast-message',5)
                    ->assertSee('Operation successful');
        });
    }
}
