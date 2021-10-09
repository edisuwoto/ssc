<?php

namespace Tests\Browser\StudyMeterial;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\SmTeacherUploadContent;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UploadContentTest extends DuskTestCase
{
    use WithFaker;
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

//     public function testAssignmentAllStudentTest()
//     {
//         $this->browse(function (Browser $browser) {
//             $browser
//             ->visit('upload-content')
//             ->type('content_title',$this->faker->name)
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div')
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div > ul > li:nth-child(2)')
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(3) > div > label:nth-child(4)')
//             ->click('#availableClassesDiv > div > label')
//             ->type('description',$this->faker->name)
//             ->type('source_url','https://www.google.com/')
//             ->attach('content_file',public_path('/uploads/upload_contents/sample.pdf'))
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')            
//             ->waitFor('.toast-message',5)
//             ->assertSee('Operation successful');

//         });
//     }

//     public function testAssignmentAllClassTest()
//     {
//         $this->browse(function (Browser $browser) {
//             $browser
//             ->visit('upload-content')
//             ->type('content_title',$this->faker->name)
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div')
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div > ul > li:nth-child(2)')
           
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(3) > div > label:nth-child(4)')
           
//             ->click('#contentDisabledDiv > div > div.col-lg-12.mb-20 > div > div')
//             ->pause(1000)
//             ->click('#contentDisabledDiv > div > div.col-lg-12.mb-20 > div > div > ul > li:nth-child(2)')

//             ->type('description',$this->faker->name)
//             ->type('source_url','https://www.google.com/')
//             ->attach('content_file',public_path('/uploads/upload_contents/sample.pdf'))
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')            
//             ->waitFor('.toast-message',5)
//             ->assertSee('Operation successful');

//         });
//     }
//     public function testAssignmentAClassTest()
//     {
//         $this->browse(function (Browser $browser) {
//             $browser
//             ->visit('upload-content')
//             ->type('content_title',$this->faker->name)
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div')
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div > ul > li:nth-child(2)')
           
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(3) > div > label:nth-child(4)')
           
//             ->click('#contentDisabledDiv > div > div.col-lg-12.mb-20 > div > div')
//             ->pause(1000)
//             ->click('#contentDisabledDiv > div > div.col-lg-12.mb-20 > div > div > ul > li:nth-child(2)')
            
//             ->type('description',$this->faker->name)
//             ->type('source_url','https://www.google.com/')
//             ->attach('content_file',public_path('/uploads/upload_contents/sample.pdf'))
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')            
//             ->waitFor('.toast-message',5)
//             ->assertSee('Operation successful');

//         });
//     }
//     public function testAssignmentClassSectionTest()
//     {
//         $this->browse(function (Browser $browser) {
//             $browser
//             ->visit('upload-content')
//             ->type('content_title',$this->faker->name)
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div')
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div > ul > li:nth-child(2)')
           
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(3) > div > label:nth-child(4)')
          
//             ->click('#contentDisabledDiv > div > div.col-lg-12.mb-20 > div > div')
//             ->pause(1000)
//             ->click('#contentDisabledDiv > div > div.col-lg-12.mb-20 > div > div > ul > li:nth-child(2)')
//             ->pause(4000)
//             ->click('#sectionStudentDiv > div.nice-select.niceSelect.w-100.bb.form-control')
//             ->pause(1000)
//             ->click('#sectionStudentDiv > div.nice-select.niceSelect.w-100.bb.form-control.open > ul > li:nth-child(2)')
//             ->type('description',$this->faker->name)
//             ->type('source_url','https://www.google.com/')
//             ->attach('content_file',public_path('/uploads/upload_contents/sample.pdf'))
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')            
//             ->waitFor('.toast-message',5)
//             ->assertSee('Operation successful');

//         });
//     }
//     public function testSyllabusTest()
//     {
//         $this->browse(function (Browser $browser) {
//             $browser
//             ->visit('upload-content')
//             ->type('content_title',$this->faker->name)
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div')
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div > ul > li:nth-child(3)')
           
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(3) > div > label:nth-child(4)')
//              ->click('#availableClassesDiv > div > label')
   
//             ->type('description',$this->faker->name)
//             ->type('source_url','https://www.google.com/')
//             ->attach('content_file',public_path('/uploads/upload_contents/sample.pdf'))
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')            
//             ->waitFor('.toast-message',5)
//             ->assertSee('Operation successful');

//         });
//     }
//     public function testOtherDownloadsTest()
//     {
//         $this->browse(function (Browser $browser) {
//             $browser
//             ->visit('upload-content')
//             ->type('content_title',$this->faker->name)
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div')
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div > ul > li:nth-child(4)')
           
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(3) > div > label:nth-child(4)')
//              ->click('#availableClassesDiv > div > label')

//              ->type('description',$this->faker->name)
//             ->type('source_url','https://www.google.com/')
//             ->attach('content_file',public_path('/uploads/upload_contents/sample.pdf'))
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')            
//             ->waitFor('.toast-message',5)
//             ->assertSee('Operation successful');

//         });
//    }

//     public function testOtherDownloadsSectionTest()
//     {
//         $this->browse(function (Browser $browser) {
//             $browser
//             ->visit('upload-content')
//             ->type('content_title',$this->faker->name)
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div')
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div > ul > li:nth-child(4)')

//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(3) > div > label:nth-child(4)')
           
//             ->click('#contentDisabledDiv > div > div.col-lg-12.mb-20 > div > div')
//             ->pause(1000)
//             ->click('#contentDisabledDiv > div > div.col-lg-12.mb-20 > div > div > ul > li:nth-child(2)')
//             ->pause(4000)
//             ->click('#sectionStudentDiv > div.nice-select.niceSelect.w-100.bb.form-control')
//             ->pause(1000)
//             ->click('#sectionStudentDiv > div.nice-select.niceSelect.w-100.bb.form-control.open > ul > li:nth-child(2)')

//             ->type('description',$this->faker->name)
//             ->type('source_url','https://www.google.com/')
//             ->attach('content_file',public_path('/uploads/upload_contents/sample.pdf'))
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')            
//             ->waitFor('.toast-message',5)
//             ->assertSee('Operation successful');

//         });
//     }

    
//     public function testOtherAdminStudentDownloadsTest()
//     {
//         $this->browse(function (Browser $browser) {
//             $browser
//             ->visit('upload-content')
//             ->type('content_title',$this->faker->name)
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div')
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(2) > div > ul > li:nth-child(4)')
                       
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(3) > div > label:nth-child(2)')
//            ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(3) > div > label:nth-child(4)')

//             ->click('#availableClassesDiv > div > label')

//              ->type('description',$this->faker->name)
//             ->type('source_url','https://www.google.com/')
//             ->attach('content_file',public_path('/uploads/upload_contents/sample.pdf'))
//             ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')            
//             ->waitFor('.toast-message',5)
//             ->assertSee('Operation successful');

//         });
//     }


