<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%room_lease}}`.
 */
class m190901_140434_add_leave_date_column_to_room_lease_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%room_lease}}', 'leave_date', $this->datetime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%room_lease}}', 'leave_date');
    }
}
