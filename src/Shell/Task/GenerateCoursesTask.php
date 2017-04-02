<?php

namespace App\Shell\Task;

use App\Model\Table\CoursesTable;
use App\Model\Table\DisciplinesTable;
use App\Model\Table\LevelsTable;
use App\Model\Table\UsersTable;

/**
 * Class GenerateUsersTask
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Shell\Task
 *
 * @property CoursesTable $Courses
 * @property DisciplinesTable $Disciplines
 * @property LevelsTable $Levels
 * @property UsersTable $Users
 */
class GenerateCoursesTask extends GenerateTask
{
    public function main($min = 1, $max = 3)
    {
        $this->_save($this->_generate($min, $max));
    }

    /**
     * Generate courses
     * @param int $min the minimum course count per user
     * @param int $max the maximum course count per user
     * @return array the generated courses
     */
    private function _generate($min = 1, $max = 3)
    {
        // Load additional models
        $this->loadModel('Disciplines');
        $this->loadModel('Levels');
        $this->loadModel('Users');

        // Initialization
        $courses = [];
        $disciplineIds = array_keys($this->Disciplines->find('list')->toArray());
        $levelIds = array_keys($this->Levels->find('list')->toArray());
        $userIds = array_keys($this->Users->find('list')->toArray());

        // Generator starts
        $this->out('Generating courses');
        foreach ($userIds as $courseUserId) {
            $coursesCount = random_int($min, $max);
            $courseLevelId = array_rand_value($levelIds);
            $courseDisciplineIds = array_rand_value($disciplineIds, $coursesCount);

            if (!is_array($courseDisciplineIds)) {
                $courseDisciplineIds = [$courseDisciplineIds];
            }

            foreach ($courseDisciplineIds as $courseDisciplineId) {
                $courses[] = [
                    'user_id' => $courseUserId,
                    'level_id' => $courseLevelId,
                    'discipline_id' => $courseDisciplineId
                ];
            }
        }
        $this->out('Courses generated');
        // Generator ends

        return $courses;
    }
}