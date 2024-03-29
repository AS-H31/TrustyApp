<?php

use Phoenix\Database\Element\Index;
use Phoenix\Migration\AbstractMigration;

class CreateCraftsmenTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('craftsmen')
            ->addColumn('username', 'string')
            ->addColumn('full_name', 'string')
            ->addColumn('password', 'string')
            ->addColumn('craft', 'string')
            ->addColumn('address', 'string')
            ->addColumn('language', 'string')
            ->addColumn('description', 'string', ['length' => 1000])
            ->addColumn('price', 'double', ['decimals' => 2])
            ->addColumn('rating', 'double', ['decimals' => 2])
            ->addIndex('username', Index::TYPE_UNIQUE)
            ->create();
    }

    protected function down(): void
    {
        $this->table('craftsmen')->drop();
    }
}
