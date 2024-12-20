<?php

namespace App\enum;

class BureauStatusEnum
{
    const NEGATIVE = 'Negative';
    const DELETED = 'Deleted';
    const NOT_REPORTED = 'Not reported';
    const DONOT_PROCESS = 'Do not process';


    public static function values(): array
    {
        return [
            self::NEGATIVE,
            self::DELETED,
            self::NOT_REPORTED,
            self::DONOT_PROCESS
        ];
    }
}
