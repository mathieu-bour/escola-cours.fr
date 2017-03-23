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

    public function display($template)
    {
        $this->render($template);
    }
}