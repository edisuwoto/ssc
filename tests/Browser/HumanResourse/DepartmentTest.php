<?php

namespace Tests\Browser\HumanResourse;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\SmHumanDepartment;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DepartmentTest extends DuskTestCase
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
    public function testAddNewDep(){
        $this->browse(function (Browser $browser){
            $browser
                ->visit('department')
                ->type('name','Faculty')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
        });
    }
    public function testEditNewDes(){
      
        $this->browse(function (Browser $browser){
            $department = SmHumanDepartment::latest()->first();
            $browser
                ->visit('department')
                ->click('#table_id > tbody > tr.odd > td:nth-child(2) > div > button')
                ->click('#table_id > tbody > tr.odd > td:nth-child(2) > div > div > a:nth-child(1)')
                //  ->assertPathIs('/department/'.$department->id)
                ->type('name','Faculty')
                ->click('#main-content > section.admin-visitor-area.up_st_admin_visitor > div > div:nth-child(2) > div.col-lg-3 > div > div > form > div > div > div.row.mt-40 > div > button')
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
        });
    }

    public function testDeleteDep(){
        $this->browse(function (Browser $browser){
            $browser
                // ->loginAs(1)
                ->visit('department')
                ->click('#table_id > tbody > tr.even > td:nth-child(2) > div > button')            
                ->click('#table_id > tbody > tr.even > td:nth-child(2) > div > div > a:nth-child(2)')               
                ->whenAvailable('#deleteHumanDepartModal2 > div > div > div.modal-body', function ($modal) {
                    $modal
                 ->click('div.mt-40.d-flex.justify-content-between > button.primary-btn.fix-gr-bg')
                 ->assertPathIs('/department');
                 })
                 
                ->waitFor('.toast-message',5)
                ->assertSee('Operation successful');
              
        });
    
    }
}
