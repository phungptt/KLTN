<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07-Mar-19
 * Time: 9:22 AM
 */

namespace app\models;


use app\modules\app\services\UserService;
use app\modules\app\models\User;
use app\modules\app\models\UserInfo;
use app\modules\app\services\SiteService;
use yii\base\Model;
use Yii;

class RegisterForm extends Model
{
    public $username;
    public $password;
    public $cpassword;
    public $fullname;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password', 'cpassword', 'fullname'], 'required', 'message' => '{attribute} ' . Yii::t('app', 'can not be blank')],
            [['password', 'cpassword'], 'string', 'min' => 6, 'max' => 15, 'tooLong' => '{attribute} ' . Yii::t('app', 'should be at most 15 characters'), 'tooShort' => '{attribute} ' . Yii::t('app', 'should be at most 6 characters')],
            [['cpassword'], 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', 'Invalid confirm password')],
            ['username', 'email', 'message' => Yii::t('app', 'Invalid email format')],
            ['username', 'validateEmail'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateEmail($attribute, $params)
    {
        if (UserService::checkUsernameExist($this->username)) {
            $this->addError($attribute, Yii::t('app', 'Email has already been taken!'));
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function register()
    {
        if ($this->validate()) {
            $user = new User([
                'username' => $this->username,
                'password' => Yii::$app->getSecurity()->generatePasswordHash($this->password),
                'user_role_id' => UserService::$ROLE_USER,
                'slug' => SiteService::uniqid() . SiteService::convertStringToSlug($this->fullname),
                'deleted' => 0
            ]);

            $user->generateAuthKey();
            if($user->save()) {
                $userInfo = new UserInfo([
                    'user_id' => $user->id,
                    'fullname' => $this->fullname,
                    'email' => $user->username
                ]);
                $userInfo->save();

                return true;
            }
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'cpassword' => Yii::t('app', 'Confirm Password'),
            'fullname' => Yii::t('app', 'Fullname')
        ];
    }
}