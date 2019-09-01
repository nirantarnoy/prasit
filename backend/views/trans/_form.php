<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Trans */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'trans_no')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>$model->isNewRecord?$runno:$model->trans_no]) ?>
        </div>
        <div class="col-lg-3">
            <?php $model->trans_date = $model->isNewRecord?date('d-m-Y'):$model->trans_date;?>
            <?= $form->field($model, 'trans_date')->widget(DatePicker::className(), [
                //'options' => ['placeholder' => 'Enter birth date ...'],
                'pluginOptions' => [
                    'autoclose'=>true
                ]
            ]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'status')->textInput(['readonly'=>'readonly','value'=>'รอยืนยัน']) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'building_id')->widget(Select2::className(),[
                    'data'=>ArrayHelper::map(\backend\models\Building::find()->all(),'id','name'),
                    'options' => ['placeholder'=>'เลือกตึก','onChange'=>'getRoomByBuilding($(this))']
            ]) ?>
        </div>
    </div>
    <br>
    <div class="btn btn-info"><i class="glyphicon glyphicon-upload"></i> นำเข้าจาก Excel</div>
    <hr>

<div class="table-responsive">
    <table class="table table-bordered" id="table-room">
        <thead>
        <tr>
            <th>#</th>
            <th>เลขที่ห้อง</th>
            <th>ค่าห้อง</th>
            <th style="background-color: #17a2b8;text-align: right">น้ำเก่า</th>
            <th style="background-color: #17a2b8;text-align: right">น้ำใหม่</th>
            <th style="background-color: #17a2b8;text-align: right">รวมน้ำ(หน่วย)</th>
            <th style="background-color: #17a2b8;text-align: right">รวมน้ำ(บาท)</th>
            <th style="background-color: #bf800c;text-align: right">ไฟเก่า</th>
            <th style="background-color: #bf800c;text-align: right">ไฟใหม่</th>
            <th style="background-color: #bf800c;text-align: right">รวมไฟ(หน่วย)</th>
            <th style="background-color: #bf800c;text-align: right">รวมไฟ(บาท)</th>
            <th>ค่าจอดรถ</th>
            <th>ค่าปรับ</th>
            <th style="background-color: #17a2b8;text-align: right">รวมทั้งสิ้น</th>
        </tr>
        </thead>
        <tbody>
<!--        <tr>-->
<!--            <td style="vertical-align: middle">1</td>-->
<!--            <td style="vertical-align: middle">-->
<!--                101-->
<!--                <input type="hidden" name="room_id" value="">-->
<!--            </td>-->
<!--            <td style="vertical-align: middle">2,500</td>-->
<!--            <td style="vertical-align: middle">1090</td>-->
<!--            <td style="vertical-align: middle"><input type="text" class="form-control" style="width: 80px;" name="water_new[]" onclick="checknum($(this))"></td>-->
<!--            <td style="vertical-align: middle">110</td>-->
<!--            <td style="vertical-align: middle">880</td>-->
<!--            <td style="vertical-align: middle">34409</td>-->
<!--            <td style="vertical-align: middle"><input type="text" class="form-control" style="width: 80px;" name="elect_ner[]" onclick="checknum($(this))"></td>-->
<!--            <td style="vertical-align: middle">100</td>-->
<!--            <td style="vertical-align: middle">800</td>-->
<!--            <td style="vertical-align: middle;text-align: center">-->
<!--                <input type="checkbox" class="form-check-input" name="parking[]" onchange="checkSelect($(this))">-->
<!--            </td>-->
<!--            <td style="vertical-align: middle;text-align: center">-->
<!--                <input type="checkbox" class="form-check-input" name="fee[]" onchange="checkSelect($(this))">-->
<!--            </td>-->
<!--            <td class="row_amt" style="background-color: #17a2b8;font-weight: bold;text-align: right;vertical-align: middle">-->
<!--                4,100-->
<!--                <input type="hidden" class="line_total" name="line_total" value="0">-->
<!--            </td>-->
<!--        </tr>-->
        <tr>
            <td colspan="13"></td>
            <td style="background-color: #0c5460;color:#ffffff;text-align: right">4,100</td>
        </tr>
        </tbody>
    </table>
</div>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$url_to_get_room = Url::to(['trans/findroom'],true);
$js=<<<JS
   $(function(){
       
   });
function checknum(event){
   event.val(event.val().replace(/[^0-9\.]/g,""));
   if((event.which != 46 || event.val().indexOf(".") != -1) && (event.which <48 || event.which >57)){event.preventDefault();}
}

function cal_line(e) {
  var last_w = e.closest('tr').find('.last_water_line').text();
  var new_w = e.closest('tr').find('.water_new_line').val();
  var water_price = e.closest('tr').find('.water_per_unit').val();
  var w_unit =  parseFloat(parseFloat(new_w)- parseFloat(last_w)) ;
  var w_amt = parseFloat(w_unit * parseFloat(water_price));
  
  e.closest('tr').find('.water_unit').text(w_unit);
  e.closest('tr').find('.water_price').text( parseFloat(w_amt).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
  
   
  var last_e = e.closest('tr').find('.last_elect_line').text();
  var new_e = e.closest('tr').find('.elect_new_line').val();
  var e_price = e.closest('tr').find('.elect_per_unit').val();
  var e_unit =  parseFloat(parseFloat(new_e)- parseFloat(last_e)) ;
  var e_amt = parseFloat(e_unit * parseFloat(e_price));
  e.closest('tr').find('.elect_unit').text(e_unit);
  e.closest('tr').find('.elect_price').text( parseFloat(e_amt).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
  
  var room_price = e.closest('tr').find('.room_rate').text().replace(',','');
  e.closest('tr').find('.line_total').val(parseFloat(parseFloat(room_price) + w_amt + e_amt).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
  e.closest('tr').find('.row_amt').text(parseFloat(parseFloat(room_price) + w_amt + e_amt).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
}
function checkSelect(event) {
  if(event.prop("checked") == true){
      var c_row = event.closest("tr").find(".line_total");
       var line_total = c_row.val().replace(',','');
       alert(line_total);
       c_row.val(parseFloat(line_total)+300);
       event.closest("tr").find(".row_amt").text(parseFloat(parseFloat(line_total)+300).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    }else{
       var c_row = event.closest("tr").find(".line_total");
       var line_total = c_row.val();
      // alert(parseFloat(line_total)-300);
       c_row.val(parseFloat(line_total)-300);
       event.closest("tr").find(".row_amt").text(parseFloat(parseFloat(line_total)-300).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    }
}
function checkSelect2(event) {
  if(event.prop("checked") == true){
      var c_row = event.closest("tr").find(".line_total");
       var line_total = c_row.val().replace(',','');
       alert(line_total);
       c_row.val(parseFloat(line_total)+100);
       event.closest("tr").find(".row_amt").text(parseFloat(parseFloat(line_total)+100).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    }else{
       var c_row = event.closest("tr").find(".line_total");
       var line_total = c_row.val();
      // alert(parseFloat(line_total)-300);
       c_row.val(parseFloat(line_total)-100);
       event.closest("tr").find(".row_amt").text(parseFloat(parseFloat(line_total)-100).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    }
}

function getRoomByBuilding(e) {
   if(e.val()>0){
       $.ajax({
          'type': 'post',
          'dataType': 'html',
          'url': "$url_to_get_room",
          'data': {'id': e.val()},
          'success': function(data){
              $("#table-room tbody").html(data);
          }
       })
   }
}

JS;
$this->registerJs($js,static::POS_END);
?>
