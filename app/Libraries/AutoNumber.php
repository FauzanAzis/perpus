<?php
/**
 * Created by PhpStorm.
 * User: PBM09061502
 * Date: 25/10/2018
 * Time: 14:23
 */

namespace App\Libraries;


trait AutoNumber
{
    public static function generateNumber($sumber_text)
    {
        $lastRecort = self::orderBy('created_at', 'desc')->first();
        $prefix = strtoupper($sumber_text[0]) ;
        $primary_key = (new self)->getKeyName();

        if ( ! $lastRecort )
            $number = 0;
        else {
            $field = $lastRecort->{$primary_key} ;
            if ($prefix[0] == $lastRecort->{$primary_key}[0]){
                $number = substr($field, 1);
            }else {
                $number = 0;
            }
        }

        return  $prefix . sprintf('%06d', intval($number) + 1);
    }
}