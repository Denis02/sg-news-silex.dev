<?php

use Phinx\Migration\AbstractMigration;

class CreateTableNews extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('news')
            ->addColumn('title', 'string')
            ->addColumn('link', 'string')
            ->addColumn('description', 'text')
            ->addColumn('source', 'string')
            ->addColumn('pub_date', 'datetime')
            ->addIndex(array('link'), array('unique'=>TRUE))
            ->create();
    }
}
