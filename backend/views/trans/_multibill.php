<?php
use yii\helpers\Html;

?>
<?php foreach($modelline as $value):?>
<?php
  $billinfo = \backend\models\Trans::findInfo($value->trans_id);
  $room_lease = \backend\models\Roomlease::find()->where(['room_id'=>$value->room_id,'status'=>1])->one();
  $custinfo = \backend\models\Room::findCustInfo($value->room_id);
  $roominfo = \backend\models\Room::findInfo($value->room_id);
?>
<table width="100%">
    <tr>
        <td width="100%" style="text-align: center"><h3>ประสิทธิ์ห้องเช่า</h3></td>
    </tr>
    <tr>
        <td width="100%" style="text-align: center"><h4>
<!--                169/343 หมู่บ้านพฤกษ์ลดาเพชรเกษม-สาย4 ตำบล แคราย อำเภอกระทุ่มแบน สมุทรสาคร-->
                <?php echo \backend\models\AddressBook::findAddressPlant(1).' โทร '.$plant_mobile->mobile ?>
            </h4></td>
    </tr>
    <tr>
        <td width="100%" style="text-align: center"><h2>ใบเสร็จรับเงิน</h2></td>
    </tr>
</table>


<!--<table width="100%">-->
<!--    <tr>-->
<!--        <td width="70%" style="border: 1px solid gray;border-radius: 25px;padding: 10px;">-->
<!--            <h3>ชื่อ : --><?php //echo=""?><!--</h3><br>-->
<!--            <h4>ที่อยู่ : --><?php //echo=""?><!--</h4><br>-->
<!--            <h4>โทร : --><?php //echo=""?><!--</h4><br>-->
<!--        </td>-->
<!--        <td width="30%" style="border: 1px solid gray;border-radius: 25px;padding: 10px;">-->
<!--            <h3>เลขที่ : --><?php //echo=date('d/m/Y')?><!--</h3><br>-->
<!--            <h3>วันที่ : --><?php //echo=date('d/m/Y')?><!--</h3><br>-->
<!--            <h4>ห้อง : </h4><br>-->
<!--        </td>-->
<!--    </tr>-->
<!--</table>-->


