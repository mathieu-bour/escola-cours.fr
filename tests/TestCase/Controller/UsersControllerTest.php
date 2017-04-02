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

    /*= Register
     *=====================================================*/
    public function testRegisterGet()
    {
        $this->get('/users/register');
        $this->assertResponseOk();
    }

    public function testRegisterPostWithoutCourses()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post('/users/register', [
            'type' => 'student',
            'email' => 'student@gmail.com',
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

    public function testRegisterPostWithCourses()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post('/users/register', [
            'type' => 'teacher',
            'email' => 'teacher@gmail.com',
            'new_password' => 'password',
            'new_password_confirm' => 'password',
            'lastname' => 'Teacher',
            'firstname' => 'Test',
            'telephone' => '0612345678',
            'address' => '15 rue des Tests',
            'zip_code' => '00000',
            'city' => 'Test City',
            'courses' => [
                ['disicpline_id' => 1, 'level_id' => 1],
                ['disicpline_id' => 2, 'level_id' => 1],
                ['disicpline_id' => 3, 'level_id' => 1]
            ]
        ]);
        $this->assertResponseSuccess();
    }

    public function testRegisterPostInvalidData()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post('/users/register', []);
        $this->assertResponseError();
    }

    /*= Login
     *=====================================================*/
    public function testLoginGet()
    {
        $this->get('/users/login');
        $this->assertResponseOk();
    }

    public function testLoginPostValid()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post('/users/login', ['email' => 'john.doe@gmail.com', 'password' => 'password']);
        $this->assertResponseSuccess();
    }

    public function testLoginPostInvalid()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post('/users/login', ['email' => 'john.doe@gmail.com', 'password' => 'wrong']);
        $this->assertResponseError();
    }

    /*= Forgot
     *=====================================================*/
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
