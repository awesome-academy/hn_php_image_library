<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class RegisterPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/register';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param \Laravel\Dusk\Browser $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->visit($this->url())
            ->assertSee('Register')
            ->assertPresent('#name')
            ->assertPresent('#email')
            ->assertPresent('#password')
            ->assertPresent('#password-confirm')
            ->assertPresent('button[type=submit]');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@email' => '#email',
            '@pass' => '#password',
            '@confirm' => '#password-confirm',
            '@name' => '#name',
            '@register' => 'button[type=submit]',
        ];
    }

    public function register(Browser $browser, $name, $email, $password)
    {
        $browser->type('@name', $name)
            ->type('@email', $email)
            ->type('@pass', $password)
            ->type('@confirm', $password)
            ->press('@register');
    }
}
