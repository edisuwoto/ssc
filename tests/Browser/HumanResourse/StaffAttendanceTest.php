<?php

namespace Tests\Browser\HumanResourse;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StaffAttendanceTest extends DuskTestCase
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


    public function testStaffAttendance(){
        $this->browser(function (Browser $browser){
            $browser
            ->loginAs(User::find(1))
            ->visit('staff-attendance')
            ->click('#infix_form > div > div:nth-child(2) > div')
            ->click('#infix_form > div > div:nth-child(2) > div > ul > li:nth-child(7)')
            ->click('#btnsubmit')
            ->assertPathIs('/staff-attendance-search')
            ->click('#attendanceP2')
            ->click('#main-content > section.admin-visitor-area > div > div.row.mt-40 > div > form > div > div > table > tbody > tr:nth-child(2) > td.text-center > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }
}
