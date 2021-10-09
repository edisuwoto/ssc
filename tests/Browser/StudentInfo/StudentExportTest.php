<?php

namespace Tests\Browser\StudentInfo;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StudentExportTest extends DuskTestCase
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

    public function testExportToCsv()
    {
        $this->browse(function (Browser $browser) {
            $browser

                    ->visit('all-student-export')
                    ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div > div > div.white-box > div > div > div > div > a:nth-child(1)')
                    ->pause(5000);

        });
    }
    
    public function testExportToPdf()
    {
        $this->browse(function (Browser $browser) {
            $browser

                    ->visit('all-student-export')
                    ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div > div > div.white-box > div > div > div > div > a:nth-child(2)')
                    ->pause(5000)
                    ->assertSee('ALL STUDENT');

        });
    }
}
