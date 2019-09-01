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
        return $this->render('view', [
            'model' => $this->findModel($id),
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
            $model->status = 1;
            $model->trans_date = date('Y-m-d',strtotime($model->trans_date));
            if($model->save()){
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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

    public function actionPrintslip($id){

        //  $id = Yii::$app->request->post("id");
        if($id){
            $modeltrans = \common\models\Trans::find()->where(['id'=>$id])->one();
            $modelline = \backend\models\Transline::find()->where(['trans_id'=>$id])->all();
            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                //  'format' => [150,236], //manaul
                'format' => Pdf::FORMAT_A4,
                'orientation' => Pdf::ORIENT_PORTRAIT,
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_bill',
                    [
                        'model'=>$modeltrans,
                        'modelline'=> $modelline,
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
                        $i++;
                        $html .= '
                               <tr>
                                   <input type="hidden" class="water_per_unit" value="'.$value->water_per_unit.'">
                                   <input type="hidden" class="elect_per_unit" value="'.$value->elect_per_unit.'">
                                <td style="vertical-align: middle">'.$i.'</td>
                                <td style="vertical-align: middle">
                                    '.$value->room_no.'
                                    <input type="hidden" name="room_id[]" value="'.$value->id.'">
                                </td>
                                <td style="vertical-align: middle;text-align: right" class="room_rate">'.number_format($value->room_rate).'</td>
                                <td style="vertical-align: middle;text-align: right" class="last_water_line">'.$value->water_meter_last.'</td>
                                <td style="vertical-align: middle"><input type="text" class="form-control water_new_line" style="width: 80px;" name="water_new[]" onkeypress="checknum($(this))" onchange="cal_line($(this))"></td>
                                <td style="vertical-align: middle;text-align: right" class="water_unit">0</td>
                                <td style="background-color: #17a2b8;vertical-align: middle;text-align: right" class="water_price">0</td>
                                <td style="vertical-align: middle;text-align: right" class="last_elect_line">'.$value->elect_meter_last.'</td>
                                <td style="vertical-align: middle;text-align: right"><input type="text" class="form-control elect_new_line" style="width: 80px;" name="elect_ner[]" onkeypress="checknum($(this))" onchange="cal_line($(this))"></td>
                                <td style="vertical-align: middle;text-align: right" class="elect_unit">0</td>
                                <td style="background-color: #bf800c;vertical-align: middle;text-align: right" class="elect_price">0</td>
                                <td style="vertical-align: middle;text-align: center">
                                    <input type="checkbox" class="form-check-input" name="parking[]" onchange="checkSelect($(this))">
                                </td>
                                <td style="vertical-align: middle;text-align: center">
                                    <input type="checkbox" class="form-check-input" name="fee[]" onchange="checkSelect($(this))">
                                </td>
                                <td class="row_amt" style="background-color: #17a2b8;font-weight: bold;text-align: right;vertical-align: middle">
                                   0
                                </td>
                                 <input type="hidden" class="line_total" name="line_total[]" value="0">
                            </tr>
                         ';
                    }


                    return $html;
                }
            }
        }
    }
}
