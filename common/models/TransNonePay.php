<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trans_none_pay".
 *
 * @property int $id
 * @property int $trans_id
 * @property int $room_id
 * @property int $trans_line_id
 * @property double $total_amt
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class TransNonePay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_none_pay';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_id', 'room_id', 'trans_line_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['total_amt'], 'number'],
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
            'trans_line_id' => 'Trans Line ID',
            'total_amt' => 'Total Amt',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
