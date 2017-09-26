<?php
use Migrations\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function up()
    {
        $this->table('users')
            ->addColumn('token', 'uuid')
            ->addColumn('email', 'string')
            ->addColumn('password', 'string')
            ->addColumn('type', 'string', ['values' => ['admin', 'teacher', 'student']])
            ->addColumn('lastname', 'string')
            ->addColumn('firstname', 'string')
            ->addColumn('telephone', 'string')
            ->addColumn('address', 'string')
            ->addColumn('zip_code', 'string')
            ->addColumn('city', 'string')
            ->addColumn('lesson_count', 'integer', ['default' => 0])
            ->addColumn('created', 'datetime')
            ->addIndex('email', ['unique'])
            ->create();
    }


    public function down()
    {
        $this->dropTable('users');
    }
}