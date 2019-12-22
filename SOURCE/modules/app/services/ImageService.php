<?php

namespace app\modules\app\services;

use Yii;
use app\modules\app\models\ImageFile;
use app\modules\app\models\ImageRef;
use app\modules\contrib\helper\ConvertHelper;

class ImageService
{
    //upload dir
    public static $UPLOAD_DIR = 'uploads/';
    public static $THUMBNAIL_DIR = 'uploads/thumbnails/';
    //deleted
    public static $ALIVE = 1;
    public static $DELETED = 0;
    
    public static $CONVERT_IMAGE_EXTENSION = [
        'png' => 'jpeg',
        'jpeg' => 'jpeg',
        'jpg' => 'jpeg',
    ];

    public static $CoordinateRef = [
        'N' => 'North',
        'E' => 'East',
        'S' => 'South',
        'W' => 'West',
    ];

    public static function SaveImage($image) {
        if ($image->validate()) {
            $imgInfo = self::InitImageInformation($image->imageFile->name);
            $path = self::$UPLOAD_DIR . $imgInfo['path'];
            if ($image->imageFile->saveAs($path)) {
                $imageFile = new ImageFile([
                    'name' => $imgInfo['name'],
                    'slug' => $imgInfo['slug'],
                    'path' => $imgInfo['path'],
                    'type' => $imgInfo['type'],
                    'deleted' => self::$ALIVE,
                    'created_by' => Yii::$app->user->id,
                ]);

                if ($imageFile->save()) {
                    return $imageFile;
                }
            }
            return false;
        }
        return false;
    }

    public static function SaveImages($images) {
        if($images->validate()) {
            $imageFiles = [];
            foreach($images->imageFiles as $img) {
                $imgInfo = self::InitImageInformation($img->name);
                $path = self::$UPLOAD_DIR . $imgInfo['path'];
                if ($img->saveAs($path)) {
                    $imageFile = new ImageFile([
                        'name' => $imgInfo['name'],
                        'slug' => $imgInfo['slug'],
                        'path' => $imgInfo['path'],
                        'type' => $imgInfo['type'],
                        'deleted' => self::$ALIVE,
                        'created_by' => Yii::$app->user->id,
                    ]);
    
                    if ($imageFile->save()) {
                        array_push($imageFiles, $imageFile);
                    }
                }
            }
            return $imageFiles;
        }
        return false;
    }

    public static function InitImageInformation($name)
    {
        list($newname, $ext) = self::ParseImageNameToNameAndExtension($name);
        $uniqueSlug = md5(uniqid(rand(), true));

        // $ext = self::$CONVERT_IMAGE_EXTENSION[strtolower($ext)];
        $newname = $newname . '.' . $ext;
        $path = $uniqueSlug . '-' . $newname;

        $imgInfo = [
            'name' => $newname,
            'slug' => $uniqueSlug,
            'path' => $path,
            'type' => $ext,
        ];

        return $imgInfo;
    }

    public static function ParseImageNameToNameAndExtension($name) {
        $parseImgname = explode('.', $name);
        $ext = end($parseImgname);
        array_pop($parseImgname);
        $newname = implode('-', $parseImgname);
        $newname = ConvertHelper::convertStringToSlug($newname);
        return [$newname, $ext];
    }

    public static function CreateThumbnailForImage($filename) {
        chdir('uploads');
        $command = 'mogrify -auto-orient -resize 400 -path thumbnails/ ' . $filename;
        $output = shell_exec($command);
    }

    public static function GetFullImagePath($filename) {
        $folderContainFile = Yii::getAlias('@app') . '\\web\\uploads\\';
        $fullPath = $folderContainFile . $filename;
        return $fullPath;
    }

    public static function SaveImageRef($imageid, $objtype, $objid, $relate = false) {
        $imageRef = new ImageRef([
            'object_type' => $objtype,
            'object_id' => $objid,
            'image_id' => $imageid
        ]);

        if($relate) {
            $imageRef->relate = 1;
        }
        
        $imageRef->save();
    }

    public static function SaveImagesRef($images, $objtype, $objid) {
        foreach($images as $image) {
            self::SaveImageRef($image->id, $objtype, $objid, true);
        }
    }

    public static function GetThumbnailPath($path) {
        if($path) {
            return Yii::$app->homeUrl . self::$THUMBNAIL_DIR . $path;
        }

        return Yii::$app->homeUrl . "resources/images/default.jpg";
    }

    public static function GetOriginalPath($path) {
        if($path) {
            return Yii::$app->homeUrl . self::$UPLOAD_DIR . $path;
        }

        return Yii::$app->homeUrl . "resources/images/default.jpg";
    }
}
