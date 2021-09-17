<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class LoginPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/login';
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
            ->assertSee('Login')
            ->assertPresent('#email')
            ->assertPresent('#password')
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
            '@login' => 'button[type=submit]',
        ];
    }

    public function signIn(Browser $browser, $email, $password)
    {
        $browser->type('@email', $email)
            ->type('@pass', $password)
            ->press('@login');
    }
}
