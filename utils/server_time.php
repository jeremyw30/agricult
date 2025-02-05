<?php
// Define constants
define('REAL_TO_SERVER_RATIO', 7); // 1 real day = 7 server days
define('DAYS_IN_MONTH', 30);
define('DAYS_IN_SEASON', 90);
// Set locale to ensure date parsing works correctly
setlocale(LC_TIME, 'fr_FR.UTF-8');

function getServerTime() {
    // Get the current real time
    $realTime = time();

    // Define the base date
    $baseDateStr = "01-02-2025 00:00:00";
    $baseDate = DateTime::createFromFormat('d-m-Y H:i:s', $baseDateStr);
    if ($baseDate === false) {
        die('Error: Invalid base date');
    }

    // Calculate the number of real days that have passed since the base date
    $baseTimestamp = $baseDate->getTimestamp();
    $realDaysPassed = ($realTime - $baseTimestamp) / (60 * 60 * 24);

    // Calculate the number of server days
    $serverDays = $realDaysPassed * REAL_TO_SERVER_RATIO;
    $serverDays = round($serverDays); // Round to the nearest integer

    // Add server days to the base date
    $baseDate->modify("+$serverDays days");
    $serverTime = $baseDate->getTimestamp();

    // Debugging output
    echo "Real Time: $realTime<br>";
    echo "Real Days Passed: $realDaysPassed<br>";
    echo "Server Days: $serverDays<br>";
    echo "Base Timestamp: $baseTimestamp<br>";
    echo "Server Time: $serverTime<br>";

    // Check if serverTime is correctly calculated
    if ($serverTime === false) {
        die('Error: Invalid server time calculation');
    }

    // Calculate server date components
    $serverYear = date('Y', $serverTime);
    $serverMonth = date('m', $serverTime);
    $serverDay = date('d', $serverTime);
    $serverHour = date('H', $serverTime);
    $serverMinute = date('i', $serverTime);

    // Determine the current season
    $serverDayOfYear = date('z', $serverTime) + 1; // Day of the year (1-365)
    $seasonNumber = ceil($serverDayOfYear / DAYS_IN_SEASON);

    $seasons = ['Hiver', 'Printemps', 'Eté', 'Automne'];
    $currentSeason = $seasons[($seasonNumber - 1) % 4];

    return [
        'serverYear' => $serverYear,
        'serverMonth' => $serverMonth,
        'serverDay' => $serverDay,
        'serverHour' => $serverHour,
        'serverMinute' => $serverMinute,
        'currentSeason' => $currentSeason,
        'serverTime' => date('Y-m-d H:i', $serverTime)
    ];
}
// Demander à denis , sur la video ..a la minute 8.19