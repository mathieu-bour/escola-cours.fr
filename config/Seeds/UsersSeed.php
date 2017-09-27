<?php
use Cake\I18n\Time;
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     * Write your database seeder using this method.
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'admin' => 1,
                'token' => '6910ed4c-bd94-4bbe-87f3-948c123cf1a6',
                'email' => 'mathieu.tin.bour@gmail.com',
                'type' => 'teacher',
                'lastname' => 'Bour',
                'firstname' => 'Mathieu',
                'address' => '879 route de Mimet',
                'zip_code' => '57070',
                'city' => 'Metz',
                'social_security_number' => '',
                'notes' => 'C\'est un super développeur',
                'urssaf_email' => 'mathieu.bour@escola-cours.fr',
                'urssaf_password' => '8p6heLpYhSsAwtH7rRZY',
                'lesson_count' => 0,
                'created' => Time::now()
            ],
            [
                'admin' => 1,
                'token' => '8523afe8-ee48-4704-9a2c-16b2a76f42f4',
                'email' => 'marwan.brion@gmail.com',
                'type' => 'teacher',
                'lastname' => 'Brion',
                'firstname' => 'Marwan',
                'address' => '9 rue du Pont des Morts',
                'zip_code' => '57000',
                'city' => 'Metz',
                'social_security_number' => '',
                'notes' => 'C\'est un super manager',
                'urssaf_email' => '',
                'urssaf_password' => 'U2nGUsaB3D4LfqwptTPj',
                'lesson_count' => 0,
                'created' => Time::now()
            ],
            [
                'admin' => 1,
                'token' => '76888617-c222-4af9-8110-f724068628cf',
                'email' => 'franck.calcari@gmail.com',
                'type' => 'teacher',
                'lastname' => 'Calcari',
                'firstname' => 'Franck',
                'address' => '9 quai Paul Wiltzer',
                'zip_code' => '57000',
                'city' => 'Metz',
                'social_security_number' => '',
                'notes' => 'C\'est un super manager',
                'urssaf_email' => '',
                'urssaf_password' => 'rU5XCZNPZnqk7kkmyBYD',
                'lesson_count' => 0,
                'created' => Time::now()
            ]
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
