<?php

namespace backend\helpers;

class TransLineStatus
{
    const ROLE = 1;
    const RULE = 2;
    private static $data = [
        1 => 'รอชำระเงิน',
        2 => 'ชำระแล้ว',
        3 => 'ค้างชำระ'
    ];

    private static $dataobj = [
        ['id'=>1,'name' => 'รอชำระเงิน'],
        ['id'=>2,'name' => 'ชำระแล้ว'],
        ['id'=>3,'name' => 'ค้างชำระ'],
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
