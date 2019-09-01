<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%room_lease}}`.
 */
class m190829_122350_add_rent_type_column_to_room_lease_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%room_lease}}', 'rent_type', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%room_lease}}', 'rent_type');
    }
}
