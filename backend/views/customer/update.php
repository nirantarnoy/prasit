<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */

$this->title = Yii::t('app', 'แก้ไขรหัสลูกค้า: ' . $model->code, [
    'nameAttribute' => '' . $model->code,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'รหัสลูกค้า'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'แก้ไข');
?>
<div class="customer-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_address'=>$model_address,
        'model_address_plant'=>$model_address_plant,
    ]) ?>

</div>
