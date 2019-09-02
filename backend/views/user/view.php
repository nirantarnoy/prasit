<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ผู้ใช้งาน'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
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
            'username',
          //  'auth_key',
          //  'password_hash',
          //  'password_reset_token',
            'email:email',
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
            [
                    'attribute'=>'group_id',
                    'value' => function($data){
                        return \backend\models\Usergroup::findGroupName($data->group_id);
                    }
            ]
        ],
    ]) ?>

    </div>
</div>
</div>
