<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\TransSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-search">

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
        <?= $form->field($model, 'status')->widget(Select2::className(),[
            'data'=> ArrayHelper::map(\backend\helpers\TransStatus::asArrayObject(),'id','name'),
            'options' => ['placeholder'=>'สถานะ','onChange'=>'this.form.submit()'],

        ])->label(false)?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
