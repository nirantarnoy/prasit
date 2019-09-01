<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trans_line".
 *
 * @property int $id
 * @property int $trans_id
 * @property int $room_id
 * @property double $price
 * @property double $water_price
 * @property double $elect_price
 * @property double $water_before
 * @property double $water_after
 * @property double $elect_before
 * @property double $elect_after
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class TransLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_id', 'room_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['price', 'water_price', 'elect_price', 'water_before', 'water_after', 'elect_before', 'elect_after'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trans_id' => 'Trans ID',
            'room_id' => 'Room ID',
            'price' => 'Price',
            'water_price' => 'Water Price',
            'elect_price' => 'Elect Price',
            'water_before' => 'Water Before',
            'water_after' => 'Water After',
            'elect_before' => 'Elect Before',
            'elect_after' => 'Elect After',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
