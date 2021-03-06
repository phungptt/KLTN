<?php

namespace app\modules\app\models;

use Yii;

/**
 * This is the model class for table "diem_den".
 *
 * @property int $id
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property string $slug
 * @property int $viewed
 * @property string $lat
 * @property string $lng
 * @property int $status
 * @property int $deleted
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 */
class DiemDen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diem_den';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['viewed', 'status', 'deleted', 'created_by'], 'default', 'value' => null],
            [['viewed', 'status', 'deleted', 'created_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'short_description', 'slug', 'lat', 'lng'], 'string', 'max' => 255],
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
            'description' => 'Description',
            'slug' => 'Slug',
            'viewed' => 'Viewed',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
        ];
    }
}
