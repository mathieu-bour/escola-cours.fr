<?php

namespace App\Shell\Task;

use App\Model\Table\SlotsTable;
use App\Model\Table\UsersTable;

/**
 * Class GenerateSlotsTask
 * @package App\Shell\Task
 *
 * @property UsersTable $Users
 * @property SlotsTable $Slots
 */
class GenerateSlotsTask extends GenerateTask
{
    public function main()
    {
        $this->_save($this->_generate(), 5000);
    }

    /**
     * Generate slots
     * @return array the generated slots
     */
    private function _generate()
    {
        // Load additional models
        $this->loadModel('Users');

        // Initialization
        $slots = [];
        $users = $this->Users->find()
            ->enableHydration(false)
            ->select(['id', 'type']);

        // Generator start
        $this->out('Generating slots');
        foreach ($users as $user) {
            $timetable = $this->_generateUserTimetable($user);

            foreach ($timetable as $key => $day) {
                foreach ($day as $bigSlot) {
                    for ($hour = $bigSlot['start']; $hour < $bigSlot['end']; $hour++) {
                        $slots[] = [
                            'day' => $key,
                            'hour' => $hour,
                            'user_id' => $user['id']
                        ];
                    }
                }
            }
        }
        $this->out('Slots generated');
        // Generator ends

        return $slots;
    }

    /**
     * Generate user timetable
     * @param array $user
     * @return array the user timetable
     */
    private function _generateUserTimetable($user)
    {
        $timetable = [];

        $wakeUpHour = random_int(8, 10);
        $lunchHour = random_int(12, 14);
        $dinnerHour = random_int(19, 21);
        $sleepHour = random_int(22, 24);
        $worksAfterDinner = (bool)random_int(0, 1);
        $workingDays = range(0, 4, 1);
        $specialDay = array_rand_value([2, 5]);

        if ($user['type'] == 'teacher') {
            $workingDays = array_rand_value($workingDays, random_int(3, 5));
        }

        for ($i = 0; $i < 7; $i++) {
            if (in_array($i, $workingDays) && $i != $specialDay) {
                $timetable[$i][] = [
                    'start' => random_int(15, 18),
                    'end' => $dinnerHour
                ];
            } else {
                $timetable[$i][] = [
                    'start' => $wakeUpHour,
                    'end' => $lunchHour,
                ];

                $timetable[$i][] = [
                    'start' => $lunchHour + 1,
                    'end' => $dinnerHour
                ];
            }

            if ($worksAfterDinner) {
                $timetable[$i][] = [
                    'start' => $dinnerHour + 1,
                    'end' => $sleepHour
                ];
            }
        }

        return $timetable;
    }
}