<?php
use yii\helpers\Html;
$this->registerJsFile( '@web/js/ThaiBath-master/thaibath.js',
    ['depends' => [\yii\web\JqueryAsset::className()]],
    static::POS_HEAD
);


?>
<table width="100%">
    <tr>
        <td width="100%">ประสิทธิ์ห้องเช่า</td>
    </tr>
</table>
<table width="100%">
    <tr>
        <td width="70%" style="border: 1px solid gray;border-radius: 25px;padding: 10px;">
            <h3><?=""?></h3><br>
            <h4>เลขประจำตัวผู้เสียภาษี : <?=""?></h4><br>
            <h4>ที่อยู่ : <?=""?></h4><br>
        </td>
        <td width="30%">
            <table class="">
                <tr>
                    <td>
                        <h2>ใบเสร็จ/ใบกำกับภาษี</h2>
                    </td>
                </tr>
            </table>
            <table class="po-vendor" style="width: 100%">
                <tr>
                    <td>
                        <h4>เลขที่ </h4>
                    </td>
                    <td>
                        <h4></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>วันที่ <?=""?></h4>
                    </td>
                    <td>
                        <h4></h4>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="70%" style="border: 1px solid gray;border-radius: 25px;padding: 10px;">
            <h3>ชื่อ : <?=""?></h3><br>
            <h4>ที่อยู่ : <?=""?></h4><br>
            <h4>โทร : <?=""?></h4><br>
        </td>
        <td width="30%" style="border: 1px solid gray;border-radius: 25px;padding: 10px;">
            <h3>เลขที่ : <?=date('d/m/Y')?></h3><br>
            <h3>วันที่ : <?=date('d/m/Y')?></h3><br>
            <h4>ห้อง : </h4><br>
        </td>
    </tr>
</table>




<table class="" width="100%" style="border: 1px solid gray">
    <tbody>
                <tr style="background: #c3c3c3">
                    <td style="border: none;font-size: 12px;font-weight: bold;text-align: center">ลำดับ</td>
                    <td style="border: none;font-size: 12px;font-weight: bold;text-align: center">รายการ</td>
                    <td style="border: none;font-size: 12px;font-weight: bold;text-align: center">จำนวนหน่อย</td>
                    <td style="border: none;font-size: 12px;font-weight: bold;text-align: center">ราคา/หน่วย</td>
                    <td style="border: none;font-size: 12px;font-weight: bold;text-align: center">จำนวนเงิน</td>
                </tr>
                <?php if(count($modelline)>0):?>

                    <?php foreach($modelline as $value):?>
                        <tr>
                            <td style="border: none;font-size: 12px;text-align: center"><?=""?></td>
                            <td style="border: none;font-size: 12px;text-align: center"><?=""?></td>
                            <td style="border: none;font-size: 12px;text-align: center"><?=number_format(0,0)?></td>
                            <td style="border: none;font-size: 12px;text-align: center">Pcs</td>
                            <td style="border: none;font-size: 12px;text-align: center"><?=number_format(0)?></td>
                            <td style="border: none;font-size: 12px;text-align: center"><?=number_format(0)?></td>
                        </tr>
                    <?php endforeach;?>

                <?php endif;?>
    </tbody>

</table>
<table width="100%" style="border: 1px solid gray">
    <tbody>
    <tr style="background: #fff;">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>จำนวนเงินชำระสุทธิ</td>
        <td><?=number_format(0,0);?></td>
    </tr>
    </tbody>
</table>

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
