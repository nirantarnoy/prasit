<?php

namespace backend\helpers;

class TransStatus
{
    const ROLE = 1;
    const RULE = 2;
    private static $data = [
        1 => 'รอยืนยัน',
        2 => 'ยืนยันแล้ว',
        3 => 'สำเร็จ'
    ];

    private static $dataobj = [
        ['id'=>1,'name' => 'รอยืนยัน'],
        ['id'=>2,'name' => 'ยืนยันแล้ว'],
        ['id'=>3,'name' => 'สำเร็จ'],
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
