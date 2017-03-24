<?php

namespace App\Controller;

use Cake\Event\Event;

/**
 * Disciplines Controller
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller
 *
 * @property \App\Model\Table\DisciplinesTable $Disciplines
 */
class DisciplinesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index']);

        return parent::beforeFilter($event);
    }

    /**
     * JSON-only
     * Return all disciplines available
     */
    public function index()
    {
        $this->request->allowMethod(['json', 'ajax']);

        if ($this->request->is(['json', 'ajax'])) {
            $disciplines = $this->Disciplines->find('list')->toArray();
            $this->set($disciplines);
        }
    }
}