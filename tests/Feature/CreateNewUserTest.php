<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreateNewUserTest extends TestCase
{
    /**
     * Given I am on the sign page
     * When I am login with valid credentials
     * Then I should be on the dashboard page
     */
    public function test_login_and_see_dashboard_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response = $this->post('/auth', [
            'email' => 'super.admin@email.com',
            'password' => 'ukm12345*',
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');
    }

    /**
     * When I clicks on manage user navigation
     * Then I should be on the user management page
     * And the user table data should be initially empty or match the predefined data
     */
    public function test_see_user_page()
    {
        //  Login
        $response = $this->get('/');
        $response->assertStatus(200);
        $response = $this->post('/auth', [
            'email' => 'super.admin@email.com',
            'password' => 'ukm12345*',
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');

        //  Clicks users page
        $response = $this->get('/users');
        $response->assertStatus(200);
        $response->assertSee('Akun Pendaftar');
    }

    /**
     * When I open the add user button
     * Then it should appears an user form modal
     * And the add user form should have the required properties
     * When I save a new user with the following details:
     * | email          | name   | password   |
     * | user@email.com | User 1 | mYP@ssW0Rd |
     */
    public function test_create_user()
    {
        //  Login
        $response = $this->get('/');
        $response->assertStatus(200);
        $response = $this->post('/auth', [
            'email' => 'super.admin@email.com',
            'password' => 'ukm12345*',
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');

        //  Clicks users page
        $response = $this->get('/users');
        $response->assertStatus(200);

        //  Insert user
        $response->assertDontSee('Add User Modal');
        $response = $this->post('users/store', [
            'email'     => 'bcabca@email.com',
            'password'  => '123123',
            'name'      => 'John Wicko'
        ]);
    }

    /**
     * The table dataset should contain the new user
     */
    public function test_user_after_insertion()
    {
        //  Login
        $response = $this->get('/');
        $response->assertStatus(200);
        $response = $this->post('/auth', [
            'email' => 'super.admin@email.com',
            'password' => 'ukm12345*',
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');

        //  Clicks users page
        $response = $this->get('/users');
        $response->assertStatus(200);

        //  See updated data
        $this->assertDatabaseHas('users', [
            'email' => 'bcabca@email.com'
        ]);
        $this->assertDatabaseHas('user_details', [
            'name' => 'John Wicko'
        ]);
    }
}
