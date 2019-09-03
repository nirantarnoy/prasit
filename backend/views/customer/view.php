<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'รหัสลูกค้า'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$css=<<<CSS

.img-profile img {
    position: absolute;   
}
CSS;
$this->registerCss($css);
$url_to_print = Url::to(['customer/printhistory','id'=>$model->id],true);
?>
<div class="customer-view">

    <div class="row">
        <div class="col-lg-6">
            <h1>รายละเอียดลูกค้า <?= Html::encode($this->title) ?></h1>
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
<div class="panel">
    <div class="panel-heading">
<!--        <h3> <i class="fa fa-edit"></i> รายละเอียดลูกค้า</h3>-->
    </div>
<div class="panel-body">
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
                    <td style="font-weight: bold">รหัส</td>
                    <td><?=$model->code?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">ชื่อ-นามสกุล</td>
                    <td><?=$model->first_name. " ". $model->last_name?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">เพศ</td>
                    <td><?=\backend\helpers\GenderType::getTypeById($model->sex)?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">เบอร์ติดต่อ</td>
                    <td><?=$model->phone?></td>
                </tr>
            </table>
        </div>
        <div class="col-lg-3">
            <table class="table">
                <tr>
                    <td style="font-weight: bold">เลขที่บัตรประชาชน</td>
                    <td><?=$model->card_id?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">ห้องพักเลขที่</td>
                    <td style="font-weight: bold"></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">เข้าอยู่เมื่อ</td>
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
</div>
</div>
<div class="panel">
    <div class="panel-heading">
        <div class="pull-left">
            <h3><i class="fa fa-list-alt"></i> ประวัติการชำระค่าเช่า</h3>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped">
           <thead>
           <tr>
               <th style="width: 5%">#</th>
               <th style="text-align: center">วันที่</th>
               <th style="text-align: center">อ้างอิง</th>
               <th style="text-align: center">เลขที่ห้อง</th>
               <th style="text-align: right">ค่าห้อง</th>
               <th style="text-align: right">ค่าน้ำ</th>
               <th style="text-align: right">ค่าไฟ</th>
               <th style="text-align: right">ค่าจอดรถ</th>
               <th style="text-align: right">ค่าปรับล่าช้า</th>
               <th style="text-align: right">รวม</th>
               <th style="text-align: center">สถานะ</th>
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
                        <?=date('d-m-Y', $value->updated_at)?>
                    </td>
                    <td style="text-align: center;vertical-align: middle">
                        <?=\backend\models\Trans::findInfo($value->trans_id)->trans_no?>
                    </td>
                    <td style="text-align: center;vertical-align: middle">
                        <?=\backend\models\Room::findInfo($value->room_id)->room_no?>
                    </td>
                    <td style="text-align: right;vertical-align: middle"><?=number_format($value->price)?></td>
                    <td style="text-align: right;vertical-align: middle"><?=number_format($value->water_price)?></td>
                    <td style="text-align: right;vertical-align: middle"><?=number_format($value->elect_price)?></td>
                    <td style="text-align: right;vertical-align: middle"><?=number_format($value->parking_amt)?></td>
                    <td style="text-align: right;vertical-align: middle"><?=number_format($value->fine_amt)?></td>
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
</div>
<form action="<?=$url_to_print?>" id="form-print" method="post" target="_blank"></form>
<?php

$js =<<<JS
   $(function() {
       $(".btn-print").click(function() {
         $("form#form-print").submit();
       });
       $("#kv_mark").click(function(e) {
           alert("");
           var  x = (e.pageX - this.offsetLeft)-290;
	       var y = (e.pageY - this.offsetTop)-320;	  
           alert(x);
	       $("#kv_mark").append('<img class="mark" src="http://localhost/wedas/backend/web/uploads/photo/dot2.png" id="'+x+'_'+y+'" style="position:absolute;left:'+x+'px; top:'+y+'px; z-index:2;">');
		//i++;	
         // var pos = $(this).offset();
       //  var x = e.pageX - this.offsetLeft;
       //  var y = e.pageY - this.offsetTop;
       //  var img = $('<img>');
       //  img.css('top', y);
       //  img.css('left', x);
       // // img.css('z-index',19000);
       //  img.attr('src', 'http://localhost/wedas/backend/web/uploads/photo/dot2.png');
       //  img.appendTo('.img-profile');
       });
   });
JS;
$this->registerJs($js);
?>
