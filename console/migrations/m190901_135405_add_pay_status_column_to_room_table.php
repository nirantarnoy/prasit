<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%room}}`.
 */
class m190901_135405_add_pay_status_column_to_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%room}}', 'pay_status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%room}}', 'pay_status');
    }
}
