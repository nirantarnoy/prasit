<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'ประสิทธิ์ห้องเช่า',// Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default text-white navbar-fixed-top',
            'style' =>'color: #FFFFFF'
        ],
    ]);
    $menuItems = [
        ['label' => 'ภาพรวม', 'url' => ['/site/index']],
        ['label' => 'ข้อมูลหอพัก', 'url' => ['/plant/index']],
        ['label' => 'ข้อมูลตึก', 'url' => ['/building/index']],
        ['label' => 'ข้อมูลห้อง', 'url' => ['/room/index']],
        ['label' => 'ข้อมูลลูกค้า', 'url' => ['/customer/index']],
        ['label' => 'บันทึกค่าเช่า', 'url' => ['/trans/index']],
       // ['label' => 'รายงาน', 'url' => ['/report/index']],
        //['label' => 'แจ้งเตือน', 'url' => ['/message/index']],

    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label'=>'<span class="glyphicon glyphicon-user"></span>'.' '.Yii::$app->user->identity->username,'items'=>[
              ['label'=>'<span class="glyphicon glyphicon-chevron-right text-success"></span>'.' '.'เปลียนรหัสผ่าน','url'=>['site/changepassword']],
              ['label'=>'<span class="glyphicon glyphicon-log-out text-warning"></span>'.' '.'ออกจากระบบ','url'=>['site/logout'],'linkOptions' => ['data-method' => 'post']
        ]]];
//        $menuItems[] = '<li>'
//            . Html::beginForm(['/site/logout'], 'post')
//            . Html::submitButton(
//                'Logout (' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link logout']
//            )
//            . Html::endForm()
//            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= 'ประสิทธิ์ห้องเช่า'?> <?= date('Y') ?></p>

        <p class="pull-right"><?php //echo  Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
