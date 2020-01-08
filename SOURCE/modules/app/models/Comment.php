<?php

namespace app\modules\app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $content
 * @property string $object_type
 * @property int $object_id
 * @property string $status
 * @property string $delete
 * @property int $create_by
 * @property string $create_at
 * @property string $update_at
 * @property string $short_description
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['object_id', 'create_by'], 'default', 'value' => null],
            [['object_id', 'create_by'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['object_type', 'status', 'delete', 'short_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'object_type' => 'Object Type',
            'object_id' => 'Object ID',
            'status' => 'Status',
            'delete' => 'Delete',
            'create_by' => 'Create By',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'short_description' => 'Short Description',
        ];
    }
}
