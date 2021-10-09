<?php

namespace Tests\Browser\HumanResourse;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StaffAttendanceReportTest extends DuskTestCase
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
                    ->assertSee('Welcome ');
        });
    }


    public function testStaffAttendanceReprot(){
        $this->browse(function (Browser $browser){
            $browser
            ->loginAs(User::find(1))
            ->visit('staff-attendance-report')
            ->click('#infix_form > div > div:nth-child(2) > div')
            ->click('#infix_form > div > div:nth-child(2) > div > ul > li:nth-child(7)')
            ->click('#btnsubmit')
            ->assertSee('Staff Attendance');

        });
    }
    public function testImportAttendance(){
        $this->browse(function (Browser $browser){
            $browser

            ->loginAs(User::find(1))
            ->visit('staff-attendance')
            ->click('#main-content > section.admin-visitor-area > div > div:nth-child(1) > div:nth-child(2) > a')
            ->attach('file','staff_attendance.xlsx')
            ->click('#student_form > div > div > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
           
        });
    }
}
