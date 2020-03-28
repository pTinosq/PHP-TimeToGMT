<?php
/*
 * Arguments
 *
 * $tz = integer or float value from -12 to 13. Only accepts 0 decimal places (e.g 6) or x.5 (e.g 6.5)
 * This argument states the difference in hours from GMT
 *
 * $time = non-GMT time in format "hh:mm"
 * This argument states the time that you want to convert to GMT
*/

function convertGMT($tz, $time)
{

    // Separate hours and minutes
    $hours = intval(explode(":", $time)[0]);
    $minutes = intval(explode(":", $time)[1]);

    // Check if difference is x.5
    if (strpos(strval($tz), ".") === false) {
        // Has no decimal place
        $tempmins = $minutes;
        $tz = intval($tz);
    } else {
        // Contains x.5 difference
        $tz = intval($tz);

        // For negative time zones
        if ($tz < 0) {
            $tempmins = $minutes - 30;
        }

        // For positive time zones
        else {
            $tempmins = $minutes + 30;
        }

        // Converts minutes above 60 and below 0 to change hour value
        // Example: $times = 15:23; $tz = -3.5; = 11:53 instead of 12:-7
        if ($tempmins >= 60) {
            $tempmins = $tempmins - 60;
            $hours = $hours + 1;
        }
        if ($tempmins < 0) {
            $tempmins = 60 + $tempmins;
            $hours = $hours - 1;
        }
    }

    // If timezone goes before midnight
    if (($hours + $tz) < 0) {
        $x = $hours + $tz;
        $hours = 24 + $x;
    } else {
        $hours = $hours + $tz;
    }

    // If timezone goes above midnight
    if ($hours > 24) {
        $hours = $hours - 24;

    }

    // Fixes hh:mm formatting
    // Example: 15:2 becomes 15:02
    if (strlen(strval($hours)) == 1) {
        $hours = '0' . strval($hours);
    }
    if (strlen(strval($tempmins)) == 1) {
        $tempmins = '0' . strval($tempmins);
    }

    $hours = strval($hours);
    $tempmins = strval($tempmins);

    $toreturn = $hours . ":" . $tempmins;

    // Returns "hh:mm"
    return $toreturn;

}

// Examples

echo convertGMT("6","00:23"); // 06:23
echo convertGMT("-3.5","08:23"); // 04:53


?>