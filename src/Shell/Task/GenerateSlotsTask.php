<?php

namespace App\Shell\Task;

use App\Model\Table\SlotsTable;
use App\Model\Table\UsersTable;
use Cake\Console\Exception\StopException;
use Cake\Console\Shell;

/**
 * Class GenerateSlotsTask
 * @package App\Shell\Task
 *
 * @property UsersTable $Users
 * @property SlotsTable $Slots
 */
class GenerateSlotsTask extends Shell
{
    private $_slots = [];

    private $_users;

    public function main($chunkSize = 500)
    {
        $this->loadModel('Users');
        $this->loadModel('Slots');

        $this->_users = $this->Users->find()
            ->enableHydration(false)
            ->select(['id', 'type']);

        $this->_generate();
        $this->_save($chunkSize);
    }

    /**
     * Generate slots
     */
    private function _generate()
    {
        $this->out('Generating slots');
        foreach ($this->_users as $user) {
            $timetable = $this->_generateUserTimetable($user);

            foreach ($timetable as $key => $day) {
                foreach ($day as $bigSlot) {
                    for($hour = $bigSlot['start']; $hour < $bigSlot['end']; $hour++) {
                        $this->_slots[] = [
                            'day' => $key,
                            'hour' => $hour,
                            'user_id' => $user['id']
                        ];
                    }
                }
            }
        }
        $this->out('Slots generated');
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

        if($user['type'] == 'teacher') {
            $workingDays = array_rand_value($workingDays, random_int(3, 5));
        }

        for($i = 0; $i < 7; $i++) {
            if(in_array($i, $workingDays) && $i != $specialDay) {
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

            if($worksAfterDinner) {
                $timetable[$i][] = [
                    'start' => $dinnerHour + 1,
                    'end' => $sleepHour
                ];
            }
        }

        return $timetable;
    }

    /**
     * Save lessons by chunk
     * @param int $chunkSize the chunk size
     */
    private function _save($chunkSize)
    {
        $this->_slots = array_chunk($this->_slots, $chunkSize);
        $chunkCount = count($this->_slots);

        $this->nl(0);

        for ($i = 1; $i <= $chunkCount; $i++) {
            $this->_io->overwrite('Saving slots chunks [' . $i . '/' . $chunkCount . ']', 0);
            $slots = $this->Slots->newEntities($this->_slots[$i - 1]);

            if (!$this->Slots->saveMany($slots)) {
                debug($slots);
                throw new StopException('Unable to save slots chunk', 2);
            }
        }
        $this->out($this->nl(0));
        $this->out('Slots saved');
    }
}