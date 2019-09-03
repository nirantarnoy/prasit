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
     <div class="row">
         <div class="col-lg-6">
             <h1>ห้องเช่าเลขที่ <?= Html::encode($this->title) ?></h1>
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




    <?php //echo DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//         //   'id',
//            'room_no',
//            [
//                'attribute' => 'building_id',
//                'value' => function($data){
//                    return \backend\models\Building::findName($data->building_id);
//                }
//            ],
//            'floor',
//          //  'customer_id',
//            'room_rate',
//            'rent_type',
//            'water_meter_last',
//            'elect_meter_last',
//            'water_per_unit',
//            'elect_per_unit',
//            'last_pay_date',
//            'photo',
////            'status',
////            'created_at',
////            'updated_at',
////            'created_by',
////            'updated_by',
//        ],
//    ]) ?>

    <div class="row">
        <div class="col-lg-3">
            <div class="photo-container" style="text-align: center">

                <?php if($model->photo !=''):?>
                    <?php echo Html::img('@web/uploads/photo/'.$model->photo,['class'=>'img-profile','style'=>'width: 100%;position:relative']);?>
                <?php else:?>
                    <div><i class="fa fa-image"></i></div>
                <?php endif;?>
                <!--                <div id="kv_load" style="display:noxne" ></div>-->
                <!--                <div style="background:url('images/markondiagram.PNG') no-repeat ; width:700px; height:759;border:2px solid #999;"  id="kv_mark">   </div>-->
            </div>
        </div>
        <div class="col-lg-3">
            <table class="table">
                <tr>
                    <td style="font-weight: bold">เลขห้อง</td>
                    <td><?=$model->room_no?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">ตึก</td>
                    <td><?=\backend\models\Building::findInfo($model->building_id)->name?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">อยู่ชั้นที่</td>
                    <td><?=$model->floor?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">ค่าเช่า</td>
                    <td><?=number_format($model->room_rate)?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">ค่าน้ำต่อหน่วย</td>
                    <td><?=number_format($model->water_per_unit)?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">ค่าไฟฟ้าต่อหน่ว่ย</td>
                    <td><?=number_format($model->elect_per_unit)?></td>
                </tr>
            </table>
        </div>
        <div class="col-lg-3">
            <table class="table">
                <tr>
                    <td style="font-weight: bold">มิเตอร์น้ำ</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">มิเตอร์ไฟฟ้า</td>
                    <td style="font-weight: bold"></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">ชำระล่าสุด</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">สถานะ</td>
                    <td>
                        <?php if($model->status == 1): ?>
                            <div class="label label-success">Active</div>
                        <?php else:?>
                            <div class="label label-danger">Not Active</div>
                        <?php endif;?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-lg-3">
            <table class="table">
                <!--                <tr>-->
                <!--                    <td style="font-weight: bold">ห้องพักเลขที่</td>-->
                <!--                    <td style="font-weight: bold"></td>-->
                <!--                </tr>-->

            </table>
        </div>
    </div>

    <h4>รายการค้างชำระ</h4>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-striped table-list">
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
