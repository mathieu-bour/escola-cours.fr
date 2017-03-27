<?php

namespace App\Controller\Admin;

use App\Model\Table\LessonsTable;

/**
 * Class LessonsController
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller\Admin
 *
 * @property LessonsTable $Lessons
 */
class LessonsController extends AppController
{
    public function index()
    {
        $data = $this->DataTables->find('Lessons', 'all', [
            'contain' => [
                'Teachers',
                'Users',
                'Disciplines',
                'Levels'
            ],
            'conditions' => [
                'Lessons.id >' => 0
            ]
        ]);

        $this->setTitle('Tous les élèves');

        $this->set([
            'data' => $data,
            '_serialize' => array_merge($this->viewVars['_serialize'], ['data'])
        ]);
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $course = explode('/', $data['course']);
            unset($data['course']);
            $data['level_id'] = $course[0];
            $data['discipline_id'] = $course[1];

            $lesson = $this->Lessons->newEntity($data);

            if ($this->Lessons->save($lesson)) {
                $this->Flash->success('Cours enregistré avec succès');
                $this->redirect(['controller' => 'lessons', 'action' => 'index']);
            } else {
                $this->Flash->error('Erreur lors de l\'enregistrement du cours');
            }
        }
    }
}