<?php

namespace app\modules\app\models;

use Yii;

/**
 * This is the model class for table "plan_review".
 *
 * @property int $id_plan_detail
 * @property string $review
 * @property string $created_at
 * @property int $id
 */
class PlanReview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan_review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_plan_detail'], 'default', 'value' => null],
            [['id_plan_detail'], 'integer'],
            [['review'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_plan_detail' => 'Id Plan Detail',
            'review' => 'Review',
            'created_at' => 'Created At',
            'id' => 'ID',
        ];
    }
}
