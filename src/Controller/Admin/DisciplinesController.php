<?php

namespace App\Controller\Admin;

use App\Model\Table\DisciplinesTable;

/**
 * Class DisciplinesController
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller\Admin
 *
 * @property DisciplinesTable $Disciplines
 */
class DisciplinesController extends AppController
{
    public function add()
    {
        if ($this->request->is('post')) {
            $level = $this->Disciplines->newEntity($this->request->getData());
            if ($this->Disciplines->save($level)) {
                $this->Flash->success('La discipline a bien été sauvegardé');
            } else {
                $this->Flash->error('Erreur lors de la sauvegarde de la discipline');
            }
        }

        $this->redirect(['controller' => 'pages', 'action' => 'settings']);
    }
}