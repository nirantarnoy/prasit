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
$this->registerJsFile( '@web/js/ThaiBath-master/thaibath.js',
    ['depends' => [\yii\web\JqueryAsset::className()]],
    static::POS_HEAD
);

?>

<div class="trans-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype' => 'multipart/form-data']]); ?>
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
            <th>ค้างชำระ</th>
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
        <?php if(!$model->isNewRecord):?>
        <?php $i=0;$total_grand=0;?>
          <?php foreach ($modelline as $value):?>
                <?php
                    $i++;
                $roominfo = \backend\models\Room::findInfo($value->room_id);
                $building_data= \backend\models\Building::findInfo($value->room_id);
                $total_grand = ($total_grand + $value->total_amt);
                ?>
                <tr>
                    <input type="hidden" class="water_per_unit" value="<?=$roominfo->water_per_unit?>">
                    <input type="hidden" class="elect_per_unit" value="<?=$roominfo->elect_per_unit?>">
                    <input type="hidden" class="parking_rate" value="<?=$building_data->parking_rate?>">
                    <input type="hidden" class="fine_rate" value="<?=$building_data->fee_rate?>">
                    <td style="vertical-align: middle"><?=$i?></td>
                    <td style="vertical-align: middle;text-align: center">
                        <?=$roominfo->room_no?>
                        <input type="hidden" name="room_id[]" value="<?=$value->room_id?>">
                    </td>
                    <td style="vertical-align: middle;text-align: right" class="room_rate"><?=number_format($roominfo->room_rate)?></td>
                    <td style="vertical-align: middle;text-align: right" class="none_pay"><?=number_format($value->none_pay_amt)?></td>
                    <td style="vertical-align: middle;text-align: right" class="last_water_line"><?=$value->water_before?></td>
                    <td style="vertical-align: middle"><input type="text" class="form-control water_new_line" style="width: 80px;" value="<?=$value->water_after?>" name="water_new[]" onkeypress="checknum($(this))" onchange="cal_line($(this))"></td>
                    <td style="vertical-align: middle;text-align: right" class="water_unit"><?=$value->water_unit?></td>
                    <td style="background-color: #17a2b8;vertical-align: middle;text-align: right" class="water_price"><?=number_format($value->water_price)?></td>
                    <td style="vertical-align: middle;text-align: right" class="last_elect_line"><?=$value->elect_before?></td>
                    <td style="vertical-align: middle;text-align: right"><input type="text" class="form-control elect_new_line" style="width: 80px;" value="<?=$value->elect_after?>" name="elect_new[]" onkeypress="checknum($(this))" onchange="cal_line($(this))"></td>
                    <td style="vertical-align: middle;text-align: right" class="elect_unit"><?=$value->elect_unit?></td>
                    <td style="background-color: #bf800c;vertical-align: middle;text-align: right" class="elect_price"><?=number_format($value->elect_price)?></td>
                    <td style="vertical-align: middle;text-align: center">
                        <input type="hidden" class="is_parking" name="is_parking[]" value="<?=$value->is_parking?>">
                        <?php
                             $checked1 = '';
                             if($value->is_parking){$checked1 = 'checked';}
                        ?>
                        <input type="checkbox" class="form-check-input" <?=$checked1?> id="c_parking-<?=$i?>" name="parking[]" value="Yes" onchange="checkSelect($(this))">
                    </td>
                    <td style="vertical-align: middle;text-align: center">
                        <input type="hidden" class="is_fine" name="is_fine[]" value="<?=$value->is_fine?>">
                        <?php
                        $checked2 = '';
                        if($value->is_fine){$checked2 = 'checked';}
                        ?>
                        <input type="checkbox" class="form-check-input" <?=$checked2?> id="c_fine-<?=$i?>" name="fine[]" onchange="checkSelect2($(this))">
                    </td>
                    <td class="row_amt" style="background-color: #17a2b8;font-weight: bold;text-align: right;vertical-align: middle">
                        <?=number_format($value->total_amt)?>
                    </td>
                    <input type="hidden" class="line_total" name="line_total[]" value="<?=$value->total_amt?>">
                    <input type="hidden" class="money_text" name="money_text[]" value="<?=$value->total_text?>">
                    <input type="hidden" name="none_pay[]" value="<?=number_format($value->none_pay_amt)?>">
                </tr>
          <?php endforeach;?>
