<?php

namespace App\Shell\Task;

use App\Model\Table\UsersTable;
use Cake\I18n\Time;
use Cake\Utility\Text;
use Faker\Factory;

/**
 * Class GenerateUsersTask
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Shell\Task
 *
 * @property UsersTable $Users
 */
class GenerateUsersTask extends GenerateTask
{
    public function main($count = 500)
    {
        $this->_save($this->_readDefault('users'));
        $this->_save($this->_generate($count));
    }

    /**
     * Generate users
     * @param int $count the user count to generate
     * @return array the generated users
     */
    private function _generate($count)
    {
        $faker = Factory::create();

        // Initialization
        $users = [];

        // Generator starts
        for ($i = 1; $i <= $count; $i++) {
            $this->_io->overwrite('Generating users [' . $i . '/' . $count . ']', 0);

            $firstname = $faker->firstName;
            $lastname = $faker->lastName;
            $emailUsername = strtolower(Text::slug($firstname . '.' . $lastname, ['preserve' => '.']));
            $type = $faker->boolean(33.33) ? 'teacher' : 'student';
            $users[] = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $emailUsername . '@' . $faker->freeEmailDomain,
                'address' => $faker->streetAddress,
                'password' => 'test',
                'password_confirm' => 'test',
                'type' => $type,
                'telephone' => '06' . random_int(10000000, 99999999),
                'zip_code' => '57000',
                'city' => 'Metz',
                'social_security_number' => $type == 'teacher' ? random_int(1000000, 9999999) . random_int(10000000, 99999999) : null,
                'created' => Time::now()
                    ->subDays(random_int(0, 30))
                    ->subHours(random_int(0, 24))
                    ->subMinutes(random_int(0, 60))
                    ->subSeconds(random_int(0, 60))
            ];
        }
        $this->out($this->nl(0));
        $this->out('Users generated');
        // Generator ends

        return $users;
    }
}