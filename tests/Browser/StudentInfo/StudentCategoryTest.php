<?php

namespace Tests\Browser\StudentInfo;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\SmStudentCategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StudentCategoryTest extends DuskTestCase
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

    public function testStudentCategoryA(){
        $this->browse(function (Browser $browser){
            $browser
            ->loginAs(User::find(1))
            ->visit('student-category')
            ->type('category','A')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }
    public function testStudentCategoryB(){
        $this->browse(function (Browser $browser){
            $browser
            ->loginAs(User::find(1))
            ->visit('student-category')
            ->type('category','B')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

    public function testStudentCategoryC(){
        $this->browse(function (Browser $browser){
            $browser
            ->loginAs(User::find(1))
            ->visit('student-category')
            ->type('category','C')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

    public function testStudentCategoryD(){
        $this->browse(function (Browser $browser){
            $browser
            ->loginAs(User::find(1))
            ->visit('student-category')
            ->type('category','D')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

    public function testEditStudentCategory(){
        $this->browse(function (Browser $browser){

            $studentCategory=SmStudentCategory::latest()->first();
            
            $browser
            ->loginAs(User::find(1))
            ->visit('student-category')           
            ->click('#table_id > tbody > tr:nth-child(1) > td:nth-child(3) > div > button')
            ->pause(2000)
            ->click('#table_id > tbody > tr:nth-child(1) > td:nth-child(3) > div > div > a:nth-child(1)')
            ->assertSee('Edit Student Category')
            ->type('category','A+')
            ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div:nth-child(2) > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

    public function testDeleteStudentCategory(){
        $this->browse(function (Browser $browser){
            $studentCategory=SmStudentCategory::latest()->first();
            $browser
            ->visit('student-category')
            ->click('#table_id > tbody > tr:nth-child(4) > td:nth-child(3) > div > button')    
            ->pause(2000)
            ->click('#table_id > tbody > tr:nth-child(4) > td:nth-child(3) > div > div > a:nth-child(2)')           
            ->whenAvailable('#deleteStudentTypeModal'.$studentCategory->id.' > div > div > div.modal-body',function($modal){
           
                $modal
                ->click('div.mt-40.d-flex.justify-content-between > a > button')
                ->assertpathIs('/student-category');
            })
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

}
