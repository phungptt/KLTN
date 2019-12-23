<?php

namespace app\modules\app\models;

use Yii;

/**
 * This is the model class for table "place".
 *
 * @property int $id
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property string $viewed
 * @property string $slug
 * @property string $phone_number
 * @property string $address
 * @property string $time_open
 * @property string $time_closed
 * @property string $lat
 * @property string $lng
 * @property string $create_at
 * @property int $create_by
 * @property string $update_at
 * @property string $status
 * @property string $deleted
 * @property int $id_destination
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone_number'], 'string'],
            [['time_open', 'time_closed', 'create_at', 'update_at'], 'safe'],
            [['create_by', 'id_destination'], 'default', 'value' => null],
            [['create_by', 'id_destination'], 'integer'],
            [['name', 'short_description', 'description', 'viewed', 'slug', 'address', 'lat', 'lng', 'status', 'deleted'], 'string', 'max' => 255],
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
            'viewed' => 'Viewed',
            'slug' => 'Slug',
            'phone_number' => 'Phone Number',
            'address' => 'Address',
            'time_open' => 'Time Open',
            'time_closed' => 'Time Closed',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'create_at' => 'Create At',
            'create_by' => 'Create By',
            'update_at' => 'Update At',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'id_destination' => 'Id Destination',
        ];
    }
}
