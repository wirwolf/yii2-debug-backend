<?php

use yii\db\Migration;

class m170411_185939_debug_tables extends Migration
{

    public function init() {
        parent::init();
        $this->db->tablePrefix = 'debug_';
    }

    public function up() {
        $this->createTable('{{summary}}', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'tag' => $this->string()->notNull(),
            'url' => $this->string(255)->notNull(),
            'ajax' => $this->boolean()->defaultValue(0),
            'method' => $this->string(8),
            'ip' => $this->string(39)->notNull(),
            'time' => $this->integer()->notNull(),
            'statusCode' => $this->integer(),
        ]);
    }

    public function down() {
        echo "m170411_185939_debug_tables cannot be reverted.\n";

        return false;
    }


}
