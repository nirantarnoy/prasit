<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customer`.
 */
class m180810_040254_create_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('customer', [
            'id' => $this->primaryKey(),
            'code' => $this->string(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'card_id'=>$this->string(13),
            'customer_group_id' => $this->integer(),
            'customer_type_id'=>$this->integer(),
            'description' => $this->string(),
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
        $this->dropTable('customer');
    }
}
