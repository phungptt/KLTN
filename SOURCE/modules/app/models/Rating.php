<?php

namespace app\modules\app\models;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property int $id
 * @property int $id_user
 * @property int $rating
 * @property string $object_type
 * @property int $object_id
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'rating', 'object_id'], 'default', 'value' => null],
            [['id_user', 'rating', 'object_id'], 'integer'],
            [['object_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'rating' => 'Rating',
            'object_type' => 'Object Type',
            'object_id' => 'Object ID',
        ];
    }
}
