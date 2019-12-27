<?php

namespace app\modules\app\models;

use Yii;

/**
 * This is the model class for table "food".
 *
 * @property string $min_price
 * @property string $max_price
 * @property int $id_place
 * @property int $id
 */
class Food extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['min_price', 'max_price'], 'number'],
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
            'min_price' => 'Min Price',
            'max_price' => 'Max Price',
            'id_place' => 'Id Place',
            'id' => 'ID',
        ];
    }
}
