<?php

namespace Tests\Browser\OnlineExam;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class B_QuestionBankTest extends DuskTestCase
{
    // public function testLoginTest()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser
    //                 ->visit('/login')
    //                 ->type('email','admin@infixedu.com')
    //                 ->type('password','123456')
    //                 ->click('#btnsubmit')
    //                 ->waitForText('Welcome')
    //                 ->assertSee('dashboard');
    //     });
    // }
    // public function testQuestinoBankAdd(){
    //     $this->browse(function (Browser $browser) {
    //         $browser
    //                 ->visit('question-bank')
    //                 ->click('#question_bank > div > div:nth-child(1) > div > div')
    //                 ->click('#question_bank > div > div:nth-child(1) > div > div > ul > li:nth-child(2)')
    //                 ->click('#question_bank > div > div:nth-child(2) > div > div')
    //                 ->click('#question_bank > div > div:nth-child(2) > div > div > ul > li:nth-child(2)')
    //                 ->pause(1000)
    //                 ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.select_section')
    //                 ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.select_section.open > ul > li:nth-child(2)')
    //                 ->click('#question_bank > div > div:nth-child(4) > div > div')
    //                 ->click('#question_bank > div > div:nth-child(4) > div > div > ul > li:nth-child(4)')

    //                 ->type('question','This is ___ question')
    //                 ->type('marks',5)
    //                 ->type('suitable_words','test')
    //                 ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-4 > div > div > div.white-box > div > div > button')
                                    
    //             ->waitFor('.toast-message',5)
    //             ->assertSee('Operation successful');
                   
    //     });
    // }
    // public function testQuestinoBankEdit(){
    //     $this->browse(function (Browser $browser) {
    //         $browser
    //                 ->visit('question-bank')
    //                 ->click('#table_id > tbody > tr.odd > td:nth-child(5) > div > button')
    //                 ->click('#table_id > tbody > tr.odd > td:nth-child(5) > div > div > a:nth-child(1)')
    //                 ->click('#question_bank > div > div:nth-child(1) > div > div')
    //                 ->click('#question_bank > div > div:nth-child(1) > div > div > ul > li:nth-child(2)')
    //                 ->click('#question_bank > div > div:nth-child(2) > div > div')
    //                 ->click('#question_bank > div > div:nth-child(2) > div > div > ul > li:nth-child(2)')
    //                 ->pause(1000)
    //                 ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.select_section')
    //                 ->click('#select_section_div > div.nice-select.w-100.bb.niceSelect.form-control.select_section.open > ul > li:nth-child(2)')
    //                 ->click('#question_bank > div > div:nth-child(4) > div > div')
    //                 ->click('#question_bank > div > div:nth-child(4) > div > div > ul > li:nth-child(4)')

    //                 ->type('question','This is ___ question Updated')
    //                 ->type('marks',5)
    //                 ->type('suitable_words','test')
    //                 ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-4 > div > div > div.white-box > div > div > button')
                                    
    //             ->waitFor('.toast-message',5)
    //             ->assertSee('Operation successful');
                   
    //     });
    // }
    // public function testQuestinoBankDelete(){
    //     $this->browse(function (Browser $browser){
    //         $browser
    //             ->visit('question-bank')
    //             ->click('#table_id > tbody > tr.odd > td:nth-child(5) > div > button')            
    //             ->click('#table_id > tbody > tr.odd > td:nth-child(5) > div > div > a:nth-child(2)')               
    //             ->whenAvailable('#deleteQuestionBankModal1 > div > div > div.modal-body', function ($modal) {
    //                 $modal
    //              ->click('div.mt-40.d-flex.justify-content-between > button.primary-btn.fix-gr-bg')
    //              ->assertPathIs('question-bank');
    //              })
                 
    //             ->waitFor('.toast-message',5)
    //             ->assertSee('Operation successful');
              
    //     });
    // }

}
