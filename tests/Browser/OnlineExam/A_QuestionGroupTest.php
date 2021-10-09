<?php

namespace Tests\Browser\OnlineExam;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class A_QuestionGroupTest extends DuskTestCase
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
    // public function testQuestinoGroupAdd(){
    //     $this->browse(function (Browser $browser) {
    //         $browser
    //                 ->visit('question-group')
    //                 ->type('title','Test Group')
    //                 ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                                    
    //             ->waitFor('.toast-message',5)
    //             ->assertSee('Operation successful');
                   
    //     });
    // }
    // public function testQuestinoGroupEdit(){
    //     $this->browse(function (Browser $browser) {
    //         $browser
    //                 ->visit('question-group')
    //                 ->click('#table_id > tbody > tr:nth-child(1) > td:nth-child(2) > div > button')
    //                 ->click('#table_id > tbody > tr:nth-child(1) > td:nth-child(2) > div > div > a:nth-child(1)')
    //                 ->type('title','Test Group Updated')
    //                 ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                                    
    //             ->waitFor('.toast-message',5)
    //             ->assertSee('Operation successful');
                   
    //     });
    // }
    // public function testQuestionGroupDelete(){
    //     $this->browse(function (Browser $browser){
    //         $browser
    //             ->visit('question-group')
    //             ->click('#table_id > tbody > tr:nth-child(1) > td:nth-child(2) > div > button')
    //             ->click('#table_id > tbody > tr:nth-child(1) > td:nth-child(2) > div > div > a:nth-child(2)')
    //             ->whenAvailable('#deleteQuestionGroupModal1 > div > div > div.modal-body',function($modal){
    //                 $modal
    //                 ->click('div.mt-40.d-flex.justify-content-between > button.primary-btn.fix-gr-bg')
    //                 ->assertPathIs('/question-group');
    //             })
    //             ->waitFor('.toast-message',5)
    //             ->assertSee('Operation successful');
    //     });
    // }

}
