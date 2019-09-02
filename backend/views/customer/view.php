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

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="panel">
    <div class="panel-heading">
        <h3> <i class="fa fa-edit"></i> รายละเอียดลูกค้า</h3>
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
        <table class="table table-bordered">
           <thead>
           <tr>
               <th style="width: 5%">#</th>
               <th>วัน/เวลา</th>
               <th>มิเตอร์น้ำก่อน</th>
               <th>มิเตอร์น้ำหลัง</th>
               <th>ไฟฟ้าก่อน</th>
               <th>ไฟฟ้าหลัง</th>
               <th>ค่าห้อง</th>
               <th>ค่าน้ำ</th>
               <th>ค่าไฟ</th>
               <th>รวม</th>
           </tr>
           </thead>
            <tbody>

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
