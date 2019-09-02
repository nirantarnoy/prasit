<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%trans_line}}`.
 */
class m190902_055631_add_total_text_column_to_trans_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%trans_line}}', 'total_text', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%trans_line}}', 'total_text');
    }
}
