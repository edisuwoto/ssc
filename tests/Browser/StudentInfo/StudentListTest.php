<?php

namespace Tests\Browser\StudentInfo;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\SmStudent;

class StudentListTest extends DuskTestCase
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


    // public function testStudentList(){
    //     $this->browse(function (Browser $browser) {
    //         $browser
    //         ->visit('student-list')
    //         ->click('#infix_form > div > div > div > div > div:nth-child(2) > div > div')
    //         ->click('#infix_form > div > div > div > div > div:nth-child(2) > div > div > ul > li:nth-child(2)')
    //         ->pause(3000)
    //         ->click('#class-div > div.nice-select.niceSelect.w-100.bb.form-control')
    //         ->click('#class-div > div.nice-select.niceSelect.w-100.bb.form-control.open > ul > li:nth-child(2)')
    //         ->pause(3000)
    //         ->click('#btnsubmit')
    //         ->assertPathIs('/student-list-search');

    //     });
    // }

    public function testViewStudent(){
        $this->browse(function (Browser $browser){
            $student=SmStudent::latest()->first();
            $browser
            ->visit('student-list')
            ->pause(8000)
            ->click('#table_id > tbody > tr > td.sorting_1')
            ->pause(1000)
            ->click('#table_id > tbody > tr.child > td > ul > li:nth-child(2) > span.dtr-data > div > button')     
            ->pause(1000)       
            ->click('#table_id > tbody > tr.child > td > ul > li:nth-child(2) > span.dtr-data > div > div > a:nth-child(1)');
            // ->assertPathIs('/student-view/'.$student->id) 
            // Get the last opened tab
              $window = collect($browser->driver->getWindowHandles())->last();
             // Switch to the tab
              $browser->driver->switchTo()->window($window);   
            // Check if the path is correct
            // $browser->assertPathIs('/student-view/'.$student->id)
            $browser ->assertSee('Student Details');
      
        });
    }

    public function testEditStudent(){
        $this->browse(function (Browser $browser){
            $student=SmStudent::latest()->first();
            $browser
            ->visit('student-list')
            ->pause(8000)
            ->click('#table_id > tbody > tr > td.sorting_1')
            ->pause(1000)
            ->click('#table_id > tbody > tr.child > td > ul > li:nth-child(2) > span.dtr-data > div > button')
            ->pause(1000)
            ->click('#table_id > tbody > tr.child > td > ul > li:nth-child(2) > span.dtr-data > div > div > a:nth-child(2)')
            ->assertSee('Student Edit')
            ->type('first_name',$this->faker->firstName)
            ->type('last_name',$this->faker->lastname)
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > form > div > div > div > div > div.row.mt-5 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

    public function testDisableStudent(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('student-list')
            ->pause(8000)
            ->click('#table_id > tbody > tr > td.sorting_1')
            ->pause(1000)
            ->click('#table_id > tbody > tr:nth-child(2) > td > ul > li:nth-child(2) > span.dtr-data > div > button')
            ->click('#table_id > tbody > tr:nth-child(2) > td > ul > li:nth-child(2) > span.dtr-data > div > div > a:nth-child(3)')
            ->whenAvailable('#deleteStudentModal > div > div > div.modal-body',function($modal){
                $modal
                ->click('div.mt-40.d-flex.justify-content-between > form > button')
                ->assertPathIs('student-list');                
            })
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }



}
