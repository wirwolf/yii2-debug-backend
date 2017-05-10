<?php

use yii\db\Migration;

/**
 * Handles the creation of table `debug`.
 */
class m170510_131511_create_debug_table extends Migration
{

    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('{{debug_summery}}', [
            'tag'         => $this->string(40)->unique(),
            'url'         => $this->char(255),
            'ajax'        => $this->boolean(),
            'method'      => $this->string(7),
            'ip'          => $this->string(39),
            'time'        => $this->string(40),
            'statusCode'  => $this->integer(3),
            'tabsSummery' => $this->text()
        ]);
        $this->createTable('{{debug_data}}', [
            'id'     => $this->primaryKey(),
            'tag'     => $this->char(40),
            'panelId' => $this->string(255),
            'content' => $this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('{{debug_data}}');
        $this->dropTable('{{debug_summery}}');
    }
}
