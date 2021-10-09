<?php

namespace Tests\Browser\AdminSection;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdmissionQueryTest extends DuskTestCase
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
  public function testAddAdmissionQuery(){
      $this->browse(function (Browser $browser){
          $browser
          ->visit('/admission-query')
          ->click('#main-content > section.admin-visitor-area.up_admin_visitor > div > div.row.align-items-center > div.col-lg-4.text-md-right.col-md-6.mb-30-lg.col-6.text-right > button')
          ->whenAvailable('#admission-query-store > div',function($modal){
              $modal
              ->type('name','abu')
              ->type('phone','019949414663')
              ->type('email','apn20@spondonit.com')
              ->type('address','narsingdi')
              ->type('description','nothing to say')           
              ->type('assigned','nayem')
              ->click('div > div > div:nth-child(4) > div > div:nth-child(1) > div')
              ->click('div > div > div:nth-child(4) > div > div:nth-child(1) > div > ul > li:nth-child(2)')
              ->click('div > div > div:nth-child(4) > div > div:nth-child(2) > div')
              ->click('div > div > div:nth-child(4) > div > div:nth-child(2) > div > ul > li:nth-child(2)')
              ->click('div > div > div:nth-child(4) > div > div:nth-child(3) > div')
              ->click('div > div > div:nth-child(4) > div > div:nth-child(3) > div > ul > li:nth-child(2)')
              ->type('no_of_child',2)
              ->click('#save_button_query')
              ->assertPathIs('/admission-query');            
          })                           
          ->waitFor('.toast-message',5)
          ->assertSee('Operation successful');
      });
  }

}
