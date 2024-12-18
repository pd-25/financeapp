<?php

namespace App\enum;

class ItemTypeEnum
{
    const LATE_PAYMENT = 'Late Payment';
    const CHARGE_OFF = 'Charge Off';
    const RE_POSSESSION = 'RE-Possession';
    const FORECLOSURE = 'Foreclosure';
    const COLLECTION = 'Collection';


    public static function values(): array
    {
        return [
            self::LATE_PAYMENT,
            self::CHARGE_OFF,
            self::RE_POSSESSION,
            self::FORECLOSURE,
            self::COLLECTION
        ];
    }
}
