<?php

namespace App\Helpers;

class BookingFormatter
{
    /**
     * Format a booking count into a human-readable string.
     *
     * @param  int  $count
     * @return string
     */
    public static function format($count)
    {
        if ($count >= 1000000) {
            return floor($count / 1000000) . ' jt+';
        } elseif ($count >= 1000) {
            return floor($count / 1000) . ' rb+';
        } elseif ($count >= 100) {
            return ceil($count / 100) * 100 . '+';
        } else {
            return $count;
        }
    }
}
