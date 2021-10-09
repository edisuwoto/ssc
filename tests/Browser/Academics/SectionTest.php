<?php

namespace Tests\Browser\Academics;

use App\User;
use App\SmSection;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SectionTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testWithLogin()
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

    
    // public function testAcademicYearSection(){
    //     $this->browse(function (Browser $browser) {
    //         $browser
    //             // ->loginAs(1)
    //             ->visit('section')
    //             ->type('name','E')
    //             ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
    //             ->waitFor('.toast-message',10)
    //             ->assertSee('Create academic year first');
            
    //     });
    // }

    // public function testDuplicateSection(){
    //     $this->browse(function (Browser $browser) {
    //         $browser
    //             // ->loginAs(1)
    //             ->visit('section')
    //             ->type('name','E')
    //             ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
    //             ->waitFor('.toast-message',5)
    //             ->assertSee('Duplicate section name found');
            
    //     });
    // }

    public function testSectionA(){
        $this->browse(function (Browser $browser) {
            $browser
                // ->loginAs(1)
                ->visit('section')
                ->type('name','A')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
        });
    }
    public function testSectionB(){
        $this->browse(function (Browser $browser) {
            $browser
                // ->loginAs(1)
                ->visit('section')
                ->type('name','B')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
        });
    }
    public function testSectionC(){
        $this->browse(function (Browser $browser) {
            $browser
                // ->loginAs(1)
                ->visit('section')
                ->type('name','C')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
        });
     }
    public function testSectionD(){
        $this->browse(function (Browser $browser) {
            $browser
                // ->loginAs(1)
                ->visit('section')
                ->type('name','D')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
        });
    }
    public function testSectionEdit(){
        $this->browse(function (Browser $browser){
            $browser
                 ->loginAs(User::find(1))
                ->visit('section')
                ->click('#table_id > tbody > tr:nth-child(4) > td:nth-child(2) > div > button') 
                ->pause(2000)             
                ->click('#table_id > tbody > tr:nth-child(4) > td:nth-child(2) > div > div > a:nth-child(1)')  
                ->assertSee('Edit Section')          
                ->type('name','I')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div:nth-child(2) > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
              
        });
    }

    // public function testSectionUpdateDuplicate(){
    //     $this->browse(function (Browser $browser){
    //         $browser
    //             // ->loginAs(1)
    //             ->visit('section')
    //             ->click('#table_id > tbody > tr:nth-child(4) > td:nth-child(2) > div > button')
    //             ->waitForText('Edit')
    //             ->click('#table_id > tbody > tr:nth-child(4) > td:nth-child(2) > div > div > a:nth-child(1)')
    //             ->waitForText('Edit Section')
    //             ->type('name','DD')
    //             ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div:nth-child(2) > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
    //             ->waitFor('.toast-message')
    //             ->assertSee('Duplicate section name found!');
              
    //     });
    // }

    public function testSectionDelete(){

        $this->browse(function (Browser $browser){
            $section=SmSection::latest()->first();
            $browser
                // ->loginAs(1)
                ->visit('section')
                ->click('#table_id > tbody > tr:nth-child(4) > td:nth-child(2) > div > button')   
                ->pause(2000)         
                ->click('#table_id > tbody > tr:nth-child(4) > td:nth-child(2) > div > div > a:nth-child(2)')               
                ->whenAvailable('#deleteSectionModal'.$section->id.' > div > div > div.modal-body', function ($modal) {
                    $modal
                 ->click('div.mt-40.d-flex.justify-content-between > a > button')
                 ->assertPathIs('/section');
                 })
                 
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
              
        });
    }

    // public function testSectionUsedSectionDelete(){

    //     $this->browse(function (Browser $browser){
    //         $browser
    //              // ->loginAs(1)
    //              ->visit('section')
    //              ->click('#table_id > tbody > tr:nth-child(1) > td:nth-child(2) > div > button')               
    //              ->click('#table_id > tbody > tr:nth-child(1) > td:nth-child(2) > div > div > a:nth-child(2)')               
    //              ->whenAvailable('#deleteSectionModal1 > div > div > div.modal-body', function ($modal) {
    //                  $modal
    //               ->click('div.mt-40.d-flex.justify-content-between > a > button')
    //               ->assertPathIs('/section');
    //               })
                  
    //              ->waitFor('.toast-message',5)
    //             ->assertSee('This data already used');
              
    //     });
    // }
}
