<?php

// format currency
function currency_format($number, $suffix = 'đ'){
    return number_format($number).$suffix;
}

// format date
function format_weekday($weekday)
{
    $weekday_vnm = array(
        "Monday"    => "Thứ 2",
        "Tuesday"   => "Thứ 3",
        "Wednesday" => "Thứ 4",
        "Thursday"  =>  "Thứ 5",
        "Friday"    => "Thứ 6",
        "Saturday"  => "Thứ 7",
        "Sunday"    => "Chủ nhật"
    );
    return $weekday_vnm[$weekday];
}