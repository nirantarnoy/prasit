<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%trans_line}}`.
 */
class m190902_080504_add_none_pay_amt_column_to_trans_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%trans_line}}', 'none_pay_amt', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%trans_line}}', 'none_pay_amt');
    }
}
