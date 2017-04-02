<?php

namespace App\Controller\Admin;

use App\Model\Table\LevelsTable;

/**
 * Class LevelsController
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller\Admin
 *
 * @property LevelsTable $Levels
 */
class LevelsController extends AppController
{
    public function add()
    {
        if ($this->request->is('post')) {
            $level = $this->Levels->newEntity($this->request->getData());
            if ($this->Levels->save($level)) {
                $this->Flash->success('Le niveau a bien été sauvegardé');
            } else {
                $this->Flash->error('Erreur lors de la sauvegarde du niveau');
            }
        }

        $this->redirect(['controller' => 'pages', 'action' => 'settings']);
    }
}