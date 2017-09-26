<?php
use Migrations\AbstractMigration;

class CreateLevelsTable extends AbstractMigration {
    public function up() {
        $this->table('levels')
            ->addColumn('name', 'string')
            ->create();
    }

    public function down()
    {
        $this->dropTable('levels');
    }
}