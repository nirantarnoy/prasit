<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Customergroup */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'กลุ่มลูกค้า'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customergroup-view">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel">
        <div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'id',
            'name',
            'description',
            [
                'attribute'=>'status',
                'format'=>'html',
                'value' => function($data){
                    if($data->status == 1){
                        return "<div class='label label-success'>Active</div>";
                    }else{
                        return " <div class='label label-danger'>Not Active</div>";
                    }
                }
            ],
        ],
    ]) ?>
        </div>
    </div>
</div>
