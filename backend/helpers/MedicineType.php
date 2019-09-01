<?php

namespace backend\helpers;

class MedicineType
{
    const ROLE = 1;
    const RULE = 2;
    private static $data = [
        1 => 'ยา',
        2 => 'อุปกรณ์'
    ];

    private static $dataobj = [
        ['id'=>1,'name' => 'ยา'],
        ['id'=>2,'name' => 'อุปกรณ์'],
    ];
    public static function asArray()
    {
        return self::$data;
    }
    public static function asArrayObject()
    {
        return self::$dataobj;
    }
    public static function getTypeById($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown Type';
    }
    public static function getTypeByName($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown Type';
    }
}
