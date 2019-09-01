<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Room */
/* @var $form yii\widgets\ActiveForm */
$customer = [];
  $x = \backend\models\Customer::find()->all();
  if($x){
    $customer = ArrayHelper::map($x,'id',function($data){
        return $data->first_name.' '.$data->last_name;
    });
  }

?>

<div class="room-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'room_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'building_id')->widget(Select2::className(),[
                'data'=> ArrayHelper::map(\backend\models\Building::find()->all(),'id','name'),
                'options' => ['placeholder'=>'เลือก','onChange'=>'getBuildinginfo($(this).val());']

            ]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'floor')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'room_rate')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'water_per_unit')->textInput(['class'=>'form-control water_unit_per']) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'elect_per_unit')->textInput(['class'=>'form-control elect_unit_per']) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'water_meter_last')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'elect_meter_last')->textInput() ?>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'last_pay_date')->textInput(['readonly'=>'readonly']) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'status')->widget(Select2::className(),[
                'data'=> ArrayHelper::map(\backend\helpers\RoomStatus::asArrayObject(),'id','name'),

            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'photo')->fileInput() ?>
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

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <hr>
    <h4>บันทึกสัญญาเช่า <small><div class="btn btn-info btn-add-lease"><i class="glyphicon glyphicon-plus"></i></div></small></h4>
    <br>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>รหัสลูกค้า</th>
            <th>ชื่อ-นามสกุล</th>
            <th>เข้าอยู่เมื่อ</th>
            <th>ประเภทเช่า</th>
            <th>มัดจำ</th>
            <th>ค่าประกัน</th>
            <th>สถานะ</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <?php ActiveForm::end(); ?>

</div>

<div id="leaseModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>สัญญาเช่าห้องพัก</h3>
            </div>
            <div class="modal-body" style="white-space:nowrap;overflow-y: auto">
                <input type="hidden" name="line_qc_product" class="line_qc_product" value="">
                <table class="table table-bordered table-striped table-list">
                    <tbody>
                    <tr>
                        <td>เลขที่ห้อง</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>ลูกค้า</td>
                        <td>
                            <?php
                            echo Select2::widget([
                                'name' => 'customer_id',
                                'data' => $customer,
                                'options' => [
                                    'placeholder' => 'เลือกลูกค้า',
                                   // 'multiple' => true
                                ],
                            ]);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>เข้าอยู่เมื่อ</td>
                        <td>
                            <?php
                            echo DatePicker::widget([
                                'name' => 'start_date',
                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                'value' => date('d-m-Y'),
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'dd-mm-yyyy'
                                ],
                                'options' => [
                                        'width' => 100
                                ]
                            ]);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>มัดจำ</td>
                        <td>
                            <input type="text" class="form-control" name="advance_amt" value="" style="width: 200px">
                        </td>
                    </tr>
                    <tr>
                        <td>เงินประกัน</td>
                        <td>
                            <input type="text" class="form-control" name="advance_amt" value="" style="width: 200px">
                        </td>
                    </tr>
                    <tr>
                        <td>หมายเหตุ</td>
                        <td>
                            <textarea class="form-control" name="note" id="" cols="30" rows="5"></textarea>
                        </td>
                    </tr>


                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-close text-danger"></i> บันทึก</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close text-danger"></i> ปิดหน้าต่าง</button>
            </div>
        </div>

    </div>
</div>


<?php
$url_to_del_photo = Url::to(['room/deletephoto'],true);
$url_to_building_info = Url::to(['room/findbuildinfo'],true);
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
     $(".btn-add-lease").click(function(){
         $("#leaseModal").modal("show");
     });
  });

function getBuildinginfo(id){
    //alert(id);return;
            $.ajax({
               'type': 'post',
               'dataType': 'json',
               'url': "$url_to_building_info",
               'data': {'id': id},
               'success': function(data){
                  // alert(data['water_unit_per']);
                   $(".water_unit_per").val(data['water_unit_per']);
                   $(".elect_unit_per").val(data['elect_unit_per']);
               }
             });
}
  
JS;
$this->registerJs($js,static::POS_END);
?>
