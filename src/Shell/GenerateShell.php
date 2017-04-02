<?php

namespace App\Shell;

use App\Model\Table\AppTable;
use App\Shell\Task\GenerateCoursesTask;
use App\Shell\Task\GenerateLessonsTask;
use App\Shell\Task\GenerateSlotsTask;
use App\Shell\Task\GenerateUsersTask;
use Cake\Console\Shell;
use Cake\Database\Connection;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Table;

/**
 * Class Generate
 * Used to generate fake data to fill te escola's database
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Shell
 *
 * @property GenerateUsersTask $GenerateUsers
 * @property GenerateCoursesTask $GenerateCourses
 * @property GenerateLessonsTask $GenerateLessons
 * @property GenerateSlotsTask $GenerateSlots
 */
class GenerateShell extends Shell
{
    public $tasks = [
        'GenerateUsers',
        'GenerateLessons',
        'GenerateCourses',
        'GenerateSlots'
    ];

    public function main($userCount = 500, $chunkSize = 100)
    {
        $this->out($this->nl(0));
        $this->out('Welcome in escola-cours.fr test data generator');

        if ($this->_eraseDatabase()) {
            $this->GenerateUsers->main($userCount, $chunkSize);
            $this->GenerateCourses->main(1, 3, $chunkSize);
            $this->GenerateLessons->main($userCount / 2);
            $this->GenerateSlots->main($chunkSize * 5);
        }
    }

    /**
     * Erase the database
     */
    private function _eraseDatabase()
    {
        $this->out('This script will erase the current database fill it with fresh data');
        $selection = $this->in('Are you really sure you want to proceed?', ['Y', 'n'], 'Y');

        if (strtolower($selection) !== 'y') {
            $this->out('Generation cancelled');
            return false;
        }

        $this->out('Erasing database...');
        $conn = new Connection(ConnectionManager::get(Table::defaultConnectionName())->config());
        $conn->query('SET foreign_key_checks = 0');
        $conn->query('TRUNCATE courses; TRUNCATE lessons; TRUNCATE slots; TRUNCATE users');
        $conn->query('SET foreign_key_checks = 1');
        $this->out('Database erased...');

        return true;
    }
}