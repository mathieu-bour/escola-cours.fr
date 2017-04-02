<?php

namespace App\Controller;

use App\Model\Table\DisciplinesTable;
use Cake\Event\Event;

/**
 * Disciplines Controller
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller
 *
 * @property DisciplinesTable $Disciplines
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
        $this->request->allowMethod(['json']);

        if ($this->request->is(['json'])) {
            $disciplines = $this->Disciplines->find('list')->toArray();
            $this->set($disciplines);
        }
    }
}