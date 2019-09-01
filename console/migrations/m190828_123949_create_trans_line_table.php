<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%journal_line}}`.
 */
class m190828_123949_create_trans_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%trans_line}}', [
            'id' => $this->primaryKey(),
            'trans_id' => $this->integer(),
            'room_id' => $this->integer(),
            'price' => $this->float(),
            'water_price' => $this->float(),
            'elect_price' => $this->float(),
            'water_before' => $this->float(),
            'water_after' => $this->float(),
            'elect_before' => $this->float(),
            'elect_after' => $this->float(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%trans_line}}');
    }
}
