<?php
namespace App\Controller;

use Cake\Event\Event;

class PagesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow(['home']);
    }

    public function home()
    {

    }

    public function about()
    {

    }
}