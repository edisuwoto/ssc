<?php

namespace Tests\Browser\FeesCollection;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FeesGroupTest extends DuskTestCase
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
                    ->visit('/login')
                    ->type('email','admin@infixedu.com')
                    ->type('password','123456')
                    ->click('#btnsubmit')
                    ->waitForText('Welcome')
                    ->assertSee('Welcome');
        });
    }
    public function testAddFeeGroupTest()
    {
        $this->browse(function (Browser $browser) {
            $browser
                    ->visit('/fees-group')
                    ->type('name','A')
                    ->type('description','AA')
                    ->waitFor('.toast-message',5)
                    ->assertSee('Operation successful');
        });
    }
    public function testBAddFeeGroupTest()
    {
        $this->browse(function (Browser $browser) {
            $browser
                    ->visit('/fees-group')
                    ->type('name','B')
                    ->type('description','AA')
                    ->waitFor('.toast-message',5)
                    ->assertSee('Operation successful');
        });
    }
    public function testCAddFeeGroupTest()
    {
        $this->browse(function (Browser $browser) {
            $browser
                    ->visit('/fees-group')
                    ->type('name','C')
                    ->type('description','AA')
                    ->waitFor('.toast-message',5)
                    ->assertSee('Operation successful');
        });
    }


}
