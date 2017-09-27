<?php
use Migrations\AbstractMigration;

class CreateLessonsTable extends AbstractMigration
{
    public function up()
    {
        $this->table('lessons')
            ->addColumn('beginning', 'datetime')
            ->addColumn('duration', 'float')
            ->addColumn('teacher_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('level_id', 'integer')
            ->addColumn('discipline_id', 'integer')
            ->addIndex(['discipline_id'])
            ->addIndex(['level_id'])
            ->addIndex(['teacher_id'])
            ->addIndex(['user_id'])
            ->create();

        $this->table('lessons')
            ->addForeignKey('discipline_id', 'disciplines', 'id')
            ->addForeignKey('level_id', 'levels', 'id')
            ->addForeignKey('teacher_id', 'users', 'id')
            ->addForeignKey('user_id', 'users', 'id')
            ->update();

    }


    public function down()
    {
        $this->table('lessons')
            ->dropForeignKey('discipline_id')
            ->dropForeignKey('level_id')
            ->dropForeignKey('teacher_id')
            ->dropForeignKey('user_id');

        $this->dropTable('lessons');
    }
}