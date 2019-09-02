<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%trans_line}}`.
 */
class m190902_020852_add_water_unit_column_to_trans_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%trans_line}}', 'water_unit', $this->float());
        $this->addColumn('{{%trans_line}}', 'elect_unit', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%trans_line}}', 'water_unit');
        $this->dropColumn('{{%trans_line}}', 'elect_unit');
    }
}
