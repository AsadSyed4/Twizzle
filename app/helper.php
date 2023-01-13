<?php

use Illuminate\Support\Carbon;
date_default_timezone_set("Asia/Karachi");
if (!function_exists('pre')) {
    function pre($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}

if (!function_exists('formatted_date')) {
    function formatted_date($date, $formate)
    {
        return date($formate, strtotime($date));
    }
}
if (!function_exists('time_diffrence')) {
    function time_diffrence($date)
    {
        $date2 = new Carbon("now");
        $date1 = new Carbon($date);
        $diffInms = $date1->diff($date2);
        return substr($diffInms->format('%R%a days'),1);
    }
}

if (!function_exists('date_separate')) {
    function date_separate($date){
        $date_separate=explode(" ", $date);
        return $date_separate[0];
    }
}

if (!function_exists('cut_string')) {
    function cut_string($text,$limit){
        return substr($text, 0,$limit );
    }
}
