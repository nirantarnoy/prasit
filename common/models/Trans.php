<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trans".
 *
 * @property int $id
 * @property string $trans_no
 * @property string $trans_date
 * @property int $trans_type
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Trans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['building_id'],'required'],
            [['trans_date'], 'safe'],
            [['trans_type','building_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['trans_no'], 'string', 'max' => 255],
            [['status'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trans_no' => 'เลขที่',
            'trans_date' => 'วันที่ทำรายการ',
            'trans_type' => 'Trans Type',
            'building_id' => 'ตึก',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
