<?php
use Migrations\AbstractSeed;

/**
 * Levels seed.
 */
class LevelsSeed extends AbstractSeed
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
            ['name' => 'CP'],
            ['name' => 'CE1'],
            ['name' => 'CE2'],
            ['name' => 'CM1'],
            ['name' => 'CM2'],
            ['name' => '6e'],
            ['name' => '5e'],
            ['name' => '4e'],
            ['name' => '3e'],
            ['name' => '2nde'],
            ['name' => '1ère'],
            ['name' => 'Term']
        ];

        $table = $this->table('levels');
        $table->insert($data)->save();
    }
}
