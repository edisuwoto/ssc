<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
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
    public function testDashboardWithAuth()
    {
       

            $this->browse(function (Browser $browser) {
                $browser
                    ->loginAs(1)
                    ->visit('dashboard')
                    ->waitForText('Welcome')
                    ->assertSee('dashboard');
            });

      
    }
    


    public function testSection(){
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs(1)
                ->visit('section')
                ->waitForText('Add Section')
                ->assertSee('section');
        });
    }
}
