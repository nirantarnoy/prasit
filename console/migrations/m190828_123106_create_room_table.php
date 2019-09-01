<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%room}}`.
 */
class m190828_123106_create_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%room}}', [
            'id' => $this->primaryKey(),
            'room_no' => $this->string(),
            'building_id' => $this->integer(),
            'floor' => $this->integer(),
            'customer_id' => $this->integer(),
            'room_rate' => $this->float(),
            'rent_type' => $this->integer(),
            'water_meter_last' => $this->float(),
            'elect_meter_last' => $this->float(),
            'water_per_unit' => $this->float(),
            'elect_per_unit' => $this->float(),
            'last_pay_date' => $this->dateTime(),
            'photo' => $this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%room}}');
    }
}
