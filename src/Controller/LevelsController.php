<?php

namespace App\Controller;

use Cake\Event\Event;

/**
 * Levels Controller
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller
 *
 * @property \App\Model\Table\LevelsTable $Levels
 */
class LevelsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index']);

        return parent::beforeFilter($event);
    }

    /**
     * JSON-only
     * Return all Levels available
     */
    public function index()
    {
        $levels = $this->Levels->find('list')->toArray();
        $this->set($levels);
    }
}