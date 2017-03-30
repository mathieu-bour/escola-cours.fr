<?php
namespace App\Controller;

use Cake\Event\Event;

/**
 * Class PagesController
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller
 */
class PagesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['home', 'about', 'cgv', 'cgu']);

        return parent::beforeFilter($event);
    }

    public function home()
    {
    }

    public function about()
    {
        $this->setTitle('À propos');
    }

    public function cgu()
    {
    }

    public function cgv()
    {
    }

    public function contact()
    {
    }
}