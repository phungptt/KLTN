<?php

namespace app\modules\app\models;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property int $id
 * @property int $id_destination
 * @property int $status
 * @property int $deleted
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property string $name
 * @property string $slug
 * @property int $total_day
 * @property string $note
 * @property int $public
 * @property string $date_start
 * @property string $date_end
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_destination', 'status', 'deleted', 'created_by', 'total_day', 'public'], 'default', 'value' => null],
            [['id_destination', 'status', 'deleted', 'created_by', 'total_day', 'public'], 'integer'],
            [['created_at', 'updated_at', 'date_start', 'date_end'], 'safe'],
            [['note'], 'string'],
            [['name', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_destination' => 'Id Destination',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'name' => 'Name',
            'slug' => 'Slug',
            'total_day' => 'Total Day',
            'note' => 'Note',
            'public' => 'Public',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
        ];
    }
}
