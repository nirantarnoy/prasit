<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%trans_line}}`.
 */
class m190902_014804_add_parking_column_to_trans_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%trans_line}}', 'is_parking', $this->integer());
        $this->addColumn('{{%trans_line}}', 'parking_amt', $this->float());
        $this->addColumn('{{%trans_line}}', 'is_fine', $this->integer());
        $this->addColumn('{{%trans_line}}', 'fine_amt', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%trans_line}}', 'is_parking');
        $this->dropColumn('{{%trans_line}}', 'parking_amt');
        $this->dropColumn('{{%trans_line}}', 'is_fine');
        $this->dropColumn('{{%trans_line}}', 'fine_amt');
    }
}
