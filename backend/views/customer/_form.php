<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use toxor88\switchery\Switchery;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$prov = \common\models\Province::find()->all();
$amp = \common\models\Amphur::find()->all();
$dist = \common\models\District::find()->all();

?>

<div class="panel">
    <div class="panel-heading">
        <div class="x_title">
            <h3><i class="fa fa-user-circle-o"></i> <?=$this->title?> <small></small></h3>
            <!-- <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul> -->
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <br />

            <?php $form = ActiveForm::begin(['options'=>['class'=>'','enctype'=>'multipart/form-data']]); ?>

            <div class="row">
                <div class="col-lg-3">
                    <?php if($model->photo ==''):?>
                        <?= $form->field($model, 'photo')->fileInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                    <?php else:?>
                        <?= Html::img('@web/uploads/photo/'.$model->photo,['style'=>'width: 100%;']);?><br>
                        <a href="<?=Url::to(['customer/deletephoto','id'=>$model->id,'photoname'=>$model->photo,'type'=>1])?>"><i class="fa fa-trash-o"></i> ลบรูปภาพ</a>
                    <?php endif;?>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-4">
                            <?= $form->field($model, 'code')->textInput(['maxlength' => true,'class'=>'form-control'])->label() ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true,'class'=>'form-control'])->label() ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true,'class'=>'form-control'])->label() ?>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-4">
                            <?= $form->field($model, 'sex')->widget(Select2::className(),[
                                'data'=>ArrayHelper::map(\backend\helpers\GenderType::asArrayObject(),'id','name'),
                                'options' => ['placeholder'=>'เลือก'],
                                'pluginOptions' => [
                                    'allowClear'=>true,
                                ]
                            ])->label() ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($model, 'card_id')->textInput(['maxlength' => true,'class'=>'form-control'])->label() ?>
                        </div>
                        <div class="col-lg-4">
                            <?php $model->bod = $model->isNewRecord?date('d-m-Y'):$model->bod;?>
                            <?= $form->field($model, 'bod')->widget(DatePicker::className(), [
                                //'options' => ['placeholder' => 'Enter birth date ...'],
                                'pluginOptions' => [
                                    'autoclose'=>true
                                ]
                            ]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <?= $form->field($model, 'customer_group_id')->widget(Select2::className(),[
                                'data'=>ArrayHelper::map(\backend\models\CustomerGroup::find()->all(),'id','name'),
                                'options' => ['placeholder'=>'เลือกกลุ่ม'],
                                'pluginOptions' => [
                                    'allowClear'=>true,
                                ]
                            ])->label() ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($model, 'phone')->textInput(['maxlength' => true,'class'=>'form-control'])->label() ?>
                        </div>
                        <div class="col-lg-3">
                            <?php echo $form->field($model, 'status')->widget(Switchery::className(),['options'=>['label'=>'','class'=>'form-control']])->label() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <?= $form->field($model, 'description')->textarea(['maxlength' => true,'class'=>'form-control'])->label() ?>
                        </div>
                    </div>


                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field(!$model->isNewRecord?$model_address_plant:$model_address, 'address')->textarea(['maxlength' => true,'class'=>'form-control'])->label() ?>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field(!$model->isNewRecord?$model_address_plant:$model_address, 'street')->textInput(['maxlength' => true,'class'=>'form-control'])->label() ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field(!$model->isNewRecord?$model_address_plant:$model_address, 'district_id')->widget(Select2::className(),
                                [
                                    'data'=> ArrayHelper::map($dist,'DISTRICT_ID','DISTRICT_NAME'),
                                    'options'=>['maxlength' => true,'class'=>'form-control form-inline','id'=>'district','disabled'=>'disabled'],
                                ]

                            )->label() ?>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-4">
                            <?= $form->field(!$model->isNewRecord?$model_address_plant:$model_address, 'city_id')->widget(Select2::className(),
                                [
                                    'data'=> ArrayHelper::map($amp,'AMPHUR_ID','AMPHUR_NAME'),
                                    'options'=>['maxlength' => true,'class'=>'form-control form-inline','id'=>'city','disabled'=>'disabled',
                                        'onchange'=>'
                                          $.post("'.Url::to(['plant/showdistrict'],true).'"+"&id="+$(this).val(),function(data){
                                          $("select#district").html(data);
                                          $("select#district").prop("disabled","");

                                        });
                                           $.post("'.Url::to(['plant/showzipcode'],true).'"+"&id="+$(this).val(),function(data){
                                                $("#zipcode").val(data);
                                              });
                                       '
                                    ],
                                    'pluginOptions'=>[
                                        'allowClear'=>true,
                                    ]
                                ]

                            )->label() ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field(!$model->isNewRecord?$model_address_plant:$model_address, 'province_id')->widget(Select2::className(),
                                [
                                    'data'=> ArrayHelper::map($prov,'PROVINCE_ID','PROVINCE_NAME'),
                                    'options'=>['maxlength' => true,'class'=>'form-control form-inline','id'=>'province',
                                        'onchange'=>'
                                          $.post("'.Url::to(['plant/showcity'],true).'"+"&id="+$(this).val(),function(data){
                                          $("select#city").html(data);
                                          $("select#city").prop("disabled","");

                                        });
                                       '
                                    ],
                                ]

                            )->label() ?>
                        </div>
                        <div class="col-lg-4">
                            <?php if(!$model->isNewRecord):?>
                                <?= $form->field($model_address_plant, 'zipcode')->textInput(['class'=>'form-control','id'=>'zipcode','readonly'=>'readonly'])->label() ?>
                            <?php else:?>
                                <?= $form->field($model_address, 'zipcode')->textInput(['class'=>'form-control','id'=>'zipcode','readonly'=>'readonly'])->label() ?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>

            </div>



            <div class="form-group">

                    <input type="submit" value="Save" class="btn btn-success">

            </div>

                    <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
