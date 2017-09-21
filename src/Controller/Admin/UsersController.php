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
            $user = $this->request->getData();
            $courses = json_decode($user['courses'], true);

            $user = $this->Users->newEntity($user);
            unset($user['courses']);

            $user = $this->Users->save($user);

            foreach ($courses as $key => $course) {
                $courses[$key]['user_id'] = $user->id;
            }
            $courses = $this->Users->Courses->newEntities($courses);
            $this->Users->Courses->saveMany($courses);

            $this->redirect(['controller' => 'users', 'action' => 'teachers']);
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
        $user = $this->Users->get($id);

        if ($this->request->is('get')) {
            $this->set('user', $user);
        }

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $user = $this->Users->patchEntity($user, $data);

            if ($this->Users->save($user)) {
                $this->Flash->success('Utilisateur modifié avec succès');
            } else {
                $this->Flash->error('Erreur lors de la modification');
            }

            return $this->redirect(['controller' => 'users', 'action' => $user->type . 's']);
        }
    }
}