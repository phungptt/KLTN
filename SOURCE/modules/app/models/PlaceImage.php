<?php

namespace app\modules\app\models;

use Yii;

/**
 * This is the model class for table "place_image".
 *
 * @property int $id
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property string $viewed
 * @property string $slug
 * @property string $phone_number
 * @property string $address
 * @property string $lat
 * @property string $lng
 * @property string $create_at
 * @property int $create_by
 * @property string $update_at
 * @property string $status
 * @property string $deleted
 * @property int $id_destination
 * @property string $time_open
 * @property string $time_closed
 * @property int $id_type_of_place
 * @property string $path
 * @property string $name_destination
 */
class PlaceImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'create_by', 'id_destination', 'id_type_of_place'], 'default', 'value' => null],
            [['id', 'create_by', 'id_destination', 'id_type_of_place'], 'integer'],
            [['description', 'phone_number'], 'string'],
            [['create_at', 'update_at', 'time_open', 'time_closed'], 'safe'],
            [['name', 'short_description', 'viewed', 'slug', 'address', 'lat', 'lng', 'status', 'deleted', 'path', 'name_destination'], 'string', 'max' => 255],
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
            'lat' => 'Lat',
            'lng' => 'Lng',
            'create_at' => 'Create At',
            'create_by' => 'Create By',
            'update_at' => 'Update At',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'id_destination' => 'Id Destination',
            'time_open' => 'Time Open',
            'time_closed' => 'Time Closed',
            'id_type_of_place' => 'Id Type Of Place',
            'path' => 'Path',
            'name_destination' => 'Name Destination',
        ];
    }
}
