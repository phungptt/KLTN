<?php
namespace app\modules\app\services;
use Yii;
use DateTime;
use yii\helpers\ArrayHelper;

class SiteService 
{
    public static function FormarGPSInformation($lat, $lng, $latRef, $lngRef) {
        $newlat = self::ConvertStringDMSToDegreesCoord($lat);
        $newlng = self::ConvertStringDMSToDegreesCoord($lng);
        $newlatRef = $latRef == 'South' ? 'S' : 'N';
        $newlngRef = $lngRef == 'East' ? 'E' : 'W';
        $newlat = $newlatRef == 'S' ? -$newlat : $newlat;
        $newlng = $newlngRef == 'W' ? -$newlng : $newlng;
        
        $position = self::GetPositionFromStringDMS($lat, $lng, $newlatRef, $newlngRef);
        return [$newlat, $newlng, $latRef, $lngRef, $position];
    }
    public static function ConvertStringDMSToDegreesCoord($stringDMS) {
        $arrCoord = self::ConvertStringDMSToArrayCoord($stringDMS);
        $coord = self::ConvertArrCoordToDegreesCoord($arrCoord);
        return $coord;
    }
    public static function ConvertStringDMSToArrayCoord($stringDMS) {
        $stringDMS = str_replace(' deg ', ';', $stringDMS);
        $stringDMS = str_replace('\' ', ';', $stringDMS);
        $stringDMS = str_replace('" ', ';', $stringDMS);
        $arrCoord = explode(';', $stringDMS);
        array_pop($arrCoord);
        return $arrCoord;
    }
    public static function ConvertArrCoordToDegreesCoord($arrCoord) {
        list($d, $m, $s) = self::CalculateDMSFromArrCoord($arrCoord);
        return $d + ($m / 60) + ($s / 3600);
    }
    public static function CalculateDMSFromArrCoord($arrCoord) {
        $degrees = count($arrCoord) > 0 ? (float)$arrCoord[0] : 0;
        $minutes = count($arrCoord) > 1 ? (float)$arrCoord[1] : 0;
        $seconds = count($arrCoord) > 2 ? (float)$arrCoord[2] : 0;
        //normalize
        $minutes += 60 * ($degrees - floor($degrees));
        $degrees = floor($degrees);
        $seconds += 60 * ($minutes - floor($minutes));
        $minutes = floor($minutes);
        if ($seconds >= 60) {
            $minutes += floor($seconds / 60.0);
            $seconds -= 60 * floor($seconds / 60.0);
        }
        if ($minutes >= 60) {
            $degrees += floor($minutes / 60.0);
            $minutes -= 60 * floor($minutes / 60.0);
        }
        return [$degrees, $minutes, $seconds];
    }
    public static function GetPositionFromStringDMS($lat, $lng, $latRef, $lngRef) {
        $arrlat = self::ConvertStringDMSToArrayCoord($lat);
        $arrlng = self::ConvertStringDMSToArrayCoord($lng);
        list($latd, $latm, $lats) = self::CalculateDMSFromArrCoord($arrlat);
        list($lngd, $lngm, $lngs) = self::CalculateDMSFromArrCoord($arrlng);
        return $latd . '° ' . $latm . '\' ' . $lats . '" ' . $latRef . ', ' . $lngd . '° ' . $lngm . '\' ' . $lngs . '" ' . $lngRef ;
    }
    public static function GetPositionFromDecimal($lat, $lng, $latRef, $lngRef) {
        $latValue = self::ConvertDecimalToDMSCoord($lat, $latRef);
        $lngValue = self::ConvertDecimalToDMSCoord($lng, $lngRef);
        return $latValue . ', ' . $lngValue;
    }
    public static function ConvertDecimalToDMSCoord($decimal, $ref) {
        $deg = ($decimal > 0) ? abs( floor($decimal) ) : abs( ceil($decimal) );
        $min = abs( ($decimal - floor($decimal)) * 60 );
        $sec = abs( ($min - floor($min)) * 60 );
         
        $DMSValue = $deg . '° ' . floor($min) . '\' ' . floor($sec) . '" ' . $ref; 
        return $DMSValue;
    }
    public static function GetFormattedTime($time) {
        return DateTime::createFromFormat('Y-m-d H:i:s.u', $time)->format('H:i:s d-m-Y');
    }
    public static function GetFormattedDate($time) {
        return DateTime::createFromFormat('Y-m-d H:i:s', $time)->format('d-m-Y');
    }
    public static function CommandQuery($query)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($query);
        return $command;
    }
    public static function CommandQueryOne($query)
    {
        $command = self::CommandQuery($query);
        return $command->queryOne();
    }
    public static function CommandQueryAll($query)
    {
        $command = self::CommandQuery($query);
        return $command->queryAll();
    }
    public static function CommandQueryColumn($query)
    {
        $command = self::CommandQuery($query);
        return $command->queryColumn();
    }
    public static function ConvertLatLngToGeometry($lat, $lng)
    {
        return [
            'type' => 'Point',
            'coordinates' => [$lng, $lat]
        ];
    }
    public static function CreatePaginationMetadata($total, $page, $perpage, $count)
    {
        $total = intval($total);
        $page = intval($page);
        $pages = ceil($total / $perpage);
        $from = ($page - 1) * $perpage + 1;
        $to = $from + $count - 1;
        $pagination = [
            'total' => $total,
            'perpage' => $perpage,
            'current' => $page,
            'pages' => $pages,
            'from' => $from,
            'to' => $to,
            'links' => []
        ];
        //first link
        array_push($pagination['links'], 1);
        // ...
        if ($page - 1 > 2) {
            array_push($pagination['links'], '...');
        }
        //before current
        for ($i = 1; $i < $page; $i++) {
            if ($page - $i <= 2) {
                array_push($pagination['links'], $i);
            }
        }
        //current
        array_push($pagination['links'], 'current');
        //aftercurrent
        for ($i = $page + 1; $i <= $pages; $i++) {
            if ($i - $page <= 2) {
                array_push($pagination['links'], $i);
            }
        }
        // ...
        if ($pages - $page > 2) {
            array_push($pagination['links'], '...');
        }
        //last
        array_push($pagination['links'], $pages);
        return $pagination;
    }
    public static function GetLimitAndOffset($page, $perpage)
    {
        $limit = $perpage;
        $offset = ($page - 1) * $limit;
        return [$limit, $offset];
    }
    public static function ArrayIndexBy($array, $column)
    {
        $arrIdxBy = [];
        foreach ($array as $item) {
            $arrIdxBy[$item[$column]] = $item;
        }
        return $arrIdxBy;
    }
    public static function ConvertDateTime($date_string)
    {
        $difference = time() - strtotime($date_string);
        $time = strtotime($date_string);
        return date('d/m/Y', $time);
    }
    public static function TimeAgo($date_string)
    {
        $timediff = time() - strtotime($date_string);
        $days = intval($timediff / 86400);
        $remain = $timediff % 86400;
        $hours = intval($remain / 3600);
        $remain = $remain % 3600;
        $mins = intval($remain / 60);
        $secs = $remain % 60;
        if ($secs >= 0) $timestring = $secs . " seconds ago";
        if ($mins > 0) $timestring = $mins . " mins ago";
        if ($hours > 0) $timestring = $hours . " hours ago";
        if ($days > 0) $timestring = $days . " days ago";
        return $timestring;
    }
    public static function getSiteUrl() {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'];
        return $protocol.$domainName;
    }
    public static function reverseArray($array, $bool = false) {
        $newArr = $bool ? array_reverse($array, $bool) : array_reverse($array);
        return $newArr;
    }
    public static function reverseDate($date) {
        $arr = explode('-', $date);
        $arr = self::reverseArray($arr);
        $newDate = implode('/', $arr);
        return $newDate;
    }
    public static function getYearOfDate($date) {
        $arr = explode('-', $date);
        $year = array_shift($arr);
        return $year;
    }
    public static function uniqid() {
        return md5(uniqid(rand(), true));
    }

    //CONVERT
    public static function convertToAlphaBetUnderscore($string)
    {
        $convertedString = preg_replace('/[^a-zA-Z0-9_.]/', '', $string);
        return $convertedString;
    }

    public static function convertDataToString($data)
    {
        if (is_array($data)) {
            return json_encode($data);
        }
        return $data;
    }

    public static function convertToExcelTypeOutput($input)
    {
        if (is_array($input)) {
            return implode(', ', $input);
        }
        return $input;
    }

    public static function convertStringToSlug($string, $separator = '-')
    {
        $slug = self::convertVNToNonVN($string);
        $slug = strtolower(trim($slug));
        $slug = preg_replace('/[^a-z0-9-]/', $separator, $slug);
        $slug = preg_replace('/-+/', $separator, $slug);
        return $slug;
    }

    public static function convertVNToNonVN($str)
    {
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );

        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ', '-', $str);
        return $str;
    }

    public static function ConvertModelsToArrays($models){
        $arrays = ArrayHelper::toArray($models);
        return $arrays;
    }
}