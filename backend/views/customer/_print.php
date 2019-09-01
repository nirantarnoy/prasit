<?php
?>

<div style="text-align: center;margin-top: -30px"> <h2>ประวัติการเข้ารับการรักษา</h2></div>
<table class="table">
    <tr>
        <td>รหัส:</td>
        <td><b><?=\backend\models\Customer::findCode($model_cust->id)?></b></td>
    </tr>
    <tr>
        <td>ชื่อ-นามสกุล:</td>
        <td><b><?=\backend\models\Customer::findFullname($model_cust->id)?></b></td>
    </tr>
</table><br>
<table class="table" width="100%"  cellspacing="0">
    <thead>
        <tr>
            <th style="padding: 5px 0px 5px 0px;text-align: center;border: 1px solid gray">#</th>
            <th style="padding: 5px 0px 5px 0px;text-align: center;border: 1px solid gray">วันที่</th>
            <th style="padding: 5px 0px 5px 5px;text-align: left;border: 1px solid gray">คอร์ส</th>
            <th style="padding: 5px 0px 5px 5px;text-align: left;border: 1px solid gray">คุณหมอ</th>
            <th style="padding: 5px 0px 5px 5px;text-align: left;border: 1px solid gray">หมายเหตุ</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=0;?>
       <?php foreach ($model as $value):?>
           <?php $i+=1;?>
       <tr>
           <td style="padding: 5px 0px 5px 0px;text-align: center;border: 1px solid gray"><?=$i?></td>
           <td style="padding: 5px 0px 5px 0px;text-align: center;border: 1px solid gray"><?=$value->treat_date?></td>
           <td style="padding: 5px 0px 5px 0px;text-align: left;border: 1px solid gray"></td>
           <td style="padding: 5px 0px 5px 5px;text-align: left;border: 1px solid gray"><?=\backend\models\Doctor::findName($value->doctor_id)?></td>
           <td style="padding: 5px 0px 5px 5px;text-align: left;border: 1px solid gray"></td>
       </tr>
    <?php endforeach;?>
    </tbody>
</table>
