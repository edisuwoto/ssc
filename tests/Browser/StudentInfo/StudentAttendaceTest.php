<?php

namespace Tests\Browser\StudentInfo;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StudentAttendaceTest extends DuskTestCase
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
    public function testStudentAttendance(){
        $this->browse(function (Browser $browser){
            $browser
                ->visit('student-attendance')            
                ->click('#search_studentA > div > div.col-lg-4.col-md-4.sm_mb_20.sm2_mb_20 > div')
                ->click('#search_studentA > div > div.col-lg-4.col-md-4.sm_mb_20.sm2_mb_20 > div > ul > li:nth-child(2)')
                ->pause(4000)
                ->click('#select_section_div > div.nice-select.niceSelect.w-100.bb.form-control')
                ->pause(1000)
                ->click('#select_section_div > div.nice-select.niceSelect.w-100.bb.form-control.open > ul > li:nth-child(2)')
                ->pause(1000)
                ->click('#select_section_div > div.nice-select.niceSelect.w-100.bb.form-control.open > ul > li:nth-child(2)')
                ->click('#search_studentA > div > div.col-lg-12.mt-20.text-right > button')
                ->assertSee('ADMISSION NO')
                ->assertPathIs('/student-search')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div.row.mt-40 > div > form > div > div > table > tbody > tr:nth-child(4) > td.text-center > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');

        });
    }
    public function testImportStudentAttendance(){
        $this->browse(function (Browser $browser){
            $browser
                ->visit('student-attendance')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div:nth-child(1) > div.col-lg-6.col-md-6.text_sm_right.text_xs_left.col-sm-6 > a')
                ->assertPathIs('/student-attendance-import')
                ->click('#student_form > div > div > div > div > div:nth-child(3) > div.col-lg-6.col-md-6.col-sm-12.sm_mb_20.sm2_mb_20 > div')
                ->pause(1000)
                ->click('#student_form > div > div > div > div > div:nth-child(3) > div.col-lg-6.col-md-6.col-sm-12.sm_mb_20.sm2_mb_20 > div > ul > li:nth-child(2)')
                ->pause(4000)
                ->click('#select_section_div > div.nice-select.niceSelect.w-100.bb.form-control')
                ->pause(1000)
                ->click('#select_section_div > div.nice-select.niceSelect.w-100.bb.form-control.open > ul > li:nth-child(2)')
                ->pause(1000)
                ->attach('file',public_path('student_attendance.xlsx'))
                ->pause(1000)
                ->click('#student_form > div > div > div > div > div.row.mt-40 > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
            });
        }
}
