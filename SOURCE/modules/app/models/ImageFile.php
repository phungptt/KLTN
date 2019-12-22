<?php

namespace app\modules\app\models;

use Yii;

/**
 * This is the model class for table "image_file".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $path
 * @property int $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $type
 * @property int $deleted
 */
class ImageFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'deleted'], 'default', 'value' => null],
            [['created_by', 'deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug', 'path', 'type'], 'string', 'max' => 255],
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
            'slug' => 'Slug',
            'path' => 'Path',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'type' => 'Type',
            'deleted' => 'Deleted',
        ];
    }
}
