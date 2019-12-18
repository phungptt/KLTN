<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 14-Sep-18
 * Time: 1:41 PM
 */

namespace app\modules\contrib\helper;

use DateTimeZone;
use PHPExcel_IOFactory;
use PHPExcel_RichText;
use PHPExcel_Shared_Date;
use PHPExcel_Style_NumberFormat;
use PHPExcel_Worksheet;
use DateTime;

class Excel
{
    public $isMultipleSheet = false;

    public $properties;

    public $columns = [];

    public $headers = [];

    public $fileName;

    public $savePath;

    public $format;

    public $isUpdateHeaderInformation = false;
    /**
     * @var boolean to set the first record on excel file to a keys of array per line.
     * If you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel.
     */
    public $setFirstRecordAsKeys = true;
    /**
     * @var array to unread record by index number.
     */
    public $leaveRecordByIndex = [];
    /**
     * @var array to read record by index, other will leave.
     */
    public $getOnlyRecordByIndex = [];

    public function import($fileName, $startDataRow = 1)
    {
        if (!$this->format) $this->format = PHPExcel_IOFactory::identify($fileName);

        $reader = PHPExcel_IOFactory::createReader($this->format);
        $phpExcel = $reader->load($fileName);

        $sheetCount = $phpExcel->getSheetCount();
        $sheetDatas = [];

        $worksheet = $phpExcel->getActiveSheet();

        $sheetDatas = $this->getSheetDatas($worksheet, $startDataRow);

        if ($this->setFirstRecordAsKeys) {
            $sheetDatas = $this->executeArrayLabel($sheetDatas);
        }
        if (!empty($this->getOnlyRecordByIndex)) {
            $sheetDatas = $this->executeGetOnlyRecords($sheetDatas, $this->getOnlyRecordByIndex);
        }
        if (!empty($this->leaveRecordByIndex)) {
            $sheetDatas = $this->executeLeaveRecords($sheetDatas, $this->leaveRecordByIndex);
        }


        return $sheetDatas;
    }

    public function getSheetDatas(PHPExcel_Worksheet $worksheet, $startRow = 1)
    {
        $nullValue = null;
        $calculateFormulas = true;
        $formatData = true;

        $returnValue = [];
        $updateHeaderInformation = false;
        $columnLetter = array_keys($worksheet->getColumnDimensions());


        foreach ($worksheet->getRowIterator($startRow) as $r => $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            foreach ($cellIterator as $c => $cell) {
                $value = $cell->getValue();

                if ($r === $startRow) {
                    $this->getHeaderInformation($cell);
                } else {
                    $v = $nullValue;

                    if (!is_null($value)) {
                        if ($value instanceof PHPExcel_RichText) {
                            $v = $value->getPlainText();
                        } else {
                            if ($calculateFormulas) {
                                $v = ($cell->isFormula()) ? $cell->getOldCalculatedValue() : $cell->getCalculatedValue();
                            } else {
                                $v = $value;
                            }
                        }

                        if ($formatData) {
                            $style = $cell->getStyle();
                            $numberFormat = $style->getNumberFormat();

                            if (PHPExcel_Shared_Date::isDateTime($cell)) {
                                $v = PHPExcel_Shared_Date::ExcelToPHPObject($v)->format('Y-m-d');
                            } else {
                                $v = PHPExcel_Style_NumberFormat::toFormattedString(
                                    $v,
                                    ($style && $numberFormat) ? $numberFormat->getFormatCode() : PHPExcel_Style_NumberFormat::FORMAT_GENERAL
                                );
                            }
                        }
                        $returnValue[$r][$c] = $v;
                    }

                    $returnValue[$r][$c] = $v;
                    if ($v && !$this->isUpdateHeaderInformation) {
                        $this->updateHeaderInformation($v, $cell);
                    }
                }

            };
            $this->removeEmptyRow($returnValue, $r);
        }
        return $returnValue;
    }

    public function getHeaderInformation($cellHeader)
    {
        $label = $cellHeader->getValue();
        $columnName = $cellHeader->getColumn();
        $name = ConvertHelper::convertStringToSlug($label, '_');

        $this->headers[$columnName] = [
            'name' => $name,
            'label' => $label,
            'column' => $columnName,
            'type' => null
        ];
    }

    public function updateHeaderInformation($value, $cell)
    {
        $columnName = $cell->getColumn();
        if (!$this->headers[$columnName]['type']) {
            $this->headers[$columnName]['type'] = gettype($value);

            if (PHPExcel_Shared_Date::isDateTime($cell)) {
                $this->headers[$columnName]['type'] = 'date';
            }
        }
    }

    protected function removeEmptyRow(&$returnValue, $r)
    {
        if (isset($returnValue[$r])) {
            $valuesOfRow = [];
            foreach ($returnValue[$r] as $item) {
                $val = trim($item);
                if ($val !== null && $val !== '') {
                    array_push($valuesOfRow, $val);
                }
            }
            if (!$valuesOfRow) {
                unset($returnValue[$r]);
            }
        }
    }

    /**
     * Setting label or keys on every record if setFirstRecordAsKeys is true.
     *
     * @param array $sheetData
     *
     * @return multitype:multitype:array
     */
    public function executeArrayLabel($sheetData)
    {
        foreach ($this->headers as $col) {
            $keys[$col['name']] = $col['name'];
        }


        $new_data = [];

        foreach ($sheetData as $values) {
            $new_data[] = array_combine($keys, $values);
        }
        return $new_data;
    }

    /**
     * Read record with same index number.
     *
     * @param array $sheetData
     * @param array $index
     *
     * @return array
     */
    public function executeGetOnlyRecords($sheetData = [], $index = [])
    {
        foreach ($sheetData as $key => $data) {
            if (!in_array($key, $index)) {
                unset($sheetData[$key]);
            }
        }
        return $sheetData;
    }

    /**
     * Leave record with same index number.
     *
     * @param array $sheetData
     * @param array $index
     *
     * @return array
     */
    public function executeLeaveRecords($sheetData = [], $index = [])
    {
        foreach ($sheetData as $key => $data) {
            if (in_array($key, $index)) {
                unset($sheetData[$key]);
            }
        }
        return $sheetData;
    }

//    public function readSheetHeader($fileName, $row = 1)
//    {
//
//        $row_header = $row;
//
//
//        if (!$this->format) $this->format = PHPExcel_IOFactory::identify($fileName);
//
//        $reader = PHPExcel_IOFactory::createReader($this->format);
//        $phpExcel = $reader->load($fileName);
//
//        $worksheet = $phpExcel->getActiveSheet();
//
//        $highestColumn = $worksheet->getHighestColumn();
//        $headingsArray = $worksheet->rangeToArray('A' . $row_header . ':' . $highestColumn . $row_header, null, true, true, true);
//
//        $header = $headingsArray[$row_header];
//        foreach ($header as $k => $value) {
//            $header[$k] = ConvertHelper::convertStringToSlug($value, '_');
//        }
//
//        return $header;
//    }
}