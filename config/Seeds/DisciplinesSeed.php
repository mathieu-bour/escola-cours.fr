<?php
use Migrations\AbstractSeed;

/**
 * Disciplines seed.
 */
class DisciplinesSeed extends AbstractSeed
{
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
        $data = [
            ['name' => 'Mathématiques'],
            ['name' => 'Physique-Chimie'],
            ['name' => 'Sciences de la Vie et de la Terre'],
            ['name' => 'Sciences de l\'Ingénieur'],
            ['name' => 'Technologie'],
            ['name' => 'Sciences Économiques et Sociales'],
            ['name' => 'Histoire-Géographie'],
            ['name' => 'Français'],
            ['name' => 'Philosophie'],
            ['name' => 'Anglais'],
            ['name' => 'Allemand'],
            ['name' => 'Espagnol'],
            ['name' => 'Italien']
        ];

        $table = $this->table('disciplines');

        $table->insert($data)->save();
    }
}
