<?php
namespace App\Controller;

use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
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

    public function account()
    {
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $data['courses'] = json_decode($data['courses'], true);

            $user = $this->Users->get($this->Auth->user('id'));
            $user = $this->Users->patchEntity($user, $data, ['associated' => ['Courses']]);
            $this->Users->Courses->deleteAll(['user_id' => $user->id]);

            if($this->Users->save($user)) {
                $this->Flash->success('Votre compte a été mis à jour');
            }
        }

        $user = $this->Users->find()
            ->contain([
                'Courses.Levels',
                'Courses.Disciplines'
            ])
            ->where(['id' => $this->Auth->user('id')])
            ->first();
        unset($user->password);
        $this->set('user', $user);
        $this->setTitle('Mon compte');
    }
}
