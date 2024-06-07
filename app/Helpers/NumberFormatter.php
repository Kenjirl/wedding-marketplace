<?php

namespace App\Helpers;

class NumberFormatter
{
    /**
     * Format a number into a human-readable string.
     *
     * @param  int  $number
     * @return string
     */
    public static function format($number)
    {
        if ($number >= 1000000) {
            return round($number / 1000000, 1) . ' jt';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . ' rb';
        } else {
            return (string) $number;
        }
    }
}
