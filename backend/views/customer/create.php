<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Customer */

$this->title = Yii::t('app', 'สร้างรหัสลูกค้า');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'รหัสลูกค้า'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_address'=>$model_address,
    ]) ?>

</div>
