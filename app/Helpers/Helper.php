<?php

use App\enum\BureauAddressNameEnum;

if (!function_exists('getExpenditureType')) {
    function getBureauType($expenditureType)
    {
        if($expenditureType == BureauAddressNameEnum::EQUIFAX){
            return 'badge bg-success';
        }
        if($expenditureType == BureauAddressNameEnum::EXPERIAN){
            return 'badge bg-primary';
        }
        return 'badge bg-secondary';
    }
}

