<?php
?>
<h4>รายการค้างชำระ</h4>
<div class="row">
    <div class="col-lg-12">
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
</div>
