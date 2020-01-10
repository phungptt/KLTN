<?php

namespace app\modules\app\controllers;

use app\modules\app\services\AuthHandler;
use app\modules\app\services\UserService;
use app\modules\app\models\User;
use app\modules\app\models\UserInfo;
use Yii;
use app\modules\app\APPConfig;

class UserController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'social' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();
    }

    public function actionProfile(){
        $user = Yii::$app->user->getIdentity();
        $userInfo = UserInfo::find()->where(['auth_user_id' => $user->id])->one();
        $request = Yii::$app->request;
        if($request->isPost) {
            if($userInfo->load($request->post()) && $userInfo->save()){
                Yii::$app->session->setFlash("success", "Cập nhật thông tin cá nhân thành công");
            }
        }
        return $this->render('profile', compact('user', 'userInfo'));
    }

    // public function actionChangePassword(){
    //     $request = Yii::$app->request;
    //     $validate = UserService::validateChangePasswordForm($request->post('AuthUser'));

    //     if($validate == 'success') {
    //         $user = Yii::$app->user->getIdentity();
    //         if($user->load($request->post()) && $user->save()) {
    //             Yii::$app->session->setFlash("success", "Thay đổi mật khẩu thành công!");
    //             return $this->redirect(Yii::$app->homeUrl . '/contrib/auth/auth-user/profile');
    //         }
    //     }

    //     switch ($validate) {
    //         case 'empty-field':
    //             $message = 'Vui lòng điền đầy đủ các thông tin.';
    //             break;
    //         case 'pass-incorrect':
    //             $message = 'Sai mật khẩu.';
    //             break;
    //         case 'pass-length':
    //             $message = 'Độ dài mật khẩu từ 6 - 15 ký tự.';
    //             break;
    //         case 'pass-match':
    //             $message = 'Xác nhận mật khẩu không đúng.';
    //             break;
    //         default:
    //             $message = 'Có lỗi sảy ra, vui lòng thử lại.';
    //             break;
    //     }
    //     return $this->asJson($message);
    // }

    public function validateFormRegister($formValues)
    {
        $email = $formValues['email'];
        $fullName = $formValues['fullname'];
        $password = $formValues['password'];
        $cpassword = $formValues['cpassword'];

        if (!$email || !$fullName || !$password || !$cpassword) {
            return 'empty-field';
        } elseif (UserService::checkUsernameExist($email)) {
            return 'email-exist';
        } elseif (!UserService::checkEmailFormat($email)) {
            return 'email-format';
        } elseif (strlen($password) < 6 || strlen($password) > 15) {
            return 'pass-length';
        } elseif ($password != $cpassword) {
            return 'pass-match';
        }

        return 'success';
    }

    public function actionUserProfile() {
        return $this->render('user-profile');
    }
}
