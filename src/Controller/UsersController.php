<?php

namespace App\Controller;

use App\Model\Entity\Slot;
use App\Model\Entity\User;
use Aura\Intl\Exception;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use Cake\Mailer\MailerAwareTrait;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Utility\Text;

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
    use MailerAwareTrait;

    /*= Hooks
     *=====================================================*/
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['login', 'register', 'forgot', 'reset']);
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
            $user['courses'] = !empty($user['courses']) ? json_decode($user['courses'], true) : [];

            $user = $this->Users->newEntity($user, ['associated' => ['Courses']]);

            if ($this->Users->save($user)) {
                $this->Flash->success('Votre inscription a bien été prise en compte, vous pouvez dès lors vous connecter.');
                $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else {
                $this->Flash->success('Erreur lors de votre inscription');
            }
        }

        $this->setTitle('Inscription');
    }

    /**
     * Login page
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error('Vos identifiants sont incorrects');
                $this->response = $this->response->withStatus(403);
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
     * Password forgot page
     */
    public function forgot()
    {
        if ($this->request->is('post')) {
            $user = $this->Users->find()
                ->where(['email' => $this->request->getData('email')])
                ->first();

            if (empty($user)) {
                $this->Flash->error('Nous n\'avons pas pu trouver votre adresse e-mail, veuiller réessayer');
                $this->response = $this->response->withStatus(404);
            } else {
                // Regenerate token
                $user = $this->Users->patchEntity($user, ['token' => Text::uuid()]);

                if ($this->Users->save($user)) {
                    $this->getMailer('User')->send('resetPassword', [$user]);
                    $this->Flash->success('Nous vous avons envoyé un e-mail contenant des instructions pour récupérer votre compte');
                }
            }
        }

        $this->setTitle('Mot de passe oublié');
    }

    /**
     * Reset a password
     * @param $token
     */
    public function reset(string $token)
    {
        $user = $this->Users->find()
            ->where(['token' => $token])
            ->first();

        if (empty($user)) {
            throw new RecordNotFoundException('Ce lien n\'est pas lié à un utilisateur ou a expiré.');
        } else if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['token'] = null;
            $user = $this->Users->patchEntity($user, $data);
            $this->Users->save($user);
        }

        $this->setTitle('Réinitialisation du mot de passe');
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
                $this->Flash->error('Erreur lors de la mise à jour de votre compte');
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
