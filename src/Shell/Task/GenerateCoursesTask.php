<?php

namespace App\Shell\Task;

use App\Model\Table\CoursesTable;
use App\Model\Table\DisciplinesTable;
use App\Model\Table\LevelsTable;
use App\Model\Table\UsersTable;
use Cake\Console\Exception\StopException;
use Cake\Console\Shell;

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
class GenerateCoursesTask extends Shell
{
    /** @var array */
    private $_courses = [];

    /** @var array */
    private $_disciplineIds = [];
    /** @var array */
    private $_levelIds = [];
    /** @var array */
    private $_userIds = [];

    /*= Hooks
     *=====================================================*/
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Courses');
        $this->loadModel('Disciplines');
        $this->loadModel('Levels');
        $this->loadModel('Users');

        $this->_disciplineIds = array_keys($this->Disciplines->find('list')->toArray());
        $this->_levelIds = array_keys($this->Levels->find('list')->toArray());
        $this->_userIds = array_keys($this->Users->find('list')->toArray());
    }

    public function main($min = 1, $max = 3, $chunkSize = 50)
    {
        $this->out($this->nl(0));

        $this->_generate($min, $max);
        $this->_save($chunkSize);
    }

    /**
     * Generate courses
     * @param int $min the minimum course count per user
     * @param int $max the maximum course count per user
     */
    private function _generate($min = 1, $max = 3)
    {
        $this->out('Generating courses');

        foreach ($this->_userIds as $courseUserId) {
            $coursesCount = random_int($min, $max);
            $courseLevelId = array_rand_value($this->_levelIds);
            $courseDisciplineIds = array_rand_value($this->_disciplineIds, $coursesCount);

            if (!is_array($courseDisciplineIds)) {
                $courseDisciplineIds = [$courseDisciplineIds];
            }

            foreach ($courseDisciplineIds as $courseDisciplineId) {
                $this->_courses[] = [
                    'user_id' => $courseUserId,
                    'level_id' => $courseLevelId,
                    'discipline_id' => $courseDisciplineId
                ];
            }
        }
        $this->out('Courses generated');
    }

    /**
     * Save courses by chunk
     * @param int $chunkSize the chunk size
     */
    private function _save($chunkSize)
    {
        $this->out('Saving courses');
        $this->_courses = array_chunk($this->_courses, $chunkSize);
        $chunkCount = count($this->_courses);

        for ($i = 1; $i <= $chunkCount; $i++) {
            $this->_io->overwrite('Saving courses chunks [' . $i . '/' . $chunkCount . ']', 0);
            $courses = $this->Courses->newEntities($this->_courses[$i - 1]);

            if (!$this->Courses->saveMany($courses)) {
                debug($courses);
                throw new StopException('Unable to save user chunk', 2);
            }
        }
        $this->out($this->nl(0));
        $this->out('Courses saved');
    }
}