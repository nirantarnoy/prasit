<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Building */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Buildings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="building-view">

    <div class="row">
        <div class="col-lg-6">
            <h1>ห้องเช่าเลขที่ <?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6" style="text-align: right">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'code',
            'name',
            'description',
            'floor_qty',
            'room_qty',
            'photo',
            [
                'attribute'=>'status',
                'contentOptions' => ['style' => 'vertical-align: middle'],
                'format' => 'html',
                'value'=>function($data){
                    return $data->status === 1 ? '<div class="label label-success">Active</div>':'<div class="label label-default">Inactive</div>';
                }
            ],
//            'created_at',
//            'updated_at',
//            'created_by',
//            'updated_by',
        ],
    ]) ?>

</div>
