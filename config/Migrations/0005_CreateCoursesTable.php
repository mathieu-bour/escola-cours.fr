<?php
use Migrations\AbstractMigration;

class CreateCoursesTable extends AbstractMigration
{
    public function up()
    {
        $this->table('courses')
            ->addColumn('user_id', 'integer')
            ->addColumn('level_id', 'integer')
            ->addColumn('discipline_id', 'integer')
            ->addIndex(['discipline_id'])
            ->addIndex(['level_id'])
            ->addIndex(['user_id'])
            ->create();

        $this->table('courses')
            ->addForeignKey('discipline_id', 'disciplines', 'id')
            ->addForeignKey('level_id', 'levels', 'id')
            ->addForeignKey('user_id', 'users', 'id')
            ->update();
    }


    public function down()
    {
        $this->table('courses')
            ->dropForeignKey('discipline_id')
            ->dropForeignKey('level_id')
            ->dropForeignKey('user_id');

        $this->dropTable('courses');
    }
}