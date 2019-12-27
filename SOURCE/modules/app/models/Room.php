<?php

namespace app\modules\app\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property int $id
 * @property int $id_place
 * @property string $name
 * @property string $price
 * @property int $contain_number
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_place', 'contain_number'], 'default', 'value' => null],
            [['id_place', 'contain_number'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'price' => 'Price',
            'contain_number' => 'Contain Number',
        ];
    }
}
