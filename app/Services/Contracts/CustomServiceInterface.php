<?php
namespace App\Services\Contracts;

Interface CustomServiceInterface
{
public function isValid($strDate, $strFormat , $str_timezone);

public function test();

}