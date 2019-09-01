<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $code
 * @property string $first_name
 * @property string $last_name
 * @property string $card_id
 * @property int $customer_group_id
 * @property int $customer_type_id
 * @property string $description
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code','customer_group_id','card_id'],'required'],
            [['code'],'unique'],
            [['customer_group_id','sex', 'customer_type_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['first_name', 'last_name', 'description'], 'string', 'max' => 255],
            [['card_id','phone'], 'string', 'max' => 13],
            [['photo'],'string'],
            [['bod'],'safe'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'รหัสลูกค้า'),
            'first_name' => Yii::t('app', 'ชื่อ'),
            'last_name' => Yii::t('app', 'นามสกุล'),
            'card_id' => Yii::t('app', 'เลขที่บัตรประชาชน'),
            'customer_group_id' => Yii::t('app', 'กลุ่มลูกค้า'),
            'customer_type_id' => Yii::t('app', 'Customer Type ID'),
            'description' => Yii::t('app', 'รายละเอียด'),
            'phone' => Yii::t('app', 'โทรศัพท์'),
            'status' => Yii::t('app', 'สถานะ'),
            'photo'=>'รูปโปรไฟล์',
            'sex'=>'เพศ',
            'bod'=>'วันเกิด',
            'created_at' => Yii::t('app', 'สร้างเมื่อ'),
            'updated_at' => Yii::t('app', 'แก้ไขเมื่อ'),
            'created_by' => Yii::t('app', 'สร้างโดย'),
            'updated_by' => Yii::t('app', 'แก้ไขโดย'),
        ];
    }
}
