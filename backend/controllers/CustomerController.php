<?php

namespace backend\controllers;

use Yii;
use backend\models\Customer;
use backend\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use kartik\mpdf\Pdf;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
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
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage'=>$pageSize,
        ]);
    }

    /**
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customer();
        $model_address = new \backend\models\AddressBook();

        if ($model->load(Yii::$app->request->post())) {
            $uploadimage = UploadedFile::getInstance($model,'photo');
            if(!empty($uploadimage)){
                $uploadimage->saveAs(Yii::getAlias('@backend') .'/web/uploads/photo/'.$uploadimage);
                $model->photo = $uploadimage;
            }
            $model->bod = date('Y-m-d',strtotime($model->bod));
            if($model->save()){
                if($model_address->load(Yii::$app->request->post())){
                    $model_address->party_type_id = 2;
                    $model_address->party_id = $model->id;
                    $model_address->save(false);
                }

                $session = Yii::$app->session;
                $session->setFlash('msg','บันทึกรายการเรียบร้อย');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'model_address'=>$model_address,
        ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_address_plant = \backend\models\AddressBook::find()->where(['party_id'=>$id,'party_type_id'=>2])->one();
        $model_address = new \backend\models\AddressBook();
        if ($model->load(Yii::$app->request->post()) && $model_address->load(Yii::$app->request->post())) {

            $uploaded = UploadedFile::getInstance($model,'photo');
            if(!empty($uploaded)){
                $upfiles = time() . "." . $uploaded->getExtension();
                //if ($uploaded->saveAs('../uploads/products/' . $upfiles)) {
                if ($uploaded->saveAs('../web/uploads/photo/' . $upfiles)) {
                    $model->photo = $upfiles;
                }
            }
            $model->bod = date('Y-m-d',strtotime($model->bod));
            if($model->save()){

                \backend\models\AddressBook::deleteAll(['party_id'=>$id,'party_type_id'=>2]);
                $model_address->party_type_id = 2;
                $model_address->party_id = $model->id;
                $model_address->save(false);
                $session = Yii::$app->session;
                $session->setFlash('msg','บันทึกรายการเรียบร้อย');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'model_address'=>$model_address,
            'model_address_plant'=>$model_address_plant,
        ]);
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete()){
            $session = Yii::$app->session;
            $session->setFlash('msg','ลบรายการเรียบร้อย');
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionFindname(){
        if(Yii::$app->request->isAjax){
            $id = Yii::$app->request->post("cust_id");
            if($id){
                $model = \backend\models\Customer::find()->where(['id'=>$id])->one();
                if($model){
                    return $model->first_name." ".$model->last_name;
                }else{
                    return "";
                }
            }else{
                return "";
            }
        }

    }
    public function actionDeletephoto($id,$photoname,$type){
        if($photoname!=''){
            //if(unlink(Yii::$app->basePath . '/web/uploads/photo/' . $photoname)){
            if(file_exists(Yii::$app->basePath . '/web/uploads/photo/' . $photoname)){
                unlink(Yii::$app->basePath . '/web/uploads/photo/' . $photoname);
            }

            $model = Customer::find()->where(['id'=>$id])->one();
            if($model){
                if($type == 1){
                    $model->photo = '';
                }else{
                    $model->photo = '';
                }

                $model->save(false);
            }
            //}

            $this->redirect(['customer/update','id'=>$id]);
        }
    }
    public function actionPrinthistory($id){
        if($id){
            $model= \backend\models\Treat::find()->where(['customer_id'=>$id])->all();
            if($model){
                $model_cust = \backend\models\Customer::find()->where(['id'=>$id])->one();
                $pdf = new Pdf([
                    'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                    //  'format' => [150,236], //manaul
                    'format' => Pdf::FORMAT_A4,
                    'orientation' => Pdf::ORIENT_PORTRAIT,
                    'destination' => Pdf::DEST_BROWSER,
                    'content' => $this->renderPartial('_print',
                        [
                            'model'=>$model,
                            'model_cust'=>$model_cust
                        ]),
                    //'content' => "nira",
                    'cssFile' => '@backend/web/css/pdf.css',
                    //'jsFile'=>'@backend/web/js',
                    'defaultFont' => 'Cloud-Light',
                    'options' => [
                        'title' => 'รายงานระหัสินค้า',
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
    }
}
