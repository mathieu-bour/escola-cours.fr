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
            ->addColumn('type', 'enum', [
                'values' => ['admin', 'teacher', 'student']
            ])
            ->addColumn('lastname', 'string')
            ->addColumn('firstname', 'string')
            ->addColumn('telephone', 'string')
            ->addColumn('address', 'string')
            ->addColumn('zip_code', 'string')
            ->addColumn('city', 'string')
            ->addColumn('notes', 'text', ['null' => true])
            ->addColumn('social_security_number', 'string', ['null' => true])
            ->addColumn('urssaf_email', 'string', ['null' => true])
            ->addColumn('urssaf_password', 'string', ['null' => true])
            ->addColumn('lesson_count', 'integer', ['default' => 0])
            ->addColumn('created', 'datetime')
            ->addIndex(['email'], ['unique' => true])
            ->create();
    }


    public function down()
    {
        $this->dropTable('users');
    }
}