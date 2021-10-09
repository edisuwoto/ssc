<?php

namespace Tests\Browser\StudentInfo;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StudentAttendaceReportTest extends DuskTestCase
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
    public function testStudentAttendanceReport(){
        $this->browse(function (Browser $browser){
            $browser
                ->visit('student-attendance-report')
                ->click('#search_student > div > div:nth-child(2) > div')
                ->click('#search_student > div > div:nth-child(2) > div > ul > li:nth-child(2)')
                ->pause(4000)
                ->click('#select_section_div > div.nice-select.w-100.niceSelect.bb.form-control.open > ul > li:nth-child(2)')
                ->click('#select_section_div > div.nice-select.w-100.niceSelect.bb.form-control.open > ul > li:nth-child(2)')
                ->click('#search_student > div > div.col-lg-12.mt-20.text-right > button')
                ->assertPathIs('/student-attendance-report-search')
                ->pause(4000)
                ->click('#main-content > section.student-attendance > div > div.row.mt-40 > div:nth-child(2) > a');
                $window = collect($browser->driver->getWindowHandles())->last();
                // Switch to the tab
                 $browser->driver->switchTo()->window($window);   
               // Check if the path is correct
               // $browser->assertPathIs('/student-view/'.$student->id)
               $browser ->assertSee('Admission No')
               ->pause(4000);
        });
    }
}
