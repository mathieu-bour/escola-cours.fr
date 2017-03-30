<?php

namespace App\Shell\Task;

use App\Model\Table\LessonsTable;
use App\Model\Table\DisciplinesTable;
use App\Model\Table\LevelsTable;
use App\Model\Table\UsersTable;
use Cake\Console\Exception\StopException;
use Cake\Console\Shell;
use Cake\I18n\Time;

/**
 * Class GenerateUsersTask
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Shell\Task
 *
 * @property LessonsTable $Lessons
 * @property DisciplinesTable $Disciplines
 * @property LevelsTable $Levels
 * @property UsersTable $Users
 */
class GenerateLessonsTask extends Shell
{
    /** @var array */
    private $_lessons = [];

    /** @var array */
    private $_disciplineIds = [];
    /** @var array */
    private $_levelIds = [];
    /** @var array */
    private $_studentIds = [];

    /*= Hooks
     *=====================================================*/
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Lessons');
        $this->loadModel('Disciplines');
        $this->loadModel('Levels');
        $this->loadModel('Users');

        $this->_disciplineIds = array_keys($this->Disciplines->find('list')->toArray());
        $this->_levelIds = array_keys($this->Levels->find('list')->toArray());
        $this->_studentIds = array_keys($this->Users->find('list')->where(['type' => 'student'])->toArray());
    }

    public function main($count = 250, $chunkSize = 50)
    {
        $this->out($this->nl(0));

        $this->_generate($count);
        $this->_save($chunkSize);
    }

    /**
     * Generate lessons
     * @param int $count the lesson count to generate
     */
    private function _generate($count)
    {
        do {
            // Select a random student
            $student = $this->Users->find()
                ->enableHydration(false)
                ->contain('Courses')
                ->where(['id ' => array_rand_value($this->_studentIds)])
                ->first();

            // Select a random course in the student's courses
            $course = array_rand_value($student['courses']);

            // Try to find a teacher matching with level and discipline
            $teachers = $this->Users->find('teachers', [
                'level_id' => $course['level_id'],
                'discipline_id' => $course['discipline_id']
            ])
                ->enableHydration(false)
                ->toList();

            // None found: retry with a new student
            if(empty($teachers)) {
                continue;
            }

            $this->_io->overwrite('Generating lessons [' . (count($this->_lessons) + 1) . '/' . $count . ']', 0);

            $teacherId = array_rand_value($teachers)['id'];
            $this->_lessons[] = [
                'user_id' => $student['id'],
                'teacher_id' => $teacherId,
                'level_id' => $course['level_id'],
                'discipline_id' => $course['discipline_id'],
                'duration' => array_rand_value([1, 1.5, 2, 2.5, 3]),
                'beginning' => Time::now()->subSeconds(random_int(0, 60*60*24*30))
            ];
        } while(count($this->_lessons) < $count);

        $this->out($this->nl(0));
        $this->out('Lessons generated');
    }

    /**
     * Save lessons by chunk
     * @param int $chunkSize the chunk size
     */
    private function _save($chunkSize)
    {
        $this->_lessons = array_chunk($this->_lessons, $chunkSize);
        $chunkCount = count($this->_lessons);

        $this->nl(0);

        for ($i = 1; $i <= $chunkCount; $i++) {
            $this->_io->overwrite('Saving lessons chunks [' . $i . '/' . $chunkCount . ']', 0);
            $lessons = $this->Lessons->newEntities($this->_lessons[$i - 1]);

            if (!$this->Lessons->saveMany($lessons)) {
                debug($lessons);
                throw new StopException('Unable to save user chunk', 2);
            }
        }
        $this->out($this->nl(0));
        $this->out('Lessons saved');
    }
}