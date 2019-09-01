<?php

namespace backend\helpers;

class RentStatus
{
    const GEN_MALE = 1;
    const GEN_FEMALE = 2;
    private static $data = [
        1 => 'ว่าง',
        2 => 'ไม่ว่าง'
    ];

    private static $dataobj = [
        ['id'=>1,'name' => 'ว่าง'],
        ['id'=>2,'name' => 'ไม่ว่าง'],
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
