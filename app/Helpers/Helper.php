<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * Format response.
 */
class Helper
{

    public static function dateFormat($date)
    {
        $date = Carbon::parse($date)->locale('id');

        $date->settings(['formatFunction' => 'translatedFormat']);

        return $date->format('j F Y');
    }
}
