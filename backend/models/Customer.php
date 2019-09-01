<?php
namespace backend\models;
use Yii;
use yii\db\ActiveRecord;
date_default_timezone_set('Asia/Bangkok');

class Customer extends \common\models\Customer
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

    public function findCode($id){
        $model = Customer::find()->where(['id'=>$id])->one();
        return count($model)>0?$model->code:'';
    }
    public function findInfo($id){
        $model = Customer::find()->where(['id'=>$id])->one();
        return count($model)>0?$model:null;
    }
    public function findFullname($id){
        $model = Customer::find()->where(['id'=>$id])->one();
        return count($model)>0?$model->first_name.' '.$model->last_name:'';
    }
    public function findName($id){
        $model = Customer::find()->where(['id'=>$id])->one();
        return count($model)>0?$model->first_name.' '.$model->last_name:'';
    }
    public function findId($code){
        $model = Customer::find()->where(['code'=>$code])->one();
        return count($model)>0?$model->id:0;
    }
    public function findPhone($id){
        $model = Customer::find()->where(['id'=>$id])->one();
        return count($model)>0?$model->phone:'';
    }
    public function findAddress($id){
        $model = \common\models\Addressbook::find()->where(['party_type_id'=>2,'party_id'=>$id])->one();
        $address = '';
        if($model){
            $address = $model->address." ".$model->street." ".self::findDistrictname($model->district_id)." ".self::findCityname($model->city_id)." ".self::findProvincename($model->province_id)." ".$model->zipcode;
        }
        return $address;
    }
    public function findDistrictname($id){
        $model = \common\models\District::find()->where(['DISTRICT_ID'=>$id])->one();
        return count($model)>0?$model->DISTRICT_NAME:'';
    }
    public function findCityname($id){
        $model = \common\models\Amphur::find()->where(['AMPHUR_ID'=>$id])->one();
        return count($model)>0?$model->AMPHUR_NAME:'';
    }
    public function findProvincename($id){
        $model = \common\models\Province::find()->where(['PROVINCE_ID'=>$id])->one();
        return count($model)>0?$model->PROVINCE_NAME:'';
    }
}
