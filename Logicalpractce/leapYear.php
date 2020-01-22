<?php

function leapYear($year)
{
    if ($year % 4) {
        echo "$year is not a Leap year";
    } else if ($year % 100) {
        echo "$year is Leap year";
    } else if ($year % 400) {
        echo "$year is not a leap year";
    } else {
        echo "$year is  a leap year";
    }
}

leapYear(1800);
