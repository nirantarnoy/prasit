<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Trans */

$this->title = $model->trans_no;
$this->params['breadcrumbs'][] = ['label' => 'บันทึกค่าเช่า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trans-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
            'trans_no',
            'trans_date',
            //'trans_type',
            [
                'attribute' => 'building_id',
                'value' => function($data){
                    return \backend\models\Building::findName($data->building_id);
                }
            ],
            [
                'attribute'=>'status',
                'contentOptions' => ['style' => 'vertical-align: middle'],
                'format' => 'html',
                'value'=>function($data){
                    if($data->status == 1){
                        return '<div class="label label-success">'.\backend\helpers\TransStatus::getTypeById($data->status);
                    }else{
                        return '<div class="label label-default">'.\backend\helpers\TransStatus::getTypeById($data->status);
                    }

                }
            ],
            ['attribute'=>'created_at',
              'value'=>function($data){
                return date('d-m-Y',$data->created_at);
             }
            ],
//            'created_at',
//            'updated_at',
//            'created_by',
//            'updated_by',
        ],
    ]) ?>

</div>
