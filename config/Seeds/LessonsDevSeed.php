<?php
use App\Model\Table\UsersTable;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Migrations\AbstractSeed;

/**
 * Lessons seed.
 */
class LessonsDevSeed extends AbstractSeed
{
    /** @var UsersTable */
    private $Users;
    private const LESSON_COUNT = 100;

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $this->Users = TableRegistry::get('users');

        // Initialization
        $data = [];
        $studentIds = array_keys($this->Users->find('list')->where(['type' => 'student'])->toArray());

        // Start generator
        do {
            // Select a random student
            $student = $this->Users->find()
                ->enableHydration(false)
                ->contain('Courses')
                ->where(['id ' => array_rand_value($studentIds)])
                ->first();

            // Select a random course in the student's courses
            $course = array_rand_value($student['courses']);

            // Try to find a teacher matching with level and discipline
            $teachers = $this->Users->find('teachers', [
                'level_id' => $course['level_id'],
                'discipline_id' => $course['discipline_id']
            ])
                ->enableHydration(false)
                ->toList();

            // None found: retry with a new student
            if (empty($teachers)) {
                continue;
            }

            $teacherId = array_rand_value($teachers)['id'];
            $lessons[] = [
                'user_id' => $student['id'],
                'teacher_id' => $teacherId,
                'level_id' => $course['level_id'],
                'discipline_id' => $course['discipline_id'],
                'duration' => array_rand_value([1, 1.5, 2, 2.5, 3]),
                'beginning' => Time::now()->subSeconds(random_int(0, 60 * 60 * 24 * 30))
            ];
        } while (count($lessons) < self::LESSON_COUNT);

        // End generator


        $table = $this->table('lessons');
        $table->insert($data)->save();
    }
}
