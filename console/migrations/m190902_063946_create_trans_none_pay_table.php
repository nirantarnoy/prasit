<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%trans_none_pay}}`.
 */
class m190902_063946_create_trans_none_pay_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%trans_none_pay}}', [
            'id' => $this->primaryKey(),
            'trans_id' => $this->integer(),
            'room_id' => $this->integer(),
            'trans_line_id' => $this->integer(),
            'total_amt' => $this->float(),
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
        $this->dropTable('{{%trans_none_pay}}');
    }
}
