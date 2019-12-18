<?php
/**
 * Description of Module
 *
 * @author TriLVH
 */
namespace app\modules\contrib\helper;

use yii\data\Pagination;

class MongoDbHelper {
    public static function getGeoJsonField($type, $coordinates) {
        return [
            'type' => $type,
            'coordinates' => $coordinates
        ];
    }
}