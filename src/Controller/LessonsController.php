<?php
namespace App\Controller;

use Cake\Network\Exception\UnauthorizedException;

/**
 * Lessons Controller
 *
 * @property \App\Model\Table\LessonsTable $Lessons
 */
class LessonsController extends AppController
{
    public function search()
    {

    }


    /**
     * (student side)
     * Book a lesson for a student (or many)
     * @param int $id
     */
    public function book(int $id)
    {

    }


    /**
     * (teacher side)
     * Display all lessons
     */
    public function index()
    {

    }

    /**
     * Edit a lesson
     * @param int $id the lesson id
     * @return \Cake\Network\Response|null
     */
    public function edit(int $id)
    {
        $this->_checkOwnership($id);

        // POST data
        if ($this->request->is('post')) {
            $lesson = $this->Lessons->newEntity($this->request->getData());
            $this->Lessons->save($lesson);

            return $this->redirect([
                'action' => 'index'
            ]);
        }

        $lesson = $this->Lessons->get('id');

        $this->set([
            'lesson' => $lesson
        ]);

        return null;
    }


    /**
     * Delete a lesson
     * @param int $id the lesson id
     * @return \Cake\Network\Response|null
     */
    public function delete(int $id)
    {
        return $this->redirect([
            'action' => 'index'
        ]);
    }


    /**
     * Check the lesson's ownership by id using the current user informations
     * @param int $id the lesson_id
     */
    private function _checkOwnership(int $id)
    {
        $this->_checkOwnership($id);

        $lesson = $this->Lessons->get($id);

        if (!in_array($this->Auth->user('id'), $lesson->getUsersIds())) {
            throw new UnauthorizedException();
        }
    }
}