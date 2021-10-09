<?php

namespace Tests\Browser\StudentInfo;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SubjectWiseAttendanceTest extends DuskTestCase
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
    public function testSubjectWiseAttendanceTest()
    {
        $this->browse(function (Browser $browser) {
            $browser
            ->visit('subject-wise-attendance')
            ->click('#search_studentA > div > div:nth-child(2) > div')
            ->click('#search_studentA > div > div:nth-child(2) > div > ul > li:nth-child(2)')
            ->pause(4000)
            ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.select_section')
            ->pause(1000)
            ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.select_section.open > ul > li:nth-child(2)')
            ->pause(1000)
            ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.select_section')
            ->pause(4000)
            ->click('#select_subject_div > div.nice-select.w-100.bb.niceSelect.form-control.select_subject')
            ->pause(1000)
            ->click('#select_subject_div > div.nice-select.w-100.bb.niceSelect.form-control.select_subject.open > ul > li:nth-child(2)')
            ->click('#search_studentA > div > div.col-lg-12.mt-20.text-right > button')
            ->assertPathIs('/subject-attendance-search')
            ->assertSee('ADMISSION NO')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div.row.mt-40 > div > form > div > div > table > tbody > tr:nth-child(3) > td:nth-child(5) > div > div:nth-child(3) > label')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div.row.mt-40 > div > form > div > div > table > tbody > tr:nth-child(4) > td.text-center > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }
    public function testHolidaySubjectWiseAttendance(){
        $this->browse(function (Browser $browser) {
            $browser
            ->visit('subject-wise-attendance')
            ->click('#search_studentA > div > div:nth-child(2) > div')
            ->click('#search_studentA > div > div:nth-child(2) > div > ul > li:nth-child(2)')
            ->pause(4000)
            ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.select_section')
            ->pause(1000)
            ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.select_section.open > ul > li:nth-child(2)')
            ->pause(1000)
            ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.select_section')
            ->pause(4000)
            ->click('#select_subject_div > div.nice-select.w-100.bb.niceSelect.form-control.select_subject')
            ->pause(1000)
            ->type('attendance_date','07/12/2021')
            ->click('#select_subject_div > div.nice-select.w-100.bb.niceSelect.form-control.select_subject.open > ul > li:nth-child(2)')
            ->click('#search_studentA > div > div.col-lg-12.mt-20.text-right > button')
            ->assertPathIs('/subject-attendance-search')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div.row.mt-40 > div > div.row.mb-20 > div > form > button');

        });
    }
}
