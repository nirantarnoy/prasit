<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Trans */

$this->title = $model->trans_no;
$this->params['breadcrumbs'][] = ['label' => 'บันทึกค่าเช่า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trans-view">

    <div class="row">
        <div class="col-lg-6">
            <h1>เลขที่ <?= Html::encode($this->title) ?></h1>
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
                        return '<div class="label label-default">'.\backend\helpers\TransStatus::getTypeById($data->status);
                    }else{
                        return '<div class="label label-success">'.\backend\helpers\TransStatus::getTypeById($data->status);
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

    <br>
    <div class="form-group">
        <form id="form-slip" action="index.php?r=trans/printslip" target="_blank" method="post">
            <input type="hidden" class="row_selected" value="" name="row_selected">
            <input type="hidden" class="cur_trans_id" value="<?=$model->id?>" name="cur_trans_id">

            <input type="submit" class="btn btn-default" value="พิมพ์ใบแจ้งค่าเช่า">
            <?php if($model->status != 3):?>
            <div class="btn btn-warning btn-none-pay">บันทึกค้างชำระ</div>
            <div class="btn btn-success btn-complete">บันทึกชำระเงิน</div>
            <?php endif;?>
            <!--            <input type="submit" class="btn btn-warning" value="บันทึกค้างชำระ">-->
        </form>


    </div>
    <table class="table table-bordered table-list">
        <thead>
        <tr >
            <th style="text-align: center">
                <input type="checkbox" class="check_all" value="">
            </th>
            <th style="text-align: center">#</th>
            <th style="text-align: center;vertical-align: middle">ห้อง</th>
            <th style="text-align: right;vertical-align: middle">ค่าห้อง</th>
            <th style="text-align: right;vertical-align: middle">ค่าน้ำ</th>
            <th style="text-align: right;vertical-align: middle">ค่าไฟ</th>
            <th style="text-align: right;vertical-align: middle">ค่าปรับล่าช้า</th>
            <th style="text-align: right;vertical-align: middle">ค่าจอดรถ</th>
            <th style="text-align: right;vertical-align: middle">ค้างชำระ</th>
            <th style="text-align: right;vertical-align: middle">รวม</th>
            <th style="text-align: center;vertical-align: middle">สถานะ</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=0;?>
        <?php foreach ($modelline as $value):?>
            <?php $i++;?>
        <tr>
            <td style="text-align: center;vertical-align: middle">
                <input type="checkbox" class="row_check" name="row_selected" onchange="addselect($(this))">
                <input type="hidden" value="<?=$value->id?>" name="row_id" class="row_id">
            </td>
            <td style="text-align: center;vertical-align: middle"><?=$i?></td>
            <td style="text-align: center;vertical-align: middle">
                <?=\backend\models\Room::findInfo($value->room_id)->room_no?>
            </td>
            <td style="text-align: right;vertical-align: middle"><?=number_format($value->price)?></td>
            <td style="text-align: right;vertical-align: middle"><?=number_format($value->water_price)?></td>
            <td style="text-align: right;vertical-align: middle"><?=number_format($value->elect_price)?></td>
            <td style="text-align: right;vertical-align: middle"><?=number_format($value->fine_amt)?></td>
            <td style="text-align: right;vertical-align: middle"><?=number_format($value->parking_amt)?></td>
            <td style="text-align: right;vertical-align: middle"><?=number_format($value->none_pay_amt)?></td>
            <td style="text-align: right;color: red;vertical-align: middle"><?=number_format($value->total_amt)?></td>
            <td style="text-align: center;vertical-align: middle">
                <?php if($value->status ==1):?>
                <span class="label label-default">
                    <?=\backend\helpers\TransLineStatus::getTypeById($value->status)?>
                </span>
                <?php elseif($value->status ==2):?>
                    <span class="label label-success">
                    <?=\backend\helpers\TransLineStatus::getTypeById($value->status)?>
                    </span>
                <?php elseif($value->status ==3):?>
                    <span class="label label-warning">
                    <?=\backend\helpers\TransLineStatus::getTypeById($value->status)?>
                </span>
                <?php endif;?>

            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>

</div>
<?php
$url_to_print = Url::to(['trans/printslip'],true);
$js=<<<JS
var row_selected = [];
 $(function() {
   $(".check_all").change(function(){
       
       if($(this).is(':checked')){
           row_selected = [];
         $(".table-list tbody tr").each(function() {
             var id = $(this).find(".row_id").val();
             $(this).find(".row_check").prop('checked', 'checked'); 
             row_selected.push(id);
         });
       }else{
         $(".table-list tbody tr").each(function() {
            var id = $(this).find(".row_id").val();
            $(this).find(".row_check").prop('checked', '');  
            row_selected.pop(id);
         });
       }
       $(".row_selected").val(row_selected);
    });
   
     $(".btn-none-pay").click(function(){
         if(confirm('คุณต้องการบันทึกค้างชำระใช่หรือไม่?')){
           var list = $(".row_selected").val();
           if(list.length <= 0){
               alert("ต้องเลือกอย่างน้อย 1 รายการก่อน");
           }else{
               $("#form-slip").attr("target","_parent");
               $("#form-slip").attr("action","index.php?r=trans/recordnonepay");
               $("#form-slip").submit();
           } 
     }
     });
     $(".btn-complete").click(function(){
         if(confirm('คุณต้องการบันทึกจบงวดใช่หรือไม่?')){
           var list = $(".row_selected").val();
           if(list.length <= 0){
               alert("ต้องเลือกอย่างน้อย 1 รายการก่อน");
           }else{
               $("#form-slip").attr("target","_parent");
               $("#form-slip").attr("action","index.php?r=trans/recordcomplete");
               $("#form-slip").submit();
           } 
     }
     });
   
//   $(".btn-all-print").click(function(){
//       if(confirm('คุณต้องการปริ้นใบเสร็จใช่หรือไม่?')){
//           var list = $(".row_selected").val();
//           if(list.length <= 0){
//               alert("ต้องเลือกอย่างน้อย 1 รายการก่อน");
//           }else{
//               $.ajax({
//                  'type': 'post',
//                  'dataType': 'html',
//                  'url': "$url_to_print",
//                  'data': {'list': list},
//                  'success': function(data){
//                     // alert(data);
//                  }
//               })
//           }
//       }
//   });
   
 });
 
 function addselect(e) {
   if(e.is(':checked')){
       var id =e.closest("tr").find(".row_id").val();
       row_selected.push(id);
   }else{
       var id = $(this).find(".row_id").val();
       row_selected.pop(id);
   }
       $(".row_selected").val(row_selected);
 }
JS;
$this->registerJs($js,static::POS_END);
?>
