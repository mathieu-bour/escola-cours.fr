<?php

namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\I18n\Time;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\UsersController Test Case
 */
class UsersControllerTest extends IntegrationTestCase
{
    public $fixtures = ['app.users'];

    /*= Public action get
     *=====================================================*/
    public function testRegister()
    {
        $this->get('/users/register');
        $this->assertResponseOk();
    }

    public function testRegisterPostData()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post('/users/register', [
            'type' => 'student',
            'email' => 'registerstudent@gmail.com',
            'new_password' => 'password',
            'new_password_confirm' => 'password',
            'lastname' => 'Student',
            'firstname' => 'Test',
            'telephone' => '0612345678',
            'address' => '15 rue des Tests',
            'zip_code' => '00000',
            'city' => 'Test City'
        ]);
        $this->assertResponseSuccess();
    }

    public function testRegisterBadPostData()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post('/users/register', []);
        $this->assertResponseError();
    }

    public function testLogin()
    {
        $this->get('/users/login');
        $this->assertResponseOk();
    }

    public function testSucessfulLogin()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post('/users/login', ['email' => 'john.doe@gmail.com', 'password' => 'password']);
        $this->assertResponseSuccess();
    }

    public function testLoginBadCredentials()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post('/users/login', ['email' => 'john.doe@gmail.com', 'password' => 'wrong']);
        $this->assertResponseError();
    }

    public function testForgot()
    {
        $this->get('/users/forgot');
        $this->assertResponseOk();
    }

    public function testForgotExistingEmail()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post('/users/forgot', ['email' => 'john.doe@gmail.com']);
        $this->assertResponseOk();
    }

    public function testNotExistingEmail()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post('/users/forgot', ['email' => 'john.wrong@gmail.com']);
        $this->assertResponseError();
    }
}
