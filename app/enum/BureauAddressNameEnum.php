<?php

namespace App\enum;

class BureauAddressNameEnum
{
    const EQUIFAX = 'Equifax';
    const EXPERIAN = 'Experian';
    const TRANSUNION = 'Transunion';
    

    public static function values(): array
    {
        return [
            self::EQUIFAX,
            self::EXPERIAN,
            self::TRANSUNION,
        ];
    }
}
