<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property int $id
 * @property string $room_no
 * @property int $building_id
 * @property int $floor
 * @property int $customer_id
 * @property double $room_rate
 * @property int $rent_type
 * @property double $water_meter_last
 * @property double $elect_meter_last
 * @property double $water_per_unit
 * @property double $elect_per_unit
 * @property string $last_pay_date
 * @property string $photo
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['building_id'],'required'],
            [['building_id', 'floor', 'customer_id','pay_status','room_status', 'rent_type', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['room_rate', 'water_meter_last', 'elect_meter_last', 'water_per_unit', 'elect_per_unit'], 'number'],
            [['last_pay_date','photo'], 'safe'],
            [['room_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_no' => 'เลขที่ห้อง',
            'building_id' => 'ตึก',
            'floor' => 'ชั้นที่',
            'customer_id' => 'ลูกค้า',
            'room_rate' => 'ค่าเช่า',
            'rent_type' => 'ประเภทการเช่า',
            'water_meter_last' => 'มิเตอรน้ำล่าสุด',
            'elect_meter_last' => 'มิเตอร์ไฟล่าสุด',
            'water_per_unit' => 'น้ำหน่วยละ',
            'elect_per_unit' => 'ไฟหน่วยละ',
            'last_pay_date' => 'ชำระล่าสุด',
            'photo' => 'รูป',
            'pay_status' => 'ชำระเงิน',
            'room_status' => 'สถานะเช่า',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
