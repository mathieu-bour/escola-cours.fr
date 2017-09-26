<?php
use Migrations\AbstractMigration;

class CreateDisciplinesTable extends AbstractMigration
{
    public function up()
    {
        $this->table('disciplines')
            ->addColumn('name', 'string')
            ->create();
    }

    public function down()
    {
        $this->dropTable('disciplines');
    }
}