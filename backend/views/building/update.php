<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Building */

$this->title = 'แก้ไขข้อมูล: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลตึก', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="building-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
