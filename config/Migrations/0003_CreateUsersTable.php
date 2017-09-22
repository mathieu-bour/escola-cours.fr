<?php
use Migrations\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function up()
    {
        $this->table('users')
            ->addColumn('admin', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('token', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('type', 'string', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('lastname', 'string', [
                'default' => null,
                'limit' => 60,
                'null' => true,
            ])
            ->addColumn('firstname', 'string', [
                'default' => null,
                'limit' => 60,
                'null' => true,
            ])
            ->addColumn('telephone', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('address', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('zip_code', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('city', 'string', [
                'default' => null,
                'limit' => 60,
                'null' => true,
            ])
            ->addColumn('social_security_number', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('notes', 'text', [
                'default' => null,
                'limit' => 60,
                'null' => true,
            ])
            ->addColumn('urssaf_email', 'text', [
                'default' => null,
                'limit' => 60,
                'null' => true,
            ])
            ->addColumn('urssaf_password', 'text', [
                'default' => null,
                'limit' => 60,
                'null' => true,
            ])
            ->addColumn('lesson_count', 'integer', [
                'default' => '0',
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();
    }


    public function down()
    {
        $this->dropTable('users');
    }
}