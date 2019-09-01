<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%customer}}`.
 */
class m190901_074324_add_bod_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer}}', 'bod', $this->datetime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%customer}}', 'bod');
    }
}
