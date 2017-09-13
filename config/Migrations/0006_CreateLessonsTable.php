<?php
use Migrations\AbstractMigration;

class CreateLessonsTable extends AbstractMigration
{
    public function up()
    {
        $this->table('lessons')
            ->addColumn('beginning', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('duration', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('teacher_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('level_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('discipline_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(['discipline_id'])
            ->addIndex(['level_id'])
            ->addIndex(['teacher_id'])
            ->addIndex(['user_id'])
            ->create();

        $this->table('lessons')
            ->addForeignKey(
                'discipline_id',
                'disciplines',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'level_id',
                'levels',
                'id', [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'teacher_id',
                'users',
                'id', [
                    'update' => 'SET_NULL',
                    'delete' => 'SET_NULL'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id', [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
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