<?php

namespace Tests\Browser\Homework;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomeworkTest extends DuskTestCase
{
    public function testLoginTest()
    {
        $this->browse(function (Browser $browser) {
            $browser
                    ->visit('/login')
                    ->type('email','admin@infixedu.com')
                    ->type('password','123456')
                    ->click('#btnsubmit')
                    ->waitForText('Welcome')
                    ->assertSee('Welcome');
        });
    }
    public function testHomeworkAdd(){
        $this->browse(function (Browser $browser,$endTime) {
            $browser
                    ->visit('add-homeworks')
                    ->click('#main-content > section.admin-visitor-area > div > form > div > div > div > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div > div')
                    ->click('#main-content > section.admin-visitor-area > div > form > div > div > div > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div > div > ul > li:nth-child(2)')
                    ->pause(2000)
                    ->click('#subjectSelecttHomeworkDiv > div.nice-select.niceSelect.w-100.bb.form-control')
                    ->click('#subjectSelecttHomeworkDiv > div.nice-select.niceSelect.w-100.bb.form-control.open > ul > li:nth-child(2)')
                    
                    ->pause(2000)
                    ->click('#selectSectionsDiv > div:nth-child(4) > label')

                    // ->click('#homework_date')
                    // ->pause(1000)
                    // ->click('div.datepicker-days > table > tbody > tr:nth-child(3) > td.active.day')
                    // ->click('#submission_date')
                    // ->pause(1000)
                    // ->click('div.datepicker-days > table > tbody > tr:nth-child(3) > td.active.day')
                    

                    ->type('description','test')

                    ->type('marks',20)
                    ->attach('homework_file',public_path('/uploads/upload_contents/demo.png'))

                    ->click('#main-content > section.admin-visitor-area > div > form > div > div > div > div.row.mt-40 > div > button')
                                    
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
                   
        });
    }
    public function testHomeworkList(){
        $this->browse(function (Browser $browser,$endTime) {
            $browser
                    ->visit('homework-list')
                    ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div:nth-child(2) > div > div > form > div > div:nth-child(1) > div > div')
                    ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div:nth-child(2) > div > div > form > div > div:nth-child(1) > div > div > ul > li:nth-child(2)')
                    
                    ->pause(2000)
                    ->click('#sectionStudentDiv > div.nice-select.niceSelect.w-100.bb.form-control')
                    ->click('#sectionStudentDiv > div.nice-select.niceSelect.w-100.bb.form-control.open > ul > li:nth-child(2)')
                    
                    ->pause(2000)
                    ->click('#subjectSelecttDiv > div.nice-select.niceSelect.w-100.bb.form-control')
                    ->click('#subjectSelecttDiv > div.nice-select.niceSelect.w-100.bb.form-control.open > ul > li:nth-child(2)')

                    ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div:nth-child(2) > div > div > form > div > div.col-lg-12.mt-20.text-right > button')
                                    
                    ->assertSee('Homework List');
                   
        });
    }
    public function testHomeworkEdit(){
        $this->browse(function (Browser $browser,$endTime) {
            $browser
                    ->visit('homework-list')
                    ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div:nth-child(2) > div > div > form > div > div:nth-child(1) > div > div')
                    ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div:nth-child(2) > div > div > form > div > div:nth-child(1) > div > div > ul > li:nth-child(2)')
                    
                    ->pause(2000)
                    ->click('#sectionStudentDiv > div.nice-select.niceSelect.w-100.bb.form-control')
                    ->click('#sectionStudentDiv > div.nice-select.niceSelect.w-100.bb.form-control.open > ul > li:nth-child(2)')
                    
                    ->pause(2000)
                    ->click('#subjectSelecttDiv > div.nice-select.niceSelect.w-100.bb.form-control')
                    ->click('#subjectSelecttDiv > div.nice-select.niceSelect.w-100.bb.form-control.open > ul > li:nth-child(2)')

                    ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div:nth-child(2) > div > div > form > div > div.col-lg-12.mt-20.text-right > button')
                    ->pause(3000)

                    ->click('#table_id > tbody > tr.odd.parent > td.sorting_1')           
                    ->click('#table_id > tbody > tr.child > td > ul > li > span.dtr-data > div > button')           
                    ->click('#table_id > tbody > tr.child > td > ul > li > span.dtr-data > div > div > a:nth-child(2)')

                    ->type('description','update test')

                    ->click('#main-content > section.admin-visitor-area > div > form > div > div > div > div.row.mt-40 > div > button')
                                    
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
                   
        });
    }
}
