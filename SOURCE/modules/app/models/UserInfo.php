<?php

namespace app\modules\app\models;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property int $id
 * @property int $user_id
 * @property string $fullname
 * @property string $birthday
 * @property int $gender
 * @property string $address
 * @property string $phone
 * @property string $email
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'gender'], 'default', 'value' => null],
            [['user_id', 'gender'], 'integer'],
            [['birthday'], 'safe'],
            [['fullname', 'address', 'phone', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'fullname' => 'Fullname',
            'birthday' => 'Birthday',
            'gender' => 'Gender',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
        ];
    }
}
