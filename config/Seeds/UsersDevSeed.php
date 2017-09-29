<?php
use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\Time;
use Cake\Utility\Text;
use Faker\Factory;
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersDevSeed extends AbstractSeed
{
    private const USER_COUNT = 100;

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

        $data = [];

        // Generator starts
        for($i = 2; $i < self::USER_COUNT; $i++) {
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

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
