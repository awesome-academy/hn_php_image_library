<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\RegisterPage;
use Tests\DuskTestCase;
use Illuminate\Support\Str;

class RegisterTest extends DuskTestCase
{
    public function testRegisterFailed()
    {
        $name = "Mai Duc Quang";
        $email = 'user@gmail.com';
        $password = "w12e12ed";

        $this->browse(function (Browser $browser) use ($name, $email, $password) {
            $browser->visit(new RegisterPage())
                ->register($name, $email, $password)
                ->assertSee('The email has already been taken.');
        });
    }

    public function testRegisterSuccessfully()
    {
        $name = "Mai Duc Quang";
        $email = Str::random(10) . '@gmail.com';
        $password = "w12e12ed";

        $this->browse(function (Browser $browser) use ($name, $email, $password) {
            $browser->visit(new RegisterPage())
                ->register($name, $email, $password)
                ->assertPathIs(route('home'));
        });
    }

    public function testLoginButtonClick()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new RegisterPage())
                ->press('#login_btn')
                ->assertPathIs(route('login'))
                ->back();
        });
    }

    public function testRegisterButtonClick()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new RegisterPage())
                ->press('#register_btn')
                ->assertPathIs(route('register'))
                ->back();
        });
    }

    public function testLogoButtonClick()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new RegisterPage())
                ->press('.navbar-brand')
                ->assertPathIs(route('home'))
                ->back();
        });
    }
}
