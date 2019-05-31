<?php

namespace App\Services;


use App\Services\Contracts\CustomServiceInterface;

class DateCheckNew implements CustomServiceInterface
{

    public function isValid($strDate, $strFormat = "d/m/Y", $str_timezone = FALSE)
    {
        $date = \DateTime::createFromFormat($strFormat, $strDate);

        if ($date && (int)$date->format('Y') < 1900) {
            return false;
        }

        return $date && \DateTime::getLastErrors()["warning_count"] == 0;
    }

    public function test()
    {
        return 555;
    }


}