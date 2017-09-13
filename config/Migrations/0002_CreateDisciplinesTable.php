<?php
use Migrations\AbstractMigration;

class CreateDisciplinesTable extends AbstractMigration
{
    public function up()
    {
        $this->table('disciplines')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->create();
    }

    public function down()
    {
        $this->dropTable('disciplines');
    }
}