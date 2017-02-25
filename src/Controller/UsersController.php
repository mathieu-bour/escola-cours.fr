<?php
namespace App\Controller;

use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow(['login', 'register']);
    }

    public function register()
    {
        if ($this->request->is('post')) {
            $user = $this->request->getData();
            $courses = json_decode($user['courses'], true);

            $user = $this->Users->newEntity($user);
            unset($user['courses']);
            debug($user);
            debug($courses);
            die();
        }
    }

    public function login()
    {

    }

    public function forgot_password()
    {

    }

    public function profile()
    {

    }

    public function account()
    {

    }
}
