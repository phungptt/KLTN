<?php

namespace app\modules\app\models;

use Yii;

/**
 * This is the model class for table "plan_detail".
 *
 * @property int $id
 * @property int $id_plan
 * @property int $id_place
 * @property int $id_type_of_transport
 * @property string $place_name
 * @property string $lat
 * @property string $lng
 * @property int $time_start
 * @property int $time_stay
 * @property int $time_move
 * @property int $date_index
 * @property string $path
 * @property string $note
 * @property string $slug
 * @property double $distance
 * @property int $free_time
 */
class PlanDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_plan', 'id_place', 'id_type_of_transport', 'time_start', 'time_stay', 'time_move', 'date_index', 'free_time'], 'default', 'value' => null],
            [['id_plan', 'id_place', 'id_type_of_transport', 'time_start', 'time_stay', 'time_move', 'date_index', 'free_time'], 'integer'],
            [['note'], 'string'],
            [['distance'], 'number'],
            [['place_name', 'lat', 'lng', 'path', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_plan' => 'Id Plan',
            'id_place' => 'Id Place',
            'id_type_of_transport' => 'Id Type Of Transport',
            'place_name' => 'Place Name',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'time_start' => 'Time Start',
            'time_stay' => 'Time Stay',
            'time_move' => 'Time Move',
            'date_index' => 'Date Index',
            'path' => 'Path',
            'note' => 'Note',
            'slug' => 'Slug',
            'distance' => 'Distance',
            'free_time' => 'Free Time',
        ];
    }
}