<table class="" width="100%" style="border: 1px solid gray" cellspacing="0">
    <thead>
    <tr>
        <td style="padding: 10px;border-bottom: 1px solid gray;border-right: 1px solid gray" colspan="2">
            <h3>ชื่อ : <?=$custinfo->first_name.' '.$custinfo->last_name?></h3><br>
            <h3>ที่อยู่ : <?=\backend\models\Customer::findAddress($custinfo->id)?></h3><br>
            <h3>โทร : <?=\backend\models\Customer::findPhone($custinfo->id)?></h3><br>
        </td>
        <td style="padding: 10px;border-bottom: 1px solid gray;" colspan="3">
            <h3>เลขที่ : <?=$billinfo->trans_no?></h3><br>
            <h3>วันที่ : <?=date('d/m/Y', strtotime($billinfo->trans_date))?></h3><br>
            <h3>ห้อง : <?=\backend\models\Room::findInfo($value->room_id)->room_no?> </h3><br>
        </td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td width="10%" style="border-bottom: 1px solid gray;border-right: 1px solid gray;font-size: 12px;font-weight: bold;text-align: center;padding: 10px 10px 10px 10px;">ลำดับ</td>
        <td width="50%" style="border-bottom: 1px solid gray;border-right: 1px solid gray;font-size: 12px;font-weight: bold;text-align: center;">รายการ</td>
        <td style="border-bottom: 1px solid gray;border-right: 1px solid gray;font-size: 12px;font-weight: bold;text-align: center">จำนวนหน่วย</td>
        <td style="border-bottom: 1px solid gray;border-right: 1px solid gray;font-size: 12px;font-weight: bold;text-align: center">ราคา/หน่วย</td>
        <td width="15%" style="border-bottom: 1px solid gray;font-size: 12px;font-weight: bold;text-align: right;padding-right: 10px;">จำนวนเงิน</td>
    </tr>
    <tr>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center;padding: 5px 5px 5px 5px;"><?="1"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: left;padding-left: 10px;"><?="ค่าห้อง"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center">1</td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: right;padding-right: 10px;"><?=number_format($value->price)?></td>
        <td style="font-size: 12px;text-align: right;padding-right: 10px;"><?=number_format($value->price * 1)?></td>
    </tr>
    <tr>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center;padding: 5px 5px 5px 5px;"><?="2"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: left;padding-left: 10px;"><?="ค่าน้ำ (".$roominfo->water_meter_last."-".$value->water_after.")"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center"><?=$value->water_unit?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: right;padding-right: 10px;"><?=number_format($roominfo->water_per_unit)?></td>
        <td style="font-size: 12px;text-align: right;padding-right: 10px;"><?=number_format($value->water_price)?></td>
    </tr>
    <tr>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center;padding: 5px 5px 5px 5px;"><?="3"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: left;padding-left: 10px;"><?="ค่าไฟฟ้า (".$roominfo->elect_meter_last."-".$value->elect_after.")"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center"><?=$value->elect_unit?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: right;padding-right: 10px;"><?=number_format($roominfo->elect_per_unit)?></td>
        <td style="font-size: 12px;text-align: right;padding-right: 10px;"><?=number_format($value->elect_price)?></td>
    </tr>
    <tr>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center;padding: 5px 5px 5px 5px;"><?="4"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: left;padding-left: 10px;"><?="ค่าจอดรถ"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center">1</td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: right;padding-right: 10px;"><?=number_format($value->parking_amt)?></td>
        <td style="font-size: 12px;text-align: right;padding-right: 10px;"><?=number_format($value->parking_amt)?></td>
    </tr>
    <tr>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center;padding: 5px 5px 5px 5px;"><?="5"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: left;padding-left: 10px;"><?="ค่าปรับล่าช้า"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center">1</td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: right;padding-right: 10px;"><?=number_format($value->fine_amt)?></td>
        <td style="font-size: 12px;text-align: right;padding-right: 10px;"><?=number_format($value->fine_amt)?></td>
    </tr>
    <tr>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center;padding: 5px 5px 5px 5px;"><?="6"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: left;padding-left: 10px;"><?="ค่าห้อง (ค้างชำระ)"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center"><?=$value->none_pay_amt>0?1:0?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: right;padding-right: 10px;"><?=number_format($value->none_pay_amt)?></td>
        <td style="font-size: 12px;text-align: right;padding-right: 10px;"><?=number_format($value->none_pay_amt)?></td>
    </tr>

    <tr>
        <td colspan="3" style="text-align: center;font-size: 14px; border-top: 1px solid gray;border-right: 1px solid gray;padding: 10px 10px 10px 10px" class="money-text"><?=$value->total_text?></td>
        <td colspan="1" style="text-align: right;font-size: 14px; border-top: 1px solid gray;border-right: 1px solid gray;padding: 10px 10px 10px 10px">รวมสุทธิ</td>
        <td class="grandtotal" style="border: none;font-size: 12px;font-weight: bold;text-align: right;padding-right: 10px ; border-top: 1px solid gray">
            <?=number_format($value->total_amt)?>
        </td>
    </tr>
    <tr style="border: 1px solid gray;display: block">
        <td colspan="5" style="border-top: 1px solid gray;padding: 10px 10px 10px 10px;font-size: 12px;">ชำระโดย</td>

    </tr>
    <tr>
        <td></td>
        <td style="text-align: left;font-size: 12px">[  ] เงินสด</td>
        <td> </td>
        <td colspan="2">
            ..........................................ผู้รับเงิน
        </td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: left;font-size: 12px">[  ] โอนเงิน</td>
        <td></td>
        <td colspan="2">
            ............/........../...............
        </td>
    </tr>
    <tr>
        <td style="color: #FFFFFF">sss</td>
    </tr>
    </tbody>


</table>
    <br><br>
<?php endforeach;?>

<?php
$js =<<<JS
   $(function() {
      var numtext = $(".grandtotal").text(); 
      alert(numtext);
      var txt = ArabicNumberToText(numtext);
      $(".money-text").text(txt);
   });
JS;
$this->registerJs($js,static::POS_END);
?>
