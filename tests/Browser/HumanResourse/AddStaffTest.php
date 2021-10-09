<?php

namespace Tests\Browser\HumanResourse;

use App\SmStaff;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddStaffTest extends DuskTestCase
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

    public function testAddStaff(){
        $this->browse(function (Browser $browser){
            $browser
            ->visit('add-staff')
            // ->type('staff_no','3')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > form > div > div > div > div:nth-child(1) > div:nth-child(4) > div:nth-child(2) > div > div')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > form > div > div > div > div:nth-child(1) > div:nth-child(4) > div:nth-child(2) > div > div > ul > li:nth-child(7)')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > form > div > div > div > div:nth-child(1) > div:nth-child(4) > div:nth-child(3) > div > div')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > form > div > div > div > div:nth-child(1) > div:nth-child(4) > div:nth-child(3) > div > div > ul > li:nth-child(2)')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > form > div > div > div > div:nth-child(1) > div:nth-child(4) > div:nth-child(4) > div > div')

            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > form > div > div > div > div:nth-child(1) > div:nth-child(4) > div:nth-child(4) > div > div > ul > li:nth-child(2)')
            ->type('first_name','abu')
            ->type('last_name','nayem')
            ->type('fathers_name','abus father')
            ->type('mothers_name','abus mother')
            ->type('email','abu@gmail.com')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > form > div > div > div > div:nth-child(1) > div:nth-child(6) > div:nth-child(2) > div > div')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > form > div > div > div > div:nth-child(1) > div:nth-child(6) > div:nth-child(2) > div > div > ul > li:nth-child(3)')
          
            ->type('mobile','029347293')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > form > div > div > div > div:nth-child(1) > div:nth-child(7) > div:nth-child(2) > div > div')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > form > div > div > div > div:nth-child(1) > div:nth-child(7) > div:nth-child(2) > div > div > ul > li:nth-child(2)')
            
            ->type('emergency_mobile','029347293')
            ->type('driving_license','9847')
            ->type('mobile','029347293')
            ->type('mobile','029347293')
            ->type('mobile','029347293')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > form > div > div > div > div:nth-child(1) > div:nth-child(6) > div:nth-child(2) > div > div')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > form > div > div > div > div:nth-child(1) > div:nth-child(6) > div:nth-child(2) > div > div > ul > li:nth-child(3)')
            ->attach('staff_photo',public_path('/uploads/staff/staff.jpg'))
            ->click('#LogoPic > div > div > div.modal-header > button')
            ->type('current_address','dhaka-narsingdi')
            ->type('basic_salary','2200')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > form > div > div > div > div:nth-child(1) > div:nth-child(13) > div:nth-child(3) > div > div')
            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > form > div > div > div > div:nth-child(1) > div:nth-child(13) > div:nth-child(3) > div > div > ul > li:nth-child(2)')
            ->type('location','some')
            ->type('bank_account_name','Abu Nayem')
            ->type('bank_account_no','12398724')
            ->type('bank_name','DBBL')            
            ->type('bank_brach','Narsingdi')
            ->type('facebook_url','https://www.facebook.com/')
            ->type('twiteer_url','https://www.facebook.com/')
            ->type('linkedin_url','https://www.facebook.com/')
            ->type('instragram_url','https://www.facebook.com/')        
            ->attach('resume',public_path('/uploads/resume/sample_j.pdf'))
            ->attach('joining_letter',public_path('/uploads/staff_joining_letter/sample_j.pdf'))
            ->attach('other_document',public_path('/uploads/others_documents/sample_j.pdf'))

            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > form > div > div > div > div:nth-child(11) > div > button')
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');
        });
    }
    // public function testStaffStatus(){
    //     $this->browse(function (Browser $browser){
    //         $browser
    //         ->visit('staff-directory')
    //         ->click('#table_id > tbody > tr.even > td:nth-child(8) > label > span')
    //         // ->click('#table_id > tbody > tr.even > td:nth-child(8) > label')
    //         ->pause(8000);

    //     });
    // }
        // public function testEditStaff(){
        //     $this->browse(function (Browser $browser){
        //         $staff=SmStaff::latest()->first();
        //         $browser
        //         ->visit('staff-directory')
        //         ->click('#table_id > tbody > tr > td:nth-child(9) > div > button')
        //         ->pause(3000)
        //         ->click('#table_id > tbody > tr.odd > td:nth-child(9) > div > div > a:nth-child(2)')
        //         // ->assertPathis('/edit-staff/'.$staff->id)
        //         ->type('first_name','Md Abu')
        //         ->click('#main-content > section.admin-visitor-area > div > form > div > div > div > div > div:nth-child(23) > div > button')
        //         ->waitFor('.toast-message',5)
        //         ->assertSee('Operation successful');
        //     });
        // }
    
}
