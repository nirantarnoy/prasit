<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "building".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property int $floor_qty
 * @property int $room_qty
 * @property string $photo
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Building extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'building';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code','name'],'required'],
            [['floor_qty', 'room_qty', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['code', 'name', 'description',], 'string', 'max' => 255],
            [['photo'],'safe'],
            [['water_unit_per','elect_unit_per','parking_rate','fee_rate'],'number']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'รหัส',
            'name' => 'ชื่อ',
            'description' => 'รายละเอียด',
            'floor_qty' => 'จำนวนชั้น',
            'room_qty' => 'จำนวนห้อง',
            'photo' => 'รูป',
            'water_unit_per' => 'ค่าน้ำ/หน่วย',
            'elect_unit_per' => 'ค่าไฟ/หน่วย',
            'parking_rate' => 'ค่าที่จอดรถ',
            'fee_rate' => 'ค่าปรับล่าช้า',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
