<?php

/* @var $this yii\web\View */

$this->title = 'ประสิทธิ์ห้องเช่า';

$css='
.card {
  /* Add shadows to create the "card" effect */
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

/* Add some padding inside the card container */
.containerx {
  padding: 2px 16px;
  text-align: center;
}
.data{
  font-size: 48px;
  font-weight: bold;
  text-align: center;
  padding-top: 25px;s
 }
';
$this->registerCss($css);
?>
<div class="site-index">
    <br>
    <div class="containerx">
        <h2>ภาพรวม</h2>
    </div>

    <hr>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="data" style="color: #0c5460">5</div>
                <div class="containerx">
                    <h4><b><i class="glyphicon glyphicon-home text-success"></i> จำนวนตึก</b></h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="data" style="color: #0c5460">150</div>
                <div class="containerx">
                    <h4><b><i class="glyphicon glyphicon-tags text-info"></i> จำนวนห้องเช่า</b></h4>
<!--                    <p>Architect & Engineer</p>-->
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="data" style="color: #0c5460">150</div>
                <div class="containerx">
                    <h4><b><i class="glyphicon glyphicon-user text-warning"></i> จำนวนผู้เช่า</b></h4>
<!--                    <p>Architect & Engineer</p>-->
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="data" style="color: #0c5460">6</div>
                <div class="containerx">
                    <h4><b><i class="glyphicon glyphicon-comment text-danger"></i> ค้างชำระ(ห้อง)</b></h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="data" style="color: #0c5460">15,000</div>
                <div class="containerx">
                    <h4><b><i class="glyphicon glyphicon-usd text-success"></i> ค้างชำระ(จำนวนเงิน)</b></h4>
                    <!--                    <p>Architect & Engineer</p>-->
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="data" style="color: #0c5460">16</div>
                <div class="containerx">
                    <h4><b><i class="glyphicon glyphicon-star-empty text-success"></i> จำนวนห้องว่าง</b></h4>
                    <!--                    <p>Architect & Engineer</p>-->
                </div>
            </div>
        </div>
    </div>

</div>
