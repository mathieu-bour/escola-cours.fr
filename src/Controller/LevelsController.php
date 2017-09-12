<?php

namespace App\Controller;

use App\Model\Table\LevelsTable;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

/**
 * Levels Controller
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller
 * @property LevelsTable $Levels
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