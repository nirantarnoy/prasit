<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%room}}`.
 */
class m190829_121951_add_room_status_column_to_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%room}}', 'room_status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%room}}', 'room_status');
    }
}
