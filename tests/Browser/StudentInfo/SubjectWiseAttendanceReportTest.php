<?php

namespace Tests\Browser\StudentInfo;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SubjectWiseAttendanceReportTest extends DuskTestCase
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
    public function testSubjectWiseAttendanceTestReport(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('subject-attendance-average-report')
            ->click('#search_student > div > div:nth-child(2) > div')
            ->click('#search_student > div > div:nth-child(2) > div > ul > li:nth-child(2)')
            ->pause(4000)
            ->click('#select_section_div > div')
            ->click('#select_section_div > div > ul > li:nth-child(2)')
            ->click('#search_student > div > div.col-lg-12.mt-20.text-right > button')
            ->assertPathIs('/subject-attendance-average-report')
            ->pause(4000)
            ->click('#main-content > section.student-attendance > div > div.row.mt-40 > div.col-lg-6.no-gutters.mb-30 > a');
            $window = collect($browser->driver->getWindowHandles())->last();           
             $browser->driver->switchTo()->window($window);   
             $browser ->assertSee('Student Attendance')
             ->pause(4000);

        });
    }
}
