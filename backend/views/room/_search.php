<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\RoomSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="form-group">
        <!--         <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search"></i></span>-->
        <?= $form->field($model, 'globalSearch')->textInput(['placeholder'=>'ค้นหา','class'=>'form-control','aria-describedby'=>'basic-addon1'])->label(false) ?>
        <?= $form->field($model, 'building_id')->widget(Select2::className(),[
            'data'=> ArrayHelper::map(\backend\models\Building::find()->all(),'id','name'),
            'options' => ['placeholder'=>'เลือกตึก','onChange'=>'this.form.submit()'],
            'pluginOptions' => [
                    'allowClear' => true,
            ]

        ])->label(false)?>
        <?= $form->field($model, 'room_status')->widget(Select2::className(),[
            'data'=> ArrayHelper::map(\backend\helpers\RentStatus::asArrayObject(),'id','name'),
            'options' => ['placeholder'=>'สถานะ','onChange'=>'this.form.submit()'],
            'pluginOptions' => [
                'allowClear' => true,
            ]

        ])->label(false)?>
        <?= $form->field($model, 'pay_status')->widget(Select2::className(),[
            'data'=> ArrayHelper::map(\backend\helpers\PayStatus::asArrayObject(),'id','name'),
            'options' => ['placeholder'=>'สถานะชำระเงิน','onChange'=>'this.form.submit()'],
            'pluginOptions' => [
                'allowClear' => true,
            ]

        ])->label(false)?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
