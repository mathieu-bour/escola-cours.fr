<?php

namespace App\Controller\Admin;

use App\Model\Table\UsersTable;
use Cake\ORM\Query;

/**
 * Class UsersController
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller\Admin
 * @property UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Students page
     *
     * @param null $action
     */
    public function students($action = null)
    {
        if ($action == 'list') {
            $this->json(
                $this->Users->find()
                    ->where(['type' => 'student'])
                    ->orderAsc('lastname')
            );
        } else {
            $data = $this->DataTables->find('Users', 'all', [
                'contain' => [
                    'Courses',
                    'Courses.Disciplines',
                    'Courses.Levels'
                ],
                'conditions' => [
                    'type' => 'student'
                ]
            ]);

            $this->setTitle('Tous les élèves');

            $this->set([
                'data' => $data,
                '_serialize' => array_merge($this->viewVars['_serialize'], ['data'])
            ]);
        }
    }

    /**
     * Students page
     *
     * @param int|null $level_id the level id
     * @param  int|null $discipline_id the discipline id
     */
    public function teachers($level_id = null, $discipline_id = null)
    {
        if ($this->request->is('json') && !empty($level_id) && !empty($discipline_id)) {
            $this->json(
                $this->Users->find()
                    ->innerJoinWith('Courses', function (Query $q) use ($level_id, $discipline_id) {
                        return $q->where([
                            'Courses.level_id' => $level_id,
                            'Courses.discipline_id' => $discipline_id
                        ]);
                    })
                    ->where(['type' => 'teacher'])
                    ->orderAsc('lastname')
            );
        } else {
            $data = $this->DataTables->find('Users', 'all', [
                'contain' => [
                    'Courses',
                    'Courses.Disciplines',
                    'Courses.Levels'
                ],
                'conditions' => [
                    'type' => 'teacher'
                ]
            ]);

            $this->setTitle('Tous les professeurs');

            $this->set([
                'data' => $data,
                '_serialize' => array_merge($this->viewVars['_serialize'], ['data'])
            ]);
        }
    }

    /**
     * Add user
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $user = $this->Users->newEntity($data, ['associated' => ['Courses']]);

            if ($this->Users->save($user)) {
                $this->Flash->success('Utilisateur enregistré');
            } else {
                $this->Flash->error('');
            }

            return $this->redirect(['controller' => 'users', 'action' => $user->type . 's']);
        }
    }

    /**
     * Edit a user
     *
     * @param int $id
     *
     * @return \Cake\Http\Response|null
     */
    public function edit(int $id)
    {
        $user = $this->Users->find()->contain(['Courses'])->where(['id' => $id])->first();

        if ($this->request->is('get')) {
            $this->loadModel('Levels');
            $this->loadModel('Disciplines');

            $this->set([
                'user' => $user,
                'levels' => $this->Levels->find('list'),
                'disciplines' => $this->Disciplines->find('list')
            ]);
        }

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $user = $this->Users->patchEntity($user, $data, ['associated' => ['Courses']]);

            if ($this->Users->save($user)) {
                $this->Flash->success('Utilisateur modifié avec succès');
            } else {
                $this->Flash->error('Erreur lors de la modification');
            }

            return $this->redirect(['controller' => 'users', 'action' => $user->type . 's']);
        }
    }
}