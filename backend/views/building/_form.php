<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Building */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="building-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype' => 'multipart/form-data']]); ?>
   <div class="row">
       <div class="col-lg-3">
           <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
       </div>
       <div class="col-lg-3">
           <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
       </div>
       <div class="col-lg-6">
           <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
       </div>
   </div>

   <div class="row">
       <div class="col-lg-3">
           <?= $form->field($model, 'floor_qty')->textInput() ?>
       </div>
       <div class="col-lg-3">
           <?= $form->field($model, 'room_qty')->textInput() ?>
       </div>
       <div class="col-lg-3">
           <?= $form->field($model, 'water_unit_per')->textInput() ?>
       </div>
       <div class="col-lg-3">
           <?= $form->field($model, 'elect_unit_per')->textInput() ?>
       </div>

   </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'parking_rate')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'fee_rate')->textInput() ?>
        </div>


    </div>
    <hr>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'photo')->fileInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">

                <img src="../web/uploads/photo/<?=$model->photo?>" width="100%" alt="">

        </div>
    </div>
    <br>
    <?php if($model->photo !=''):?>
        <div class="btn btn-danger btn-del-photo">ลบรูปภาพ</div>
    <?php endif;?>
    <hr>
<!--    <div class="row">-->
<!--        <div class="col-lg-3">-->
<!--            --><?php //echo $form->field($model, 'status')->textInput(['readonly']) ?>
<!--        </div>-->
<!--    </div>-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$url_to_del_photo = Url::to(['building/deletephoto'],true);
$js=<<<JS
  $(function(){
     $(".btn-del-photo").click(function(){
         if(confirm('ต้องการลบรูปภาพใช่หรือไม่')){
             $.ajax({
               'type': 'post',
               'dataType': 'html',
               'url': "$url_to_del_photo",
               'data': {'photo': "$model->photo",'id': "$model->id"},
               'success': function(data){
                   location.reload();
               }
             });
         }
         
     });  
  })
  
JS;
$this->registerJs($js,static::POS_END);
?>
