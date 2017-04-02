<?php

namespace App\Shell\Task;

use App\Model\Table\UsersTable;
use Cake\I18n\Time;
use Cake\Utility\Text;
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
        // Load dictionaries
        $dics = [
            'firstname' => $this->_readDictionary('users_firstnames'),
            'lastname' => $this->_readDictionary('users_lastnames'),
            'email_domain' => $this->_readDictionary('users_email_domains'),
            'street' => $this->_readDictionary('users_streets')
        ];

        // Initialization
        $users = [];

        // Generator starts
        for ($i = 1; $i <= $count; $i++) {
            $this->_io->overwrite('Generating users [' . $i . '/' . $count . ']', 0);

            $firstname = array_rand_value($dics['firstname']);
            $lastname = array_rand_value($dics['lastname']);
            $users[] = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => strtolower(Text::slug($firstname . '.' . $lastname, ['preserve' => '.'])) . random_int(1, 100) .
                    '@' . array_rand_value($dics['email_domain']),
                'address' => random_int(1, 20) . ' ' . array_rand_value($dics['street']),
                'password' => 'test',
                'password_confirm' => 'test',
                'type' => array_rand_value(['student', 'teacher']),
                'telephone' => '06' . random_int(10000000, 99999999),
                'zip_code' => '57000',
                'city' => 'Metz',
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