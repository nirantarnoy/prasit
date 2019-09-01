<?php

namespace backend\helpers;

class RoomStatus
{
    const GEN_MALE = 1;
    const GEN_FEMALE = 2;
    private static $data = [
        1 => 'ปกติ',
        2 => 'ปิดปรับปรุง'
    ];

    private static $dataobj = [
        ['id'=>1,'name' => 'ปกติ'],
        ['id'=>2,'name' => 'ปิดปรับปรุง'],
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
