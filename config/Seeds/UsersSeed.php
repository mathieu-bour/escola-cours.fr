<?php
use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\Time;
use Cake\Utility\Text;
use Faker\Factory;
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
        $faker = Factory::create();
        $passwordHasher = new DefaultPasswordHasher();

        $data = [
            [
                'token' => '6910ed4c-bd94-4bbe-87f3-948c123cf1a6',
                'email' => 'mathieu.tin.bour@gmail.com',
                'password' => $passwordHasher->hash('salome3004'),
                'type' => 'admin',
                'lastname' => 'Bour',
                'firstname' => 'Mathieu',
                'telephone' => '0672039618',
                'address' => '879 route de Mimet',
                'zip_code' => '57070',
                'city' => 'Metz',
                'social_security_number' => '',
                'notes' => 'C\'est un super développeur',
                'urssaf_email' => 'mathieu.bour@escola-cours.fr',
                'urssaf_password' => '8p6heLpYhSsAwtH7rRZY',
                'lesson_count' => 0,
                'created' => Time::now()->format('Y-m-d H:i:s')
            ],
            [
                'token' => '8523afe8-ee48-4704-9a2c-16b2a76f42f4',
                'email' => 'marwan.brion@gmail.com',
                'password' => $passwordHasher->hash('marwan57'),
                'type' => 'admin',
                'lastname' => 'Brion',
                'firstname' => 'Marwan',
                'telephone' => '0646345292',
                'address' => '9 rue du Pont des Morts',
                'zip_code' => '57000',
                'city' => 'Metz',
                'social_security_number' => '',
                'notes' => 'C\'est un super manager',
                'urssaf_email' => '',
                'urssaf_password' => 'U2nGUsaB3D4LfqwptTPj',
                'lesson_count' => 0,
                'created' => Time::now()->format('Y-m-d H:i:s')
            ],
            [
                'token' => '76888617-c222-4af9-8110-f724068628cf',
                'email' => 'franck.calcari@gmail.com',
                'password' => $passwordHasher->hash('franck57'),
                'type' => 'admin',
                'lastname' => 'Calcari',
                'firstname' => 'Franck',
                'telephone' => '0761768664',
                'address' => '9 quai Paul Wiltzer',
                'zip_code' => '57000',
                'city' => 'Metz',
                'social_security_number' => '',
                'notes' => 'C\'est un super manager',
                'urssaf_email' => '',
                'urssaf_password' => 'rU5XCZNPZnqk7kkmyBYD',
                'lesson_count' => 0,
                'created' => Time::now()->format('Y-m-d H:i:s')
            ]
        ];

        if (env('DB_CONNECTION') == 'dev') {
            // Generator starts
            for ($i = 2; $i < 200; $i++) {
                $firstname = $faker->firstName;
                $lastname = $faker->lastName;
                $emailUsername = strtolower(Text::slug($firstname . '.' . $lastname, ['preserve' => '.']));
                $type = $faker->boolean(33.33) ? 'teacher' : 'student';
                $data[] = [
                    'token' => $faker->uuid,
                    'email' => $emailUsername . '@' . $faker->freeEmailDomain,
                    'password' => $passwordHasher->hash('test'),
                    'type' => $type,
                    'lastname' => $lastname,
                    'firstname' => $firstname,
                    'address' => $faker->streetAddress,
                    'telephone' => '06' . random_int(10000000, 99999999),
                    'zip_code' => '57000',
                    'city' => 'Metz',
                    'notes' => null,
                    'social_security_number' => $type == 'teacher' ? random_int(1000000, 9999999) . random_int(10000000, 99999999) : null,
                    'urssaf_email' => $emailUsername . '@escola-cours.fr',
                    'urssaf_password' => $faker->password(20, 20),
                    'created' => Time::now()->format('Y-m-d H:i:s')
                ];
            }
        }

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
