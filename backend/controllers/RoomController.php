<?php

namespace backend\controllers;

use Yii;
use backend\models\Room;
use backend\models\RoomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use kartik\mpdf\Pdf;

/**
 * RoomController implements the CRUD actions for Room model.
 */
class RoomController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Room models.
     * @return mixed
     */
    public function init()
    {
        if (Yii::$app->user->isGuest)
            $this->redirect(['site/login']);
    }
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new RoomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Room model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modelline = \backend\models\Transline::find()->where(['room_id'=>$id,'status'=>3])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelline' => $modelline
        ]);
    }

    /**
     * Creates a new Room model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Room();

        if ($model->load(Yii::$app->request->post())) {
            $uploadimage = UploadedFile::getInstance($model,'photo');
            if(!empty($uploadimage)){
                $uploadimage->saveAs(Yii::getAlias('@backend') .'/web/uploads/photo/'.$uploadimage);
                $model->photo = $uploadimage;
            }
            if($model->save()){
                $session = Yii::$app->session;
                $session->setFlash('msg','บันทึกรายการเรียบร้อย');
                return $this->redirect(['room/index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Room model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $room_lease = \backend\models\Roomlease::find()->where(['room_id'=>$id,'status'=>1])->all();

        if ($model->load(Yii::$app->request->post())) {
            $uploadimage = UploadedFile::getInstance($model,'photo');
            if(!empty($uploadimage)){
                $uploadimage->saveAs(Yii::getAlias('@backend') .'/web/uploads/photo/'.$uploadimage);
                $model->photo = $uploadimage;
            }
            if($model->save()){
//                if($model->pay_status == 1){
//                    \backend\models\Roomnonepay::deleteAll(['room_id'=>$model->id]);
//                }
                $session = Yii::$app->session;
                $session->setFlash('msg','บันทึกรายการเรียบร้อย');
                return $this->redirect(['trans/index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'room_lease' => $room_lease,
        ]);
    }

    /**
     * Deletes an existing Room model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $session = Yii::$app->session;
        $session->setFlash('msg','ลบรายการเรียบร้อย');
        return $this->redirect(['index']);
    }

    public function actionDeletephoto()
    {
        if(Yii::$app->request->isAjax){

            $id = Yii::$app->request->post('id');
            $photo = Yii::$app->request->post('photo');
            if($id){
                $model = \backend\models\Room::find()->where(['id'=>$id])->one();
                if($model){
                    $model->photo = '';
                    $model->save(false);
                }
            }
            if($photo !=''){
                unlink('../web/uploads/photo/'.$photo);
                return true;
            }
        }
    }

    /**
     * Finds the Room model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Room the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Room::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFindbuildinfo(){
        if(Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            if($id){
                $model = \backend\models\Building::find()->where(['id'=>$id])->one();
                if($model){
                    return Json::encode($model);
                }
            }else{
                return null;
            }
        }
    }

    public function actionReturnroom(){
        if(Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $room_id = Yii::$app->request->post('room_id');
          // return $id;
            if($id){
                $model = \backend\models\Roomlease::find()->where(['id'=>$id])->one();
                if($model){
                    $model->status = 100 ; //แจ้งออก
                    $model->leave_date = date('d-m-Y');
                    if($model->save(false)){

                        $modelupdate = \backend\models\Room::find()->where(['id'=>$model->room_id])->one();
                        $modelupdate->room_status = 1;
                        $modelupdate->save(false);
                        $this->redirect(['room/update','id'=>$model->room_id]);
                    }

                }
            }else{
                $this->redirect(['room/update','id'=>$room_id]);
            }
        }
    }

    public function actionAddlease(){
     //   echo "niran";return;
        $lease_no = Yii::$app->request->post('lease_no');
      //  echo $lease_no;return;
        $id = Yii::$app->request->post('room_id');
        $cust_id = Yii::$app->request->post('customer_id');
        $sdate = Yii::$app->request->post('start_date');
        $adv = Yii::$app->request->post('advance_amt');
        $fee = Yii::$app->request->post('fee_amt');
        $note = Yii::$app->request->post('note');

       // echo strtotime($sdate);return;

        $chk_old = \backend\models\Roomlease::find()->where(['room_id'=>$id,'status'=>1])->count();

        if($id && $lease_no != "" && $chk_old == 0){
            $model = new \backend\models\Roomlease();
            $model->lease_no = $lease_no;
            $model->customer_id = $cust_id;
            $model->start_from = date('Y-m-d', strtotime($sdate));
            $model->room_id = $id;
            $model->advance_amt = $adv;
            $model->insurance_amt = $fee;
            $model->note = $note;
            $model->status = 1;
            if($model->save(false)){
                $modelupdate = \backend\models\Room::find()->where(['id'=>$id])->one();
                $modelupdate->room_status = 2;
                $modelupdate->save(false);
                $this->redirect(['room/update','id'=>$id]);
            }
        }else{
            $this->redirect(['room/update','id'=>$id]);
        }

    }
    public function actionPrintslip(){

        $id = Yii::$app->request->post("row_id");
        if($id){
            // return $list;
            //$ids = explode(',',$list);
            //$modeltrans = \common\models\Trans::find()->where(['id'=>$id])->one();
            //  $modeltrans = \common\models\Trans::find()->where(['id'=>$id])->one();
            $plant_mobile = \backend\models\Plant::find(['mobile'])->one();
            $modelline = \backend\models\Transline::find()->where(['id'=>$id])->all();
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

    public function actionMakepay(){
        $id = Yii::$app->request->post("pay_id");
        $room_id = 0;
        if($id){
            $transline = \backend\models\Transline::find()->where(['id'=>$id])->one();
            if($transline){
                $room_id = $transline->room_id;
                $transline->status = 2;
                if($transline->save(false)){
                    \backend\models\Roomnonepay::deleteAll(['room_id'=>$room_id,'trans_line_id'=>$id]);
                    $paystatus = \backend\models\Roomnonepay::find()->where(['room_id'=>$room_id])->one();
                    if($paystatus){
                        $modelroom = \backend\models\Room::find()->where(['id'=>$room_id])->one();
                        $modelroom->pay_status = 2;
                        $modelroom->save(false);
                    }else{
                        $modelroomx = \backend\models\Room::find()->where(['id'=>$room_id])->one();
                        $modelroomx->pay_status = 1;
                        $modelroomx->save(false);
                    }

                }
                $this->redirect(['room/index']);
            }
        }
    }
}
