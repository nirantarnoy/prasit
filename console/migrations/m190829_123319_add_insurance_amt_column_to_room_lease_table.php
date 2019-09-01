<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%room}}`.
 */
class m190829_123319_add_insurance_amt_column_to_room_lease_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%room_lease}}', 'insurance_amt', $this->float());
        $this->addColumn('{{%room_lease}}', 'advance_amt', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%room_lease}}', 'insurance_amt');
        $this->dropColumn('{{%room_lease}}', 'advance_amt');
    }
}
