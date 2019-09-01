<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%customer}}`.
 */
class m190829_014527_add_phone_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer}}', 'phone', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%customer}}', 'phone');
    }
}
