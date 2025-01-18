<?php

use App\enum\BureauAddressNameEnum;
use App\enum\BureauStatusEnum;

if (!function_exists('getBureauType')) {
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

if (!function_exists('getBaruaeStatus')) {
    function getBaruaeStatus($bareauStatus)
    {
        if($bareauStatus == BureauStatusEnum::NEGATIVE){
            return 'btn bg-danger';
        }
        if($bareauStatus == BureauStatusEnum::DELETED){
            return 'btn bg-info';
        }
        if($bareauStatus == BureauStatusEnum::NOT_REPORTED){
            return 'btn bg-primary';
        }
        if($bareauStatus == BureauStatusEnum::DONOT_PROCESS){
            return 'btn bg-warning';
        }
    }
}

