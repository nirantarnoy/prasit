<?php

namespace backend\controllers;

use Yii;
use backend\models\Building;
use backend\models\BuildingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BuildingController implements the CRUD actions for Building model.
 */
class BuildingController extends Controller
{
    public $enableCsrfValidation = true;
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
     * Lists all Building models.
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
        $searchModel = new BuildingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Building model.
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
     * Creates a new Building model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Building();

        if ($model->load(Yii::$app->request->post())) {
            $uploadimage = UploadedFile::getInstance($model,'photo');
            if(!empty($uploadimage)){
                $uploadimage->saveAs(Yii::getAlias('@backend') .'/web/uploads/photo/'.$uploadimage);
                $model->photo = $uploadimage;
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Building model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $uploadimage = UploadedFile::getInstance($model,'photo');
            if(!empty($uploadimage)){
                $uploadimage->saveAs(Yii::getAlias('@backend') .'/web/uploads/photo/'.$uploadimage);
                $model->photo = $uploadimage;
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Building model.
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
                $model = \backend\models\Building::find()->where(['id'=>$id])->one();
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
     * Finds the Building model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Building the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Building::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
