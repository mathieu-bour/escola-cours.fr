<?php

namespace App\Shell\Task;

use App\Model\Table\LessonsTable;
use App\Model\Table\UsersTable;
use Cake\I18n\Time;

/**
 * Class GenerateUsersTask
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Shell\Task
 *
 * @property LessonsTable $Lessons
 * @property UsersTable $Users
 */
class GenerateLessonsTask extends GenerateTask
{
    public function main(int $count = 500)
    {
        $this->_save($this->_generate($count));
    }

    /**
     * Generate lessons
     * @param int $count the lesson count to generate
     * @return array the generated lessons
     */
    private function _generate(int $count)
    {
        // Load additional models
        $this->loadModel('Users');

        // Initialization
        $lessons = [];
        $studentIds = array_keys($this->Users->find('list')->where(['type' => 'student'])->toArray());

        // Start generator
        do {
            // Select a random student
            $student = $this->Users->find()
                ->enableHydration(false)
                ->contain('Courses')
                ->where(['id ' => array_rand_value($studentIds)])
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
            if (empty($teachers)) {
                continue;
            }

            $this->_io->overwrite('Generating lessons [' . (count($lessons) + 1) . '/' . $count . ']', 0);

            $teacherId = array_rand_value($teachers)['id'];
            $lessons[] = [
                'user_id' => $student['id'],
                'teacher_id' => $teacherId,
                'level_id' => $course['level_id'],
                'discipline_id' => $course['discipline_id'],
                'duration' => array_rand_value([1, 1.5, 2, 2.5, 3]),
                'beginning' => Time::now()->subSeconds(random_int(0, 60 * 60 * 24 * 30))
            ];
        } while (count($lessons) < $count);
        $this->out($this->nl(0));
        $this->out('Lessons generated');
        // End generator

        return $lessons;
    }
}