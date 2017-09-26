<?php
use Migrations\AbstractMigration;

class CreateSlotsTable extends AbstractMigration
{
    public function up()
    {
        $this->table('slots')
            ->addColumn('day', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('hour', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(['user_id'])
            ->create();

        $this->table('slots')
            ->addForeignKey('user_id', 'users', 'id')
            ->update();
    }


    public function down()
    {
        $this->table('slots')
            ->dropForeignKey('user_id');

        $this->dropTable('slots');
    }
}
