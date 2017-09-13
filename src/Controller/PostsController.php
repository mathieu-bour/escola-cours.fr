<?php

namespace App\Controller;

use Cake\Event\Event;

/**
 * Class PostsController
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller
 */
class PostsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index']);

        return parent::beforeFilter($event);
    }

    public function index()
    {
        $this->setTitle('Blog');
        $this->setDescription('Blog');
    }
}