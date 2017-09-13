<?php
use Migrations\AbstractMigration;

class CreateLevelsTable extends AbstractMigration {
    public function up() {
        $this->table('levels')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->create();
    }

    public function down()
    {
        $this->dropTable('levels');
    }
}