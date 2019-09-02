<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Building */

$this->title = 'สร้างข้อมูลตึก';
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลตึก', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-create">
<!--    <div class="panel panel-headline" style="background-color: #f1f1f1">-->
<!--        <div class="panel-body">-->
            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
<!--        </div>-->
<!--    </div>-->
</div>
