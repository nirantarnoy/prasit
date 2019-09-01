<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Trans */

$this->title = 'สร้างรายการ';
$this->params['breadcrumbs'][] = ['label' => 'บันทึกค่าเช่า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-create">

    <?= $this->render('_form', [
        'model' => $model,
        'runno' => $runno,
    ]) ?>

</div>