    // public function testViewStudyMeterial(){
    //     $this->browse(function (Browser $browser) {
    //         $browser
    //         ->visit('upload-content')
    //         ->click('#table_id > tbody > tr:nth-child(1) > td.sorting_1')
    //         ->click('#table_id > tbody > tr.child > td > ul > li > span.dtr-data > div > button')
    //         ->click('#table_id > tbody > tr.child > td > ul > li > span.dtr-data > div > div > a.dropdown-item.modalLink')
    //          ->pause(4000)
    //          ->assertSee('View Content Details');
    //     });
    // }

    // public function testEditStudyMeterial(){
    //     $this->browse(function (Browser $browser) {
    //         $browser
    //         ->visit('upload-content')
    //         ->click('#table_id > tbody > tr:nth-child(1) > td.sorting_1')
    //         ->click('#table_id > tbody > tr.child > td > ul > li > span.dtr-data > div > button')
    //         ->click('#table_id > tbody > tr.child > td > ul > li > span.dtr-data > div > div > a:nth-child(2)')
    //         ->assertSee('Edit Upload Content')
    //         ->type('content_title','edit upload content')
    //         ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mb-25 > div:nth-child(3) > div > label:nth-child(2)')
    //         ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
       
    //         ->waitFor('.toast-message',5)
    //         ->assertSee('Operation successful');
       

    //     });
    // }

    public function testDownloadStudyMeterial(){
        $this->browse(function (Browser $browser) {
            $browser
            ->visit('upload-content')
            ->click('#table_id > tbody > tr:nth-child(1) > td.sorting_1')
            ->click('#table_id > tbody > tr.child > td > ul > li > span.dtr-data > div > button')
            ->click('#table_id > tbody > tr.child > td > ul > li > span.dtr-data > div > div > a:nth-child(4)')
            ->pause(4000);
         

       

        });
    }

    public function testDeleteStudyMeterial(){
        $this->browse(function (Browser $browser) {
            $studeyMeterial=SmTeacherUploadContent::first();
            $browser
            ->visit('upload-content')
            ->click('#table_id > tbody > tr:nth-child(1) > td.sorting_1')
            ->click('#table_id > tbody > tr.child > td > ul > li > span.dtr-data > div > button')
            ->click('#table_id > tbody > tr.child > td > ul > li > span.dtr-data > div > div > a:nth-child(3)')
            ->pause(2000)
            ->whenAvailable('#deleteApplyLeaveModal'.$studeyMeterial->id.' > div > div > div.modal-body',function($modal){
                $modal
                ->click('div.mt-40.d-flex.justify-content-between > button.primary-btn.fix-gr-bg')
                ->assertPathIs('/upload-content');
            })   
            ->waitFor('.toast-message',5)
            ->assertSee('Operation successful');    

        });
    }




}
