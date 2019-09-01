<?php
namespace backend\models;
use Yii;
use yii\db\ActiveRecord;
date_default_timezone_set('Asia/Bangkok');

class AddressBook extends \common\models\Addressbook
{
    public function behaviors()
    {
        return [
            'timestampcdate'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>'created_at',
                ],
                'value'=> time(),
            ],
            'timestampudate'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>'updated_at',
                ],
                'value'=> time(),
            ],
            'timestampcby'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>'created_by',
                ],
                'value'=> Yii::$app->user->identity->id,
            ],
            'timestamuby'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_UPDATE=>'updated_by',
                ],
                'value'=> Yii::$app->user->identity->id,
            ],
            'timestampupdate'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_UPDATE=>'updated_at',
                ],
                'value'=> time(),
            ],
        ];
    }
    public function findAddress($id){
        $model = AddressBook::find()->where(['party_id'=>$id])->andFilterWhere(['party_type_id'=>2])->one();
        if(count($model)>0){
            return $model->address." ".$model->street." ".self::getDistrict($model->district_id)
                ." ".self::getCity($model->city_id)
                ." ".self::getProvince($model->province_id)
                ." ".$model->zipcode;
        }else{
            return 'no';
        }
    }
    public function getDistrict($id){
        $model = \common\models\District::find()->where(['DISTRICT_ID'=>$id])->one();
        return count($model)>0?$model->DISTRICT_NAME:'';
    }
    public function getCity($id){
        $model = \common\models\Amphur::find()->where(['AMPHUR_ID'=>$id])->one();
        return count($model)>0?$model->AMPHUR_NAME:'';
    }
    public function getProvince($id){
        $model = \common\models\Province::find()->where(['PROVINCE_ID'=>$id])->one();
        return count($model)>0?$model->PROVINCE_NAME:'';
    }
}
