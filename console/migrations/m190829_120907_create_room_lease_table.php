<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%room_lease}}`.
 */
class m190829_120907_create_room_lease_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%room_lease}}', [
            'id' => $this->primaryKey(),
            'lease_no' => $this->string(),
            'room_id' => $this->integer(),
            'customer_id' => $this->integer(),
            'start_from' => $this->dateTime(),
            'note' => $this->string(),
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
        $this->dropTable('{{%room_lease}}');
    }
}
