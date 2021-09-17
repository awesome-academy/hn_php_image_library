<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\LoginPage;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    public function testLoginFailed()
    {
        $email = "user@gmail.com";
        $password = "vdfghbdfg";

        $this->browse(function (Browser $browser) use ($email, $password) {
            $browser->visit(new LoginPage())
                ->signIn($email, $password)
                ->assertSee('These credentials do not match our records.');
        });
    }

    public function testLoginSuccessfully()
    {
        $email = "user@gmail.com";
        $password = "123456";

        $this->browse(function (Browser $browser) use ($email, $password) {
            $browser->visit(new LoginPage())
                ->signIn($email, $password)
                ->assertAuthenticated();
        });
    }

    public function testForgotPasswordButtonClick()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new LoginPage())
                ->press('#forgot_btn')
                ->assertPathIs(route('password.reset'))
                ->back();
        });
    }

    public function testLoginButtonClick()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new LoginPage())
                ->press('#login_btn')
                ->assertPathIs(route('login'))
                ->back();
        });
    }

    public function testRegisterButtonClick()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new LoginPage())
                ->press('#register_btn')
                ->assertPathIs(route('register'))
                ->back();
        });
    }

    public function testLogoButtonClick()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new LoginPage())
                ->press('.navbar-brand')
                ->assertPathIs(route('home'))
                ->back();
        });
    }
}
