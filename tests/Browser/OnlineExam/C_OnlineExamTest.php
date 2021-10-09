<?php

namespace Tests\Browser\OnlineExam;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class C_OnlineExamTest extends DuskTestCase
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
                        ->assertSee('dashboard');
            });
        }
    public function testOnlineExamAdd(){

        $selectedTime = date("h:i:sa");
        $endTime = strtotime("+15 minutes", strtotime($selectedTime));
        $endTime=  date('h:i:a', $endTime);
        $this->browse(function (Browser $browser,$endTime) {
            $browser
                    // ->visit('logout')
                    ->visit('online-exam')
                    ->type('title','Test Exam')

                    ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(2) > div > div')
                    ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(2) > div > div > ul > li:nth-child(2)')
                   
                    ->pause(1000)
                    ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.select_section')
                    ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.select_section.open > ul > li:nth-child(2)')
                    ->pause(1000)
                   
                    ->click('#select_subject_div > div.nice-select.w-100.bb.niceSelect.form-control')
                    ->click('#select_subject_div > div.nice-select.w-100.bb.niceSelect.form-control.open > ul > li:nth-child(2)')
                    
                    
                    ->click('#startDate')
                    ->click('body > div.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-bottom > div.datepicker-days > table > tbody > tr:nth-child(3) > td.active.day')
                    
                    ->click('#end_Date')
                    ->click('body > div.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-bottom > div.datepicker-days > table > tbody > tr:nth-child(3) > td.active.day')
                   
                   
                    ->pause(3000)
                    ->type('date',date('m/d/Y'))
                    ->pause(3000)
                    ->type('end_date',date('m/d/Y'))
                    ->type('title','Test Exam 2')
                    ->pause(3000)
                    ->type('start_time',date("h:i:a"))
                    ->pause(3000)
                    ->type('end_time',date("h:i:a"))
                    // ->type('end_time',$endTime)
                    ->pause(3000)
                    ->type('percentage',20)
                    ->pause(3000)
                    ->keys('textarea','n/a')
                    ->pause(3000)
                    ->check('auto_mark')
                    
                    ->pause(10000)
                    ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                                    
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
                   
        });
    }
    // public function testOnlineExamEdit(){
    //     $this->browse(function (Browser $browser) {
    //         $browser
    //                 ->visit('online-exam')

    //                 ->click('#table_id > tbody > tr > td.sorting_1')
    //                 ->click('#table_id > tbody > tr.child > td > ul > li:nth-child(2) > span.dtr-data > div > button')
    //                 ->click('#table_id > tbody > tr.child > td > ul > li:nth-child(2) > span.dtr-data > div > div > a:nth-child(1)')
                    
    //                 ->type('title','Test Exam Update')

    //                 ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(2) > div > div')
    //                 ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div:nth-child(2) > div > div > ul > li:nth-child(2)')
                    
    //                 ->pause(1000)
    //                 ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.select_section')
    //                 ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.select_section.open > ul > li:nth-child(2)')
    //                 ->pause(1000)
                    
    //                 ->click('#select_subject_div > div.nice-select.w-100.bb.niceSelect.form-control')
    //                 ->click('#select_subject_div > div.nice-select.w-100.bb.niceSelect.form-control.open > ul > li:nth-child(2)')
                    
    //                 ->type('date',date('m/d/Y'))
    //                 ->type('start_time',date("h:i:a"))
    //                 ->type('start_time',$endTime)
    //                 ->type('percentage',20)
    //                 ->type('instruction','n/a')
    //                 ->type('auto_mark',1)
    //                 ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                                   
    //                 ->waitFor('.toast-message',5)
    //                 ->assertSee('Operation successful');
                   
    //     });
    // }
    // public function testOnlineExamDelete(){
    //     $this->browse(function (Browser $browser){
    //         $browser
    //             ->visit('online-exam')
    //             ->click('#table_id > tbody > tr > td.sorting_1')
    //             ->click('#table_id > tbody > tr.child > td > ul > li:nth-child(2) > span.dtr-data > div > button')
    //             ->click('#table_id > tbody > tr.child > td > ul > li:nth-child(2) > span.dtr-data > div > div > a:nth-child(2)')             
    //             ->whenAvailable('#deleteOnlineExam > div > div > div.modal-body', function ($modal) {
    //                 $modal
    //              ->click('div.mt-40.d-flex.justify-content-between > form > button')
    //              ->assertPathIs('online-exam');
    //              })
                 
    //             ->waitFor('.toast-message',5)
    //             ->assertSee('Operation successful');
              
    //     });
    // }
}
