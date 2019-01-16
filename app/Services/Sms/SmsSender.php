<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 15.01.19
 * Time: 18:57
 */

namespace App\Services\Sms;


interface SmsSender
{
    public function send($number, $text): void;
}
