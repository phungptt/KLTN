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
 * @property string $description
 * @property int $viewed
 * @property int $status
 * @property int $deleted
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
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
            [['id', 'viewed', 'status', 'deleted', 'created_by'], 'default', 'value' => null],
            [['id', 'viewed', 'status', 'deleted', 'created_by'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
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
            'description' => 'Description',
            'viewed' => 'Viewed',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
        ];
    }
}
