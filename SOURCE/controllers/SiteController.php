<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\ContactForm;
use app\modules\app\services\UserService;
use yii\helpers\Url;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        // dd('kfhgdfkjh');
        return $this->render('index');
    }

    public function actionLogin()
    {
        $returnUrl = Yii::$app->user->returnUrl;
        $baseUrl = Url::base() . '/';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            UserService::WriteActivityLog(UserService::$ACT_LOGIN, Yii::$app->user->id);
            if($returnUrl == $baseUrl || $returnUrl == '/web/site/register/'){
                return $this->redirect(Yii::$app->homeUrl);
            } else {
                return $this->goBack();
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        if(Yii::$app->request->isPost) {
            if($model->load(Yii::$app->request->post()) && $model->register()) {
                Yii::$app->session->setFlash('success', 'Đăng ký tài khoản mới thành công');
                return $this->redirect( Yii::$app->homeUrl . "site/login");
            }
        }

        return $this->render('register', [
            'model' => $model
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
