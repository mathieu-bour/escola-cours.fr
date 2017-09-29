<?php
use Migrations\AbstractSeed;

class DatabaseSeed extends AbstractSeed
{
    public function run()
    {
        $this->call('LevelsSeed');
        $this->call('DisciplinesSeed');
        $this->call('UsersSeed');

        if (env('DB_CONNECTION') == 'dev') {
            $this->call('UsersDevSeed');
        }
    }
}