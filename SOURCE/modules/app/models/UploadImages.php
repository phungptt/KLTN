<?php 

namespace app\modules\app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadImages extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 5],
        ];
    }
}