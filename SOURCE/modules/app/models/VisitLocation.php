<?php

namespace app\modules\app\models;

use Yii;

/**
 * This is the model class for table "visit_location".
 *
 * @property int $id
 * @property int $id_place
 */
class VisitLocation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visit_location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_place'], 'default', 'value' => null],
            [['id_place'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_place' => 'Id Place',
        ];
    }
}
