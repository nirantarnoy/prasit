<?php

namespace backend\controllers;

use Yii;
use backend\models\Trans;
use backend\models\TransSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
/**
 * TransController implements the CRUD actions for Trans model.
 */
class TransController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST','GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Trans models.
     * @return mixed
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new TransSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Trans model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modelline = \backend\models\Transline::find()->where(['trans_id'=>$id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelline' => $modelline,
        ]);
    }

    /**
     * Creates a new Trans model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Trans();

        if ($model->load(Yii::$app->request->post())) {

            $room_id = Yii::$app->request->post('room_id');
            $new_water = Yii::$app->request->post('water_new');
            $new_elect = Yii::$app->request->post('elect_new');
            $parking = Yii::$app->request->post('is_parking');
            $fine = Yii::$app->request->post('is_fine');
            $money_text = Yii::$app->request->post('money_text');
            $none_pay = Yii::$app->request->post('none_pay');


//                    if(!empty($fine)) {
//                       // echo count($fine);return;
//                    }
//                    echo print_r($fine);return;
        //return;
            $model->status = 1;
            $model->trans_date = date('Y-m-d',strtotime($model->trans_date));
            if($model->save()){
                if(count($room_id)>0){
                    for($i=0;$i<=count($room_id)-1;$i++){
                        if($room_id[$i]){

                            $room_rate = 0;
                            $last_w = 0;
                            $last_e = 0;
                            $park_rate = 0;
                            $fine_rate = 0;
                            $w_unit_per = 0;
                            $e_unit_per = 0;

                            $room_data = \backend\models\Room::findInfo($room_id[$i]);
                            $building_data = \backend\models\Building::findInfo($room_id[$i]);

                            if($room_data){
                                $room_rate = $room_data->room_rate;
                                $last_w = $room_data->water_meter_last;
                                $last_e = $room_data->elect_meter_last;
                                $e_unit_per = $room_data->elect_per_unit;
                                $w_unit_per = $room_data->water_per_unit;
                            }

                            if($building_data){
                                if($parking[$i] == 1){
                                    $park_rate = $building_data->parking_rate;
                                }
                                if($fine[$i] == 1){
                                    $fine_rate = $building_data->fee_rate;
                                }

                            }

                            $modelline = new \backend\models\Transline();
                            $modelline->trans_id = $model->id;
                            $modelline->room_id = $room_id[$i];
                            $modelline->price = $room_rate;
                            $modelline->water_before = $last_w;
                            $modelline->water_after = $new_water[$i];
                            $modelline->water_unit = $new_water[$i] - $last_w;
                            $modelline->water_price = ($new_water[$i] - $last_w) * $w_unit_per;
                            $modelline->elect_before = $last_e;
                            $modelline->elect_after = $new_elect[$i];
                            $modelline->elect_unit = $new_elect[$i] - $last_e;
                            $modelline->elect_price = ($new_elect[$i] - $last_e) * $e_unit_per;
                            $modelline->is_parking = $parking[$i];
                            $modelline->parking_amt = $park_rate;
                            $modelline->is_fine = $fine[$i];
                            $modelline->fine_amt = $fine_rate;
                            $modelline->total_amt = ($modelline->price + $modelline->water_price + $modelline->elect_price + $modelline->parking_amt + $modelline->fine_amt);
                            $modelline->status = 1;
                            $modelline->total_text = $money_text[$i];
                            $modelline->none_pay_amt = $none_pay[$i];
                            $modelline->save(false);
                        }

                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'runno' => $model::getLastNo(),
        ]);
    }

    /**
     * Updates an existing Trans model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $modelline = \backend\models\Transline::find()->where(['trans_id'=>$id])->all();

        if ($model->load(Yii::$app->request->post())) {
            $room_id = Yii::$app->request->post('room_id');
            $new_water = Yii::$app->request->post('water_new');
            $new_elect = Yii::$app->request->post('elect_new');
            $parking = Yii::$app->request->post('is_parking');
            $fine = Yii::$app->request->post('is_fine');
            $money_text = Yii::$app->request->post('money_text');
            $none_pay = Yii::$app->request->post('none_pay');

            $model->trans_date = date('Y-m-d',strtotime($model->trans_date));
            if($model->save()){
                if(count($room_id)>0){
                    for($i=0;$i<=count($room_id)-1;$i++){
                        if($room_id[$i]){

                            $room_rate = 0;
                            $last_w = 0;
                            $last_e = 0;
                            $park_rate = 0;
                            $fine_rate = 0;
                            $w_unit_per = 0;
                            $e_unit_per = 0;

                            $room_data = \backend\models\Room::findInfo($room_id[$i]);
                            $building_data = \backend\models\Building::findInfo($room_id[$i]);

                            if($room_data){
                                $room_rate = $room_data->room_rate;
                                $last_w = $room_data->water_meter_last;
                                $last_e = $room_data->elect_meter_last;
                                $e_unit_per = $room_data->elect_per_unit;
                                $w_unit_per = $room_data->water_per_unit;
                            }

                            if($building_data){
                                if($parking[$i] == 1){
                                    $park_rate = $building_data->parking_rate;
                                }
                                if($fine[$i] == 1){
                                    $fine_rate = $building_data->fee_rate;
                                }

                            }
                            $modelline = \backend\models\Transline::find()->where(['room_id'=>$room_id[$i]])->one();
                            $modelline->trans_id = $model->id;
                            $modelline->room_id = $room_id[$i];
                            $modelline->price = $room_rate;
                            $modelline->water_before = $last_w;
                            $modelline->water_after = $new_water[$i];
                            $modelline->water_unit = $new_water[$i] - $last_w;
                            $modelline->water_price = ($new_water[$i] - $last_w) * $w_unit_per;
                            $modelline->elect_before = $last_e;
                            $modelline->elect_after = $new_elect[$i];
                            $modelline->elect_unit = $new_elect[$i] - $last_e;
                            $modelline->elect_price = ($new_elect[$i] - $last_e) * $e_unit_per;
                            $modelline->is_parking = $parking[$i];
                            $modelline->parking_amt = $park_rate;
                            $modelline->is_fine = $fine[$i];
                            $modelline->fine_amt = $fine_rate;
                            $modelline->total_amt = ($modelline->price + $modelline->water_price + $modelline->elect_price + $modelline->parking_amt + $modelline->fine_amt);
                            $modelline->status = 1;
                            $modelline->total_text = $money_text[$i];
                            $modelline->none_pay_amt = $none_pay[$i];
                            $modelline->save(false);

//                            $modelline = new \backend\models\Transline();
//                            $modelline->trans_id = $model->id;
//                            $modelline->room_id = $room_id[$i];
//                            $modelline->price = $room_rate;
//                            $modelline->water_before = $last_w;
//                            $modelline->water_after = $new_water[$i];
//                            $modelline->water_unit = $new_water[$i] - $last_w;
//                            $modelline->water_price = ($new_water[$i] - $last_w) * $w_unit_per;
//                            $modelline->elect_before = $last_e;
//                            $modelline->elect_after = $new_elect[$i];
//                            $modelline->elect_unit = $new_elect[$i] - $last_e;
//                            $modelline->elect_price = ($new_elect[$i] - $last_e) * $e_unit_per;
//                            $modelline->is_parking = $parking[$i];
//                            $modelline->parking_amt = $park_rate;
//                            $modelline->is_fine = $fine[$i];
//                            $modelline->fine_amt = $fine_rate;
//                            $modelline->total_amt = ($modelline->price + $modelline->water_price + $modelline->elect_price + $modelline->parking_amt + $modelline->fine_amt);
//                            $modelline->status = 1;
//                            $modelline->total_text = $money_text[$i];
//                            $modelline->none_pay_amt = $none_pay[$i];
//                            $modelline->save(false);
                        }

                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelline' => $modelline
        ]);
    }

    /**
     * Deletes an existing Trans model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Trans model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Trans the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Trans::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPrintslip(){

         $list = Yii::$app->request->post("row_selected");
        if(count($list)){
           // return $list;
            $ids = explode(',',$list);
            //$modeltrans = \common\models\Trans::find()->where(['id'=>$id])->one();
          //  $modeltrans = \common\models\Trans::find()->where(['id'=>$id])->one();
            $plant_mobile = \backend\models\Plant::find(['mobile'])->one();
            $modelline = \backend\models\Transline::find()->where(['id'=>$ids])->all();
            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                //  'format' => [150,236], //manaul
                'format' => Pdf::FORMAT_A4,
                'orientation' => Pdf::ORIENT_PORTRAIT,
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_multibill',
                    [
                  //      'model'=>$modeltrans,
                        'modelline'=> $modelline,
                        'plant_mobile' => $plant_mobile,
                    ]),
                //'content' => "nira",
                'cssFile' => '@backend/web/css/pdf.css',
                //'jsFile'=>'@backend/web/js',
                'defaultFont' => 'Cloud-Light',
                'options' => [
                    'title' => 'หนังสือยินยอม',
                    'subject' => ''
                ],
                'methods' => [
                    //  'SetHeader' => ['รายงานรหัสสินค้า||Generated On: ' . date("r")],
                    //  'SetFooter' => ['|Page {PAGENO}|'],
                    //'SetFooter'=>'niran',
                ],

            ]);
            return $pdf->render();
        }

    }

    public function actionFindroom(){
        if(Yii::$app->request->isAjax){
           // return "ok";
            $id = Yii::$app->request->post('id');
            if($id){
                $model = \backend\models\Room::find()->where(['building_id'=>$id])->all();
                if($model){

                    $html = "";
                    $i = 0;
                    foreach ($model as $value){
                        $building_data = \backend\models\Building::findInfo($value->id);
                        $i++;
                        $html .= '
                               <tr>
                                   <input type="hidden" class="water_per_unit" value="'.$value->water_per_unit.'">
                                   <input type="hidden" class="elect_per_unit" value="'.$value->elect_per_unit.'">
                                    <input type="hidden" class="parking_rate" value="'.$building_data->parking_rate.'">
                                   <input type="hidden" class="fine_rate" value="'.$building_data->fee_rate.'">
                                <td style="vertical-align: middle">'.$i.'</td>
                                <td style="vertical-align: middle;text-align: center">
                                    '.$value->room_no.'
                                    <input type="hidden" name="room_id[]" value="'.$value->id.'">
                                </td>
                                <td style="vertical-align: middle;text-align: right" class="room_rate">'.number_format($value->room_rate).'</td>
                                <td style="vertical-align: middle;text-align: right" class="none_pay">'.number_format(\backend\models\Roomnonepay::findNonepay($value->id)).'</td>
                                <td style="vertical-align: middle;text-align: right" class="last_water_line">'.$value->water_meter_last.'</td>
                                <td style="vertical-align: middle"><input type="text" class="form-control water_new_line" style="width: 80px;" value="0" name="water_new[]" onkeypress="checknum($(this))" onchange="cal_line($(this))"></td>
                                <td style="vertical-align: middle;text-align: right" class="water_unit">0</td>
                                <td style="background-color: #17a2b8;vertical-align: middle;text-align: right" class="water_price">0</td>
                                <td style="vertical-align: middle;text-align: right" class="last_elect_line">'.$value->elect_meter_last.'</td>
                                <td style="vertical-align: middle;text-align: right"><input type="text" class="form-control elect_new_line" style="width: 80px;" value="0" name="elect_new[]" onkeypress="checknum($(this))" onchange="cal_line($(this))"></td>
                                <td style="vertical-align: middle;text-align: right" class="elect_unit">0</td>
                                <td style="background-color: #bf800c;vertical-align: middle;text-align: right" class="elect_price">0</td>
                                <td style="vertical-align: middle;text-align: center">
                                     <input type="hidden" class="is_parking" name="is_parking[]" value="0">
                                    <input type="checkbox" class="form-check-input" id="c_parking-'.$i.'" name="parking[]" value="Yes" onchange="checkSelect($(this))">
                                </td>
                                <td style="vertical-align: middle;text-align: center">
                                <input type="hidden" class="is_fine" name="is_fine[]" value="0">
                                    <input type="checkbox" class="form-check-input" id="c_fine-'.$i.'" name="fine[]" onchange="checkSelect2($(this))">
                                </td>
                                <td class="row_amt" style="background-color: #17a2b8;font-weight: bold;text-align: right;vertical-align: middle">
                                   0
                                </td>
                                 <input type="hidden" class="line_total" name="line_total[]" value="0">
                                 <input type="hidden" class="money_text" name="money_text[]" value="">
                                 <input type="hidden" name="none_pay[]" value="'.number_format(\backend\models\Roomnonepay::findNonepay($value->id)).'">
                            </tr>
                         ';
                    }


                    return $html;
                }
            }
        }
    }


    public function actionRecordnonepay(){
        $list = Yii::$app->request->post("row_selected");
        $cur_trans_id = Yii::$app->request->post("cur_trans_id");
        if($list){
            $ids = explode(',',$list);
            if(count($ids)){
                for($i=0;$i<=count($ids)-1;$i++){
                    $transline = \backend\models\Transline::find()->where(['id'=>$ids[$i]])->one();
                    if($transline){
                        \backend\models\Roomnonepay::deleteAll(['trans_line_id'=>$transline->id]);
                        $model = new \backend\models\Roomnonepay();
                        $model->trans_id = $transline->trans_id;
                        $model->trans_line_id = $transline->id;
                        $model->room_id = $transline->room_id;
                        $model->total_amt = $transline->total_amt;
                        $model->status = 1;
                       if($model->save(false)){
                           $room = \backend\models\Room::find()->where(['id'=>$transline->room_id])->one();
                           $room->pay_status = 2;
                           $room->save();

                           $transline->status = 3;
                           $transline->save(false);

                           $this->redirect(['trans/update','id'=>$cur_trans_id]);
                       }
                    }

                }
            }
        }
    }
    public function actionRecordcomplete(){
        $list = Yii::$app->request->post("row_selected");
        $cur_trans_id = Yii::$app->request->post("cur_trans_id");
        if($list){
            $ids = explode(',',$list);
            if(count($ids)){
                for($i=0;$i<=count($ids)-1;$i++){
                    $transline = \backend\models\Transline::find()->where(['id'=>$ids[$i]])->one();
                    if($transline){
                       $transline->status = 2;
                       $transline->save(false);
                    }
                }
                $modeltrans = \backend\models\Trans::find()->where(['id'=>$cur_trans_id])->one();
                if($modeltrans){
                    $modeltrans->status = 3; //completed
                    if($modeltrans->save(false)){
                      $this->redirect(['trans/index']);
                    }
                }
            }
        }
    }

}
