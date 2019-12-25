<?php

namespace app\modules\app\models;

use Yii;

/**
 * This is the model class for table "destination_image".
 *
 * @property int $id
 * @property string $name
 * @property string $short_description
 * @property string $lat
 * @property string $lng
 * @property string $path
 * @property string $slug
 */
class DestinationImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'destination_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'default', 'value' => null],
            [['id'], 'integer'],
            [['name', 'short_description', 'lat', 'lng', 'path', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'short_description' => 'Short Description',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'path' => 'Path',
            'slug' => 'Slug',
        ];
    }
}
