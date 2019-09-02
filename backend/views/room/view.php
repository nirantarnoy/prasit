<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Room */

$this->title = $model->room_no;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลห้อง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="room-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'id',
            'room_no',
            [
                'attribute' => 'building_id',
                'value' => function($data){
                    return \backend\models\Building::findName($data->building_id);
                }
            ],
            'floor',
          //  'customer_id',
            'room_rate',
            'rent_type',
            'water_meter_last',
            'elect_meter_last',
            'water_per_unit',
            'elect_per_unit',
            'last_pay_date',
            'photo',
//            'status',
//            'created_at',
//            'updated_at',
//            'created_by',
//            'updated_by',
        ],
    ]) ?>
    <h4>รายการค้างชำระ</h4>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-list">
                <thead>
                <tr >
                    <th style="text-align: center">#</th>
                    <th style="text-align: center;vertical-align: middle">ห้อง</th>
                    <th style="text-align: right;vertical-align: middle">ค่าห้อง</th>
                    <th style="text-align: right;vertical-align: middle">ค่าน้ำ</th>
                    <th style="text-align: right;vertical-align: middle">ค่าไฟ</th>
                    <th style="text-align: right;vertical-align: middle">ค่าปรับล่าช้า</th>
                    <th style="text-align: right;vertical-align: middle">ค่าจอดรถ</th>
                    <th style="text-align: right;vertical-align: middle">รวม</th>
                    <th style="text-align: center;vertical-align: middle">สถานะ</th>
                    <th style="text-align: center;vertical-align: middle">อ้างอิง</th>
                    <th style="text-align: right;vertical-align: middle">-</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0;?>
                <?php foreach ($modelline as $value):?>
                    <?php $i++;?>
                    <tr>
                        <td style="text-align: center;vertical-align: middle"><?=$i?>
                            <input type="hidden" value="<?=$value->id?>" name="row_id" class="row_id">
                            <input type="hidden" value="<?=$value->id?>" name="row_selected" class="row_selected">
                        </td>
                        <td style="text-align: center;vertical-align: middle">
                            <?=\backend\models\Room::findInfo($value->room_id)->room_no?>
                        </td>
                        <td style="text-align: right;vertical-align: middle"><?=number_format($value->price)?></td>
                        <td style="text-align: right;vertical-align: middle"><?=number_format($value->water_price)?></td>
                        <td style="text-align: right;vertical-align: middle"><?=number_format($value->elect_price)?></td>
                        <td style="text-align: right;vertical-align: middle"><?=number_format($value->fine_amt)?></td>
                        <td style="text-align: right;vertical-align: middle"><?=number_format($value->parking_amt)?></td>
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
                        <td style="text-align: center;vertical-align: middle">
                          <?=\backend\models\Trans::findInfo($value->trans_id)->trans_no?>
                        </td>
                        <td>

                                <div class="btn btn-default btn-print"> พิมพ์</div>
                                <div class="btn btn-info btn-complete"> ชำระค่าเช่า</div>

                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<form action="index.php?r=room/printslip" method="post" target="_blank" id="form-print">
    <input type="hidden" name="row_id" value="" class="print_id">
</form>
<form action="index.php?r=room/makepay" method="post" id="form-pay">
    <input type="hidden" name="pay_id" value="" class="pay_id">
</form>
<?php
$url_to_print = Url::to(['room/printslip'],true);
$js=<<<JS
 $(function() {
    $(".btn-print").click(function() {
       var id = $(this).closest('tr').find('.row_id').val();
       $(".print_id").val(id);
       $("#form-print").submit();
    })
    $(".btn-complete").click(function() {
       var id = $(this).closest('tr').find('.row_id').val();
       $(".pay_id").val(id);
       $("#form-pay").submit();
    })
 })
JS;
$this->registerJs($js,static::POS_END);
?>
