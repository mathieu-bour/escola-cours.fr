<?php

namespace App\Shell;

use App\Model\Table\AppTable;
use App\Shell\Task\GenerateCoursesTask;
use App\Shell\Task\GenerateUsersTask;
use Cake\Console\Shell;
use Cake\Database\Connection;
use Cake\Datasource\ConnectionManager;

/**
 * Class Generate
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Shell
 *
 * @property GenerateUsersTask $GenerateUsers
 * @property GenerateCoursesTask $GenerateCourses
 */
class GenerateShell extends Shell
{
    public $tasks = [
        'GenerateUsers',
        'GenerateLessons',
        'GenerateCourses'
    ];

    public function initialize()
    {
        parent::initialize();
    }

    public function main() {
        $this->out($this->nl(0));
        $this->out('Welcome in escola-cours.fr test data generator');
        $this->out('This script will erase the current database fill it with fresh data');
        $selection = $this->in('Are you really sure you want to proceed?', ['Y', 'n'], 'Y');

        if(strtolower($selection) !== 'y') {
            $this->out('Generation cancelled');
            return;
        }

        $this->out('Erasing database...');
        $conn = new Connection(ConnectionManager::get(AppTable::defaultConnectionName())->config());
        $conn->query('SET foreign_key_checks = 0');
        $conn->query('TRUNCATE courses; TRUNCATE lessons; TRUNCATE slots; TRUNCATE users');
        $conn->query('SET foreign_key_checks = 1');
        $this->out('Database erased...');

        $this->GenerateUsers->main();
        $this->GenerateCourses->main();
        $this->GenerateLessons->main();
    }
}