<?php

namespace App\Controller\Admin;

use App\Model\Table\CoursesTable;

/**
 * Class CoursesController
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller\Admin
 *
 * @property CoursesTable $Courses
 */
class CoursesController extends AppController
{
    /*= JSONAPI
     *=====================================================*/
    /**
     * Get courses based on user id
     * @param int $userId the user id
     */
    public function user($userId)
    {
        $this->json(
            $this->Courses->find()
                ->contain(['Disciplines', 'Levels'])
                ->where(['user_id' => $userId])
        );
    }
}