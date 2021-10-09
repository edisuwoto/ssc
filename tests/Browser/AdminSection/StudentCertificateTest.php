<?php

namespace Tests\Browser\AdminSection;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\SmStudentCertificate;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StudentCertificateTest extends DuskTestCase
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
                    ->assertSee('dashboard');
        });
    }

    public function testAddNewCertificate(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('student-certificate')
            ->type('name','student certificate')
            ->type('header_left_text','Since 2021')
            ->type('body','Earning my UCR Extension professional certificate is one of the most beneficial things I have done for my career. Before even completing the program, I was contacted twice by companies who were interested in hiring me as a technical writer. This ')
            ->type('footer_left_text','Advisor Signature')          
            ->type('footer_center_text','Instructor Signature')
            ->type('footer_right_text','Principale Signature') 
            ->radio('student_photo','0')
            ->attach('file',public_path('/uploads/certificate/cer.png'))
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-4 > div > div > form > div > div > div.row.mt-40 > div > button')           
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }
    
    public function testEditCertificate(){
        $this->browse(function (Browser $browser){
            $certificate=SmStudentCertificate::latest()->first();
            $browser
            ->visit('student-certificate')
            ->click('#table_id > tbody > tr > td:nth-child(3) > div > button')
            ->assertPathIs('/student-certificate/'.$cer->id)
            ->type('name','Update student certificate')
            ->type('header_left_text','Since 2021')
            ->type('body','Earning my UCR Extension professional certificate is one of the most beneficial things I have done for my career. Before even completing the program, I was contacted twice by companies who were interested in hiring me as a technical writer. This ')
            ->type('footer_left_text','Advisor Signature')          
            ->type('footer_center_text','Instructor Signature')
            ->type('footer_right_text','Principale Signature') 
            ->radio('student_photo','0')
            ->attach('file',public_path('/uploads/certificate/cer.png'))
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-4 > div > div > form > div > div > div.row.mt-40 > div > button')           
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }

    public function testDeleteCertificate(){
        $this->browse(function (Browser $browser){
            $certificate=SmStudentCertificate::latest()->first();
            $browser
            ->visit()
            ->click('#table_id > tbody > tr > td:nth-child(3) > div > button')
            ->click('#table_id > tbody > tr > td:nth-child(3) > div > div > a:nth-child(3)')
            ->whenAvailable('#deleteSectionModal1 > div > div > div.modal-body',function($modal){
                $modal
                ->click('div.mt-40.d-flex.justify-content-between > button.primary-btn.fix-gr-bg')
                ->assertPathIs('student-certificate');
            })            
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');

        });
    }
}
