<?php

namespace App\enum;

class DisputeLetterVariableEnum
{
    const CONTACT_FULL_NAME = 'contact_full_name';
    const CONTACT_FIRST_NAME = 'contact_first_name';
    const CONTACT_LAST_NAME = 'contact_last_name';
    const CONTACT_DOB = 'contact_dob_name';
    const CONTACT_SSN = 'contact_ssn';
    const CONTACT_RES_COMPLETE_ADDRESS = 'contact_res_complete_address';
    const CONTACT_STREET_ADDRESS = 'contact_street_address';
    const CONTACT_CITY = 'contact_city';
    const CONTACT_STATE = 'contact_state';
    const CONTACT_ZIPCODE = 'contact_zipcode';

    const RECIPIENT_CURRENT_DATE = 'current_date';
    const RECIPIENT_ITEM_LIST = 'recipient_item_list';
    const RECIPIENT_ITEM_LIST_WITH_INSTRUCTION = 'recirecipient_item_list_with_instruction';
    const RECIPIENT_RES__ADDRESS = 'recipient_res_address';
    const RECIPIENT_STREET_ADDRESS = 'recipient_street_address';
    const RECIPIENT_CITY = 'recipient_city';
    const RECIPIENT_STATE = 'recipient_state';
    const RECIPIENT_ZIPCODE = 'recipient_zipcode';
    


    public static function values(): array
    {
        return [
            self::CONTACT_FULL_NAME,
            self::CONTACT_FIRST_NAME,
            self::CONTACT_LAST_NAME,
            self::CONTACT_DOB,
            self::CONTACT_SSN,
            self::CONTACT_RES_COMPLETE_ADDRESS,
            self::CONTACT_STREET_ADDRESS,
            self::CONTACT_CITY,
            self::CONTACT_STATE,
            self::CONTACT_ZIPCODE,
            self::RECIPIENT_CURRENT_DATE,
            self::RECIPIENT_ITEM_LIST,
            self::RECIPIENT_ITEM_LIST_WITH_INSTRUCTION,
            self::RECIPIENT_RES__ADDRESS,
            self::RECIPIENT_STREET_ADDRESS,
            self::RECIPIENT_CITY,
            self::RECIPIENT_STATE,
            self::RECIPIENT_ZIPCODE
        ];
    }
}
