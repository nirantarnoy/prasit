<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Room */

$this->title = 'แก้ไขข้อมูลห้อง: ' . $model->room_no;
$this->params['breadcrumbs'][] = ['label' => 'ห้องพัก', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->room_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="room-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'room_lease' => $room_lease
    ]) ?>

</div>
