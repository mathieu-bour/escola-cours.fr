<?php
use Migrations\AbstractMigration;

class CreateCoursesTable extends AbstractMigration
{
    public function up()
    {
        $this->table('courses')
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
            ->addIndex(['user_id'])
            ->create();

        $this->table('courses')
            ->addForeignKey(
                'discipline_id',
                'disciplines',
                'id', [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'level_id',
                'levels',
                'id', [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id', [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
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