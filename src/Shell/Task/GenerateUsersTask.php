<?php

namespace App\Shell\Task;

use App\Model\Table\UsersTable;
use Cake\Console\Exception\StopException;
use Cake\Console\Shell;
use Cake\Filesystem\File;
use Cake\I18n\Time;
use Cake\Utility\Text;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class GenerateUsersTask
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Shell\Task
 *
 * @property UsersTable $Users
 */
class GenerateUsersTask extends Shell
{
    private $_usersDefaultFile;
    private $_usersDefault;
    private $_usersDicFiles;
    private $_usersDic;
    private $_users;

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');

        // Load dictionaries
        $this->_usersDicFiles = [
            'firstname' => new File(ROOT . DS . 'generator' . DS . 'dictionaries' . DS . 'users_firstname.yaml'),
            'lastname' => new File(ROOT . DS . 'generator' . DS . 'dictionaries' . DS . 'users_lastname.yaml'),
            'email_domain' => new File(ROOT . DS . 'generator' . DS . 'dictionaries' . DS . 'users_email_domain.yaml'),
            'street' => new File(ROOT . DS . 'generator' . DS . 'dictionaries' . DS . 'users_street.yaml'),
        ];

        try {
            $this->_usersDic = [
                'firstname' => (array)Yaml::parse($this->_usersDicFiles['firstname']->read()),
                'lastname' => (array)Yaml::parse($this->_usersDicFiles['lastname']->read()),
                'email_domain' => (array)Yaml::parse($this->_usersDicFiles['email_domain']->read()),
                'street' => (array)Yaml::parse($this->_usersDicFiles['street']->read())
            ];
        } catch (ParseException $e) {
            $this->err('Unable to parse the YAML string: ' . $e->getMessage());
        }
    }

    public function main($count = 500, $chunkSize = 50, $saveDefault = true)
    {
        $this->out($this->nl(0));

        // Process
        $this->_generate($count);
        if ($saveDefault) {
            $this->_saveDefault();
        }
        $this->_save($chunkSize);
    }

    /**
     * Generate users
     * @param int $count the user count to generate
     */
    private function _generate($count)
    {
        for ($i = 1; $i <= $count; $i++) {
            $this->_io->overwrite('Generating users [' . $i . '/' . $count . ']', 0);

            $firstname = array_rand_value($this->_usersDic['firstname']);
            $lastname = array_rand_value($this->_usersDic['lastname']);
            $this->_users[] = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => strtolower(Text::slug($firstname . '.' . $lastname, ['preserve' => '.'])) . random_int(1, 100) .
                    '@' . array_rand_value($this->_usersDic['email_domain']),
                'address' => random_int(1, 20) . ' ' . array_rand_value($this->_usersDic['street']),
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
    }

    /**
     * Save default users based on /config/generator/users_default.json
     */
    private function _saveDefault()
    {
        $this->_usersDefaultFile = new File(ROOT . DS . 'generator' . DS . 'default' . DS . 'users.yaml');
        $this->_usersDefault = (array)Yaml::parse($this->_usersDefaultFile->read());

        $this->out('Saving default users');
        $users = $this->Users->newEntities($this->_usersDefault);

        if (!$this->Users->saveMany($users)) {
            throw new StopException('Unable to save user chunk', 2);
        }
        $this->out('Default users saved');
    }

    /**
     * Save users by chunk
     * @param int $chunkSize the chunk size
     */
    private function _save($chunkSize)
    {
        $this->_users = array_chunk($this->_users, $chunkSize);
        $chunkCount = count($this->_users);

        $this->nl(0);

        for ($i = 1; $i <= $chunkCount; $i++) {
            $this->_io->overwrite('Saving user chunks [' . $i . '/' . $chunkCount . ']', 0);
            $users = $this->Users->newEntities($this->_users[$i - 1]);

            if (!$this->Users->saveMany($users)) {
                throw new StopException('Unable to save user chunk', 2);
            }
        }
        $this->out($this->nl(0));
        $this->out('Users saved');
    }
}