<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "room_lease".
 *
 * @property int $id
 * @property string $lease_no
 * @property int $room_id
 * @property int $customer_id
 * @property string $start_from
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class RoomLease extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room_lease';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id','customer_id'],'required'],
            [['room_id', 'customer_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['start_from'], 'safe'],
            [['lease_no', 'note'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lease_no' => 'สัญญาเลขที่',
            'room_id' => 'เลขที่ห้อง',
            'customer_id' => 'ลูกต้า',
            'start_from' => 'เข้าอยู่เมื่อ',
            'note' => 'หมายเหตุ',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
