<?php
namespace App\Controller;

use App\Model\Entity\User;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\LevelsTable $Levels
 * @property \App\Model\Table\DisciplinesTable $Disciplines
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow(['login', 'register']);
    }

    /**
     * Register a user
     */
    public function register()
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
        }

        $this->setTitle('Inscription');
    }

    /**
     * Login page
     */
    public function login()
    {
        $this->setTitle('Connexion');

        if ($this->request->is('post')) {
            debug($this->request->getData());
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error('Vos identifiants sont incorrects', [
                    'key' => 'auth'
                ]);
            }
        }
    }

    public function profile()
    {

    }

    public function logout()
    {
        $this->Auth->logout();
        return $this->redirect($this->Auth->redirectUrl());
    }

    /**
     * Account page
     */
    public function account()
    {
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $data['courses'] = json_decode($data['courses'], true);

            /** @var User */
            $user = $this->Users->find()
                ->contain(['Courses'])
                ->select([
                    'Users.id', 'Users.email', 'Users.lastname', 'Users.firstname', 'Users.telephone', 'Users.address', 'Users.zip_code', 'Users.city'
                ])
                ->where(['id' => $this->Auth->user('id')])
                ->first();

            // Get existing course ids
            $userExistingCourseIds = [];
            foreach ($user->courses as $course) {
                $userExistingCourseIds[] = $course->id;
            }

            // Get new course ids
            /** @var User */
            $user = $this->Users->patchEntity($user, $data, ['associated' => ['Courses']]);
            $userNewCourseIds = [];
            foreach ($user->courses as $course) {
                if (!empty($course->id)) {
                    $userNewCourseIds[] = $course->id;
                }
            }

            // Calculate obsolete course ids
            $userCourseIdsToRemove = array_diff($userExistingCourseIds, $userNewCourseIds);

            // Remove them if they exist
            if (!empty($userCourseIdsToRemove)) {
                $this->Users->Courses->deleteAll(['id IN' => $userCourseIdsToRemove]);
            }

            if ($this->Users->save($user)) {
                $this->Flash->success('Votre compte a été mis à jour');
            } else {
                $this->Flash->success('Erreur lors de la mise à jour de votre compte');
            }
        }

        // Load required models
        $this->loadModel('Levels');
        $this->loadModel('Disciplines');

        $user = $this->Users->find()
            ->select([
                'Users.id', 'Users.email', 'Users.lastname', 'Users.firstname', 'Users.telephone', 'Users.address', 'Users.zip_code', 'Users.city'
            ])
            ->contain(['Courses'])
            ->where(['id' => $this->Auth->user('id')])
            ->first();

        $levels = $this->Levels->find('list');
        $disciplines = $this->Disciplines->find('list');

        $this->set(compact('user', 'levels', 'disciplines'));
        $this->setTitle('Mon compte');
    }
}
