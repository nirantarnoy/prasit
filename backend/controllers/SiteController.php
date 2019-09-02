<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','changepassword'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post','get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $count_b = \backend\models\Building::find()->count();
        $count_r = \backend\models\Room::find()->count();
        $count_c = \backend\models\Customer::find()->count();
        $count_empty = \backend\models\Room::find()->where(['room_status'=>1])->count();
        $count_notpay = \backend\models\Room::find()->where(['pay_status'=>2])->count();
        $count_notpay_amt = \backend\models\Roomnonepay::find()->where(['status'=>1])->sum('total_amt');
        return $this->render('index',
            [
                'count_b'=>$count_b,
                'count_r'=>$count_r,
                'count_c'=>$count_c,
                'count_empty' => $count_empty,
                'count_notpay' => $count_notpay,
                'count_notpay_amt' => $count_notpay_amt
            ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionChangepassword(){
        $model=new \backend\models\Resetform();
        if($model->load(Yii::$app->request->post())){

            $model_user = \backend\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
            if($model_user->validatePassword($model->oldpw)){
                $model_user->setPassword($model->confirmpw);
                $model_user->save();
                return $this->redirect(['site/logout']);
            }else{
                $session = Yii::$app->session;
                $session->setFlash('msg_err','รหัสผ่านเดิมไม่ถูกต้อง');
            }

        }
        return $this->render('_setpassword',[
            'model'=>$model
        ]);
    }
}
