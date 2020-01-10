<?php

namespace app\modules\app\services;

use app\modules\app\models\User;
use app\modules\app\models\UserInfo;
use app\modules\app\models\UserLog;
use Yii;
use yii\db\Expression;
use yii\db\Query;

class UserService
{
    public static $ACT_LOGIN = 1;
    public static $ACT_LOGOUT = 0;
    public static $ROLE_USER = 1;
    public static $ROLE_ADMINISTRATOR = 2;
    public static $ROLE_SUPER_USER = 3;

    public static function CheckUserLoggedIn()
    {
        return !\Yii::$app->user->isGuest;
    }

    public static function IsAdministrator($id = null)
    {
        if(self::IsSuperUser($id)) {
            return true;
        }
        
        $id = $id ? $id : \Yii::$app->user->id;

        $isAdministrator = User::find()->where(['and', ['id' => $id], ['user_role_id' => self::$ROLE_ADMINISTRATOR]])->one();
        return $isAdministrator ? true : false;
    }

    public static function IsSuperUser($id = null)
    {
        $id = $id ? $id : \Yii::$app->user->id;

        $isSuperUser = User::find()->where(['and', ['id' => $id], ['user_role_id' => self::$ROLE_SUPER_USER]])->one();
        
        return $isSuperUser ? true : false;
    }

    public static function GetUserProfile($userId=null) {
        $query = (new Query())
                                ->select('*')
                                ->from('user_info')
                                ->where(['and', ['user_id' => $userId]])
                                ->all();
        return $query;
    }

    public static function GetUserFullName($userId = null)
    {
        if (!$userId) {
            $userId = \Yii::$app->user->id;
        }
        return UserInfo::find()->select('fullname')->where(['user_id' => $userId])->column()[0];
    }

    public static function GetUserByUsername($username) {
        $user = User::findOne(['username' => $username]);
        return $user;
    }

    public static function GetIdByUsername($username) {
        $user = self::getUserByUsername($username);
        if($user) {
            return $user->id;
        }
        return false;
    }

    public static function CheckUsernameExist($username)
    {
        $existUsername = User::findAll(['username' => $username]);
        if ($existUsername) {
            return true;
        }
        return false;
    }

    public static function CheckEmailFormat($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function CheckPhoneFormat($phone)
    {
        if(strlen($phone) == 10 && preg_match("/^[0-9]{10}$/", $phone)) {
            return true;
        }
        return false;
    }

    public static function ValidateChangePasswordForm($request){
        $oldPass = $request['current-password'];
        $newPass = $request['password'];
        $rePass = $request['re-password'];
        $user = Yii::$app->user->getIdentity();

        if(!$oldPass || !$newPass || !$rePass) {
            return 'empty-field';
        } else if($user->password != $oldPass) {
            return 'pass-incorrect';
        } else if(strlen($newPass) < 6 || strlen($newPass) > 15) {
            return 'pass-length';
        } elseif ($rePass != $newPass) {
            return 'pass-match';
        }
        return 'success';
    }

    public static function WriteActivityLog($type, $userid, $time = null) {
        $time = $time ? $time : new Expression('NOW()');
        $actLog = new UserLog();
        $actLog->user_id = $userid;
        $actLog->log_time = $time;
        $actLog->type = $type;

        $actLog->save();
    }

    public static function GetNearestLogin($userId = null) {
        $userId = $userId ? $userId : Yii::$app->user->id;
        $nearestTime = (new Query())
            ->select('DISTINCT(user_id), log_time')
            ->from('user_log')
            ->where(['user_id' => $userId])
            ->andWhere(['type' => 1])
            ->orderBy('log_time DESC')
            ->limit(1)
            ->one();

        return $nearestTime['log_time'];
    }

    public static function ValidateAndRegisterAccount($form) {
        $validateFormRegister = self::ValidateFormRegister($form);
        if($validateFormRegister !== true) {
            return $validateFormRegister;
        }

        $authUser = new User(['username' => $form['username'], 'password' => Yii::$app->getSecurity()->generatePasswordHash($form['password'])]);
        $userInfo = new UserInfo();

        $authUser->generateAuthKey();
        $authUser->user_role_id = self::$ROLE_USER;
        if($authUser->save()) {
            $userInfo->user_id = $authUser->id;
            $userInfo->fullname = $form['fullname'];
            $userInfo->email = $authUser->username;
            $userInfo->save();
            return true;
        }

        return false;
    }

    public static function ValidateFormRegister($form){
        $fullname = $form['fullname'];
        $username = $form['username'];
        $password = $form['password'];
        $password2 = $form['password2'];

        if($fullname === '' || $username === '' || $password === '' || $password2 === '') {
            return Yii::t('app', 'Please complete the information fields.');
        }

        if(self::CheckUsernameExist($username)) {
            return Yii::t('app', 'Email has already been taken.');
        }

        if(!self::CheckEmailFormat($username)) {
            return Yii::t('app', 'Invalid email format.');
        }

        if(strlen($password) < 6 || strlen($password) > 15) {
            return Yii::t('app', 'Password length is from 6 to 15 characters.');
        }

        if($password !== $password2) {
            return Yii::t('app', 'Invalid confirm password.');
        }

        return true;
    }

    public static function ValidateFormLogin($form){
        $username = $form['username'];
        $password = $form['password'];

        if( $username === '' || $password === '') {
            return Yii::t('app', 'Please complete the information fields.');
        }

        $user = User::findOne(['username' => $username]);

        if(!$user || ($user && !Yii::$app->getSecurity()->validatePassword($password, $user->password))) {
            return Yii::t('app', 'Invalid email of password.');
        }

        return true;
    }

    public static function UpdateUserInfo($request) {
        $user_info = self::GetUserInfo($request);
        if($user_info->load($request->post()) && $user_info->save()) {
            return true;
        }
        return $user_info->errors;
    }

    public static function GetUserInfo($request) {
        $headers = $request->headers;
        $user_id = UserService::GetIdByUsername($headers->get('Username'));
        $user_info = UserInfo::findOne(['user_id' => $user_id]);
        return $user_info;
    }

    public static function ChangePassword($request) {
        $username = $request->headers->get('Username');
        $user = self::GetUserByUsername($username);
        $old_pass = $request->post('old-password');
        $new_pass = $request->post('new-password');
        $new_pass2 = $request->post('new-password2');

        //validate password
        if($old_pass === '' || $new_pass === '' || $new_pass2 === '') {
            return Yii::t('app', 'Please complete the information fields.');
        }
        if(!$user || ($user && !Yii::$app->getSecurity()->validatePassword($old_pass, $user->password))) {
            return Yii::t('app', 'Invalid current password.');
        }
        if(strlen($new_pass) < 6 || strlen($new_pass) > 15) {
            return Yii::t('app', 'Password length is from 6 to 15 characters.');
        }
        if($new_pass !== $new_pass2) {
            return Yii::t('app', 'Invalid confirm password.');
        }

        //Change Password
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($new_pass);
        $user->save();

        return true;
    }
}