<?php
// Define constants
define('REAL_TO_SERVER_RATIO', 30 / 7); // 30 server days in 7 real days
define('DAYS_IN_MONTH', 30);
define('DAYS_IN_SEASON', 90);
// Set locale to ensure date parsing works correctly
setlocale(LC_TIME, 'fr_FR.UTF-8');

// Get the current real time
$realTime = time();

// Calculate the server time
$serverDays = ($realTime / (60 * 60 * 24)) * REAL_TO_SERVER_RATIO;
$baseDateStr = "01-01-2025";
$baseDate = DateTime::createFromFormat('d-m-Y', $baseDateStr);
if ($baseDate === false) {
    die('Error: Invalid base date');
}

$baseTimestamp = $baseDate->getTimestamp();
$serverTime = strtotime("+$serverDays days", $baseTimestamp);

// Check if serverTime is correctly calculated
if ($serverTime === false) {
    die('Error: Invalid server time calculation');
}


// Calculate server date components
$serverYear = date('Y', $serverTime);
$serverMonth = date('m', $serverTime);
$serverDay = date('d', $serverTime);

// Determine the current season
$serverDayOfYear = date('z', $serverTime) + 1; // Day of the year (1-365)
$seasonNumber = ceil($serverDayOfYear / DAYS_IN_SEASON);

$seasons = ['Hiver', 'Printemps', 'Eté', 'Automne'];
$currentSeason = $seasons[($seasonNumber - 1) % 4];

// Output the server time and season as JSON
header('Content-Type: application/json');
echo json_encode([
    'serverYear' => $serverYear,
    'serverMonth' => $serverMonth,
    'serverDay' => $serverDay,
    'currentSeason' => $currentSeason
]);
?>