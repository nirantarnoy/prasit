<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%customer}}`.
 */
class m190829_014334_add_sex_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer}}', 'sex', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%customer}}', 'sex');
    }
}
