<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Trans */

$this->title = 'แก้ไขรายการ: ' . $model->trans_no;
$this->params['breadcrumbs'][] = ['label' => 'บันทึกค่าเช่า', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->trans_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="trans-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
