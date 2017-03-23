<?php
namespace App\Controller;

use App\Model\Entity\Slot;
use App\Model\Entity\User;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\LevelsTable $Levels
 * @property \App\Model\Table\DisciplinesTable $Disciplines
 */
class UsersController extends AppController
{
    /*= Hooks
     *=====================================================*/
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['login', 'register']);
        return parent::beforeFilter($event);
    }

    /*= Actions
     *=====================================================*/
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
        if ($this->request->is('post')) {
            debug($this->request->getData());
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error('Vos identifiants sont incorrects', [
                    'key' => 'auth'
                ]);
            }
        }

        $this->setTitle('Connexion');
    }

    /**
     * Logout page
     */
    public function logout()
    {
        $this->Auth->logout();
        $this->redirect($this->Auth->redirectUrl());
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
                ->select(['Users.id', 'Users.email', 'Users.lastname', 'Users.firstname', 'Users.telephone',
                    'Users.address', 'Users.zip_code', 'Users.city'])
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
            ->select(['Users.id', 'Users.email', 'Users.lastname', 'Users.firstname', 'Users.telephone',
                'Users.address', 'Users.zip_code', 'Users.city'])
            ->contain(['Courses'])
            ->where(['id' => $this->Auth->user('id')])
            ->first();

        $levels = $this->Levels->find('list');
        $disciplines = $this->Disciplines->find('list');

        $this->set(compact('user', 'levels', 'disciplines'));
        $this->setTitle('Mon compte');
    }

    /**
     * Change user slots
     */
    public function slots()
    {
        if ($this->request->is(['post', 'put'])) {
            // Format raw slots to an entity-friendly array
            $rawSlots = $this->request->getData('slots');
            ksort($rawSlots);

            $newSlots = [];
            foreach ($rawSlots as $day => $hours) {
                foreach ($hours as $hour => $value) {
                    $newSlots[] = [
                        'day' => $day,
                        'hour' => $hour,
                        'user_id' => $this->Auth->user('id')
                    ];
                }
            }

            // Get the existing slots as array
            $existingSlots = $this->Users->Slots->find()
                ->where(['user_id' => $this->Auth->user('id')])
                ->toArray();
            foreach ($existingSlots as $key => $existingSlot) {
                /** @var Slot $existingSlot */
                $existingSlot = $existingSlot->toArray();
                unset($existingSlot['id']);

                $newKey = array_search_recursive($existingSlot, $newSlots);

                if (!empty($newKey)) {
                    unset($existingSlots[$key]);
                    unset($newSlots[$newKey]);
                }
            }

            // Compare existing slots and submitted slots to get the slot ids to remove
            $existingSlotIdsToRemove = [];
            foreach ($existingSlots as $existingSlot) {
                $existingSlotIdsToRemove[] = $existingSlot['id'];
            }

            // Delete obsolete slots
            if (!empty($existingSlotIdsToRemove)) {
                $this->Users->Slots->deleteAll(['id IN' => $existingSlotIdsToRemove]);
            }

            $slots = $this->Users->Slots->newEntities($newSlots); // Build entities

            if ($this->Users->Slots->saveMany($slots)) {
                unset($slots);
                $this->Flash->success('Vos disponibilités on été mises à jour');
            } else {
                $this->Flash->error('Erreur lors de la mise à jour de vos disponibilités');
            }
        }

        // Retrieve user slots
        $rawSlots = $this->Users->Slots->find()->where(['user_id' => $this->Auth->user('id')])->toArray();
        foreach ($rawSlots as $rawSlot) {
            $slots[$rawSlot['day']][$rawSlot['hour']] = true;
        }

        $this->set(compact('slots'));

        $this->setTitle('Disponibilités');
    }
}
