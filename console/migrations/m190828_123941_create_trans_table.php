<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%journal}}`.
 */
class m190828_123941_create_trans_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%trans}}', [
            'id' => $this->primaryKey(),
            'trans_no' => $this->string(),
            'trans_date' => $this->dateTime(),
            'trans_type' => $this->integer(),
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
        $this->dropTable('{{%trans}}');
    }
}
