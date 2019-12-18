<?php

namespace app\modules\app\models;

use app\modules\app\models\AuthUserBase;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 * @property int $deleted
 * @property string $auth_key
 * @property string $password_reset_token
 * @property int $user_role_id
 *  @property int $slug
 */
class User extends AuthUserBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['deleted', 'user_role_id'], 'default', 'value' => null],
            [['deleted', 'user_role_id'], 'integer'],
            [['username', 'password', 'auth_key', 'password_reset_token', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted' => 'Deleted',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'user_role_id' => 'User Role ID',
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    // public static function findIdentityByAccessToken($token, $type = null)
    // {
    //     return static::findOne(['access_token' => $token]);
    // }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    
    public function validatePassword($password)
    {
        return  Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
}
