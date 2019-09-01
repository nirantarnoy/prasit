<?php
use yii\helpers\Html;
$this->registerJsFile( '@web/js/ThaiBath-master/thaibath.js',
    ['depends' => [\yii\web\JqueryAsset::className()]],
    static::POS_HEAD
);


?>
<?php for($i=0;$i<=1;$i++):?>
<table width="100%">
    <tr>
        <td width="100%" style="text-align: center"><h3>ประสิทธิ์ห้องเช่า</h3></td>
    </tr>
    <tr>
        <td width="100%" style="text-align: center"><h4>
<!--                169/343 หมู่บ้านพฤกษ์ลดาเพชรเกษม-สาย4 ตำบล แคราย อำเภอกระทุ่มแบน สมุทรสาคร-->
                <?php echo \backend\models\AddressBook::findAddressPlant(1) ?>
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
            <h3>ชื่อ : <?="นายนิรันดร์ วังญาติ"?></h3><br>
            <h3>ที่อยู่ : <?="111/11 หมู่ 11 ต.อ้อมน้อย อ.กระทุ่มแบน จ.สมุทรสาคร"?></h3><br>
            <h3>โทร : <?="088 7692818"?></h3><br>
        </td>
        <td style="padding: 10px;border-bottom: 1px solid gray;" colspan="3">
            <h3>เลขที่ : <?="REC1900001"?></h3><br>
            <h3>วันที่ : <?=date('d/m/Y')?></h3><br>
            <h3>ห้อง : A101 </h3><br>
        </td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td width="10%" style="border-bottom: 1px solid gray;border-right: 1px solid gray;font-size: 12px;font-weight: bold;text-align: center;padding: 10px 10px 10px 10px;">ลำดับ</td>
        <td width="50%" style="border-bottom: 1px solid gray;border-right: 1px solid gray;font-size: 12px;font-weight: bold;text-align: center;">รายการ</td>
        <td style="border-bottom: 1px solid gray;border-right: 1px solid gray;font-size: 12px;font-weight: bold;text-align: center">จำนวนหน่วย</td>
        <td style="border-bottom: 1px solid gray;border-right: 1px solid gray;font-size: 12px;font-weight: bold;text-align: center">ราคา/หน่วย</td>
        <td width="15%" style="border-bottom: 1px solid gray;font-size: 12px;font-weight: bold;text-align: center;">จำนวนเงิน</td>
    </tr>
    <tr>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center;padding: 5px 5px 5px 5px;"><?="1"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: left;padding-left: 10px;"><?="ค่าห้อง"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center">1</td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center"><?=number_format(2500)?></td>
        <td style="font-size: 12px;text-align: center"><?=number_format(2500)?></td>
    </tr>
    <tr>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center;padding: 5px 5px 5px 5px;"><?="2"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: left;padding-left: 10px;"><?="ค่าน้ำ (500-510)"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center">10</td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center"><?=number_format(15)?></td>
        <td style="font-size: 12px;text-align: center"><?=number_format(150)?></td>
    </tr>
    <tr>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center;padding: 5px 5px 5px 5px;"><?="3"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: left;padding-left: 10px;"><?="ค่าไฟฟ้า (2540-2560)"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center">20</td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center"><?=number_format(8)?></td>
        <td style="font-size: 12px;text-align: center"><?=number_format(160)?></td>
    </tr>
    <tr>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center;padding: 5px 5px 5px 5px;"><?="4"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: left;padding-left: 10px;"><?="ค่าจอดรถ"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center">300</td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center"><?=number_format(1)?></td>
        <td style="font-size: 12px;text-align: center"><?=number_format(300)?></td>
    </tr>
    <tr>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center;padding: 5px 5px 5px 5px;"><?="5"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: left;padding-left: 10px;"><?="ค่าปรับล่าช้า"?></td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center">100</td>
        <td style="border-right: 1px solid gray;font-size: 12px;text-align: center"><?=number_format(1)?></td>
        <td style="font-size: 12px;text-align: center"><?=number_format(100)?></td>
    </tr>
    <?php if(count($modelline)>0):?>

        <?php foreach($modelline as $value):?>
            <tr>
                <td style="border: none;font-size: 12px;text-align: center"><?=""?></td>
                <td style="border: none;font-size: 12px;text-align: center"><?=number_format(0,0)?></td>
                <td style="border: none;font-size: 12px;text-align: center">Pcs</td>
                <td style="border: none;font-size: 12px;text-align: center"><?=number_format(0)?></td>
                <td style="border: none;font-size: 12px;text-align: center"><?=number_format(0)?></td>
            </tr>
        <?php endforeach;?>

    <?php endif;?>
    <tr>
        <td colspan="3" style="text-align: center;font-size: 14px; border-top: 1px solid gray;border-right: 1px solid gray;padding: 10px 10px 10px 10px" class="money-text">สองพันแปดร้อยสิบบาทถ้วน</td>
        <td colspan="1" style="text-align: right;font-size: 14px; border-top: 1px solid gray;border-right: 1px solid gray;padding: 10px 10px 10px 10px">รวมสุทธิ</td>
        <td style="border: none;font-size: 12px;font-weight: bold;text-align: center; border-top: 1px solid gray">2,810</td>
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
<?php endfor;?>

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
