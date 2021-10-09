<?php

namespace Tests\Browser\StudentInfo;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\SmStudentGroup;
class StudentGroupTest extends DuskTestCase
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

    public function testStudentGroup(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('student-group')
            ->type('group','A+')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }
    
    public function testStudentGroupB(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('student-group')
            ->type('group','B+')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }
    
    public function testStudentGroupC(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('student-group')
            ->type('group','C+')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

    public function testEditStudentGroup(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('student-group')
            ->click('#table_id > tbody > tr:nth-child(3) > td:nth-child(3) > div > button')
            ->click('#table_id > tbody > tr:nth-child(3) > td:nth-child(3) > div > div > a:nth-child(1)')
            ->assertSee('Edit Student Group')
            ->type('group','D+')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div:nth-child(2) > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

    public function testDeleteStudentGroup(){
        $this->browse(function (Browser $browser){
            $studentGroup=SmStudentGroup::latest()->first();
            $browser
            ->visit('student-group')
            ->click('#table_id > tbody > tr:nth-child(3) > td:nth-child(3) > div > button')
            ->click('#table_id > tbody > tr:nth-child(3) > td:nth-child(3) > div > div > a:nth-child(2)')
            ->whenAvailable('#deleteStudentGroupModal'.$studentGroup->id.' > div > div > div.modal-body',function($modal){
                $modal
                ->click('div.mt-40.d-flex.justify-content-between > a')
                ->assertpathIs('/student-group');
            })
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
         
        });
    }

    

}