<!--            <tr>-->
<!--                <td colspan="14"></td>-->
<!--                <td  style="background-color: #0c5460;color:#ffffff;text-align: right">--><?//=number_format($total_grand)?><!--</td>-->
<!--            </tr>-->
        <?php endif;?>
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

        </tbody>
    </table>
</div>
    <br>
    <div class="form-group">
        <?php if($model->status !=3):?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?php endif;?>
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
  var park_rate = e.closest("tr").find(".parking_rate").val();
  var fine_rate = e.closest("tr").find(".fine_rate").val();
  
  var is_park = e.closest("tr").find(".is_parking").val();
  var is_fine = e.closest("tr").find(".is_fine").val();
  
  var park_amt = 0;
  var fine_amt = 0;
  
  if(is_park == 1){
      park_amt = parseFloat(park_rate);
  }
  if(is_fine == 1){
      park_amt = parseFloat(fine_rate);
  }
  
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
  var none_pay = e.closest('tr').find('.none_pay').text().replace(',','');
  var total_all = parseFloat(parseFloat(room_price)+ parseFloat(none_pay) + w_amt + e_amt + park_amt + fine_amt).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  e.closest('tr').find('.line_total').val(total_all);
  e.closest('tr').find('.row_amt').text(total_all);
  
  var txt = ArabicNumberToText(total_all);
  e.closest('tr').find('.money_text').val(txt);
  
}
function checkSelect(event) {
    var total_all = 0;
    var park_rate = event.closest("tr").find(".parking_rate").val();
  if(event.prop("checked") == true){
      event.closest("tr").find(".is_parking").val(1);
      var c_row = event.closest("tr").find(".line_total");
       var line_total = c_row.val().replace(',','');
      // alert(line_total);
       c_row.val(parseFloat(line_total)+parseFloat(park_rate));
       event.closest("tr").find(".row_amt").text(parseFloat(parseFloat(line_total)+parseFloat(park_rate)).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
       total_all = parseFloat(parseFloat(line_total)+parseFloat(park_rate)).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",");  
  }else{
      event.closest("tr").find(".is_parking").val(0);
       var c_row = event.closest("tr").find(".line_total");
       var line_total = c_row.val();
      // alert(parseFloat(line_total)-300);
       c_row.val(parseFloat(line_total)-parseFloat(park_rate));
       event.closest("tr").find(".row_amt").text(parseFloat(parseFloat(line_total)- parseFloat(park_rate)).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
       total_all = parseFloat(parseFloat(line_total)-parseFloat(park_rate)).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",");   
  }
    //cal_line(event);
    var txt = ArabicNumberToText(total_all);
    event.closest('tr').find('.money_text').val(txt);
}
function checkSelect2(event) {
     var total_all = 0;
    var fine_rate = event.closest("tr").find(".fine_rate").val();
  if(event.prop("checked") == true){
      event.closest("tr").find(".is_fine").val(1);
      var c_row = event.closest("tr").find(".line_total");
       var line_total = c_row.val().replace(',','');
      // alert(line_total);
       c_row.val(parseFloat(line_total)+parseFloat(fine_rate));
       event.closest("tr").find(".row_amt").text(parseFloat(parseFloat(line_total)+parseFloat(fine_rate)).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
       total_all = parseFloat(parseFloat(line_total)+parseFloat(fine_rate)).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",");  
    }else{
      event.closest("tr").find(".is_fine").val(0);
       var c_row = event.closest("tr").find(".line_total");
       var line_total = c_row.val();
      // alert(parseFloat(line_total)-300);
       c_row.val(parseFloat(line_total)-parseFloat(fine_rate));
       event.closest("tr").find(".row_amt").text(parseFloat(parseFloat(line_total)-parseFloat(fine_rate)).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
       total_all = parseFloat(parseFloat(line_total)-parseFloat(fine_rate)).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",");    
  }

   var txt = ArabicNumberToText(total_all);
    event.closest('tr').find('.money_text').val(txt);
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
