<?php
// filepath: /c:/laragon/www/agricult/utils/server_time.php
// Define constants
define('REAL_TO_SERVER_RATIO', 4); // 1 real day = 4 server days
define('DAYS_IN_MONTH', 30);
define('DAYS_IN_SEASON', 90);
// Set locale to ensure date parsing works correctly
setlocale(LC_TIME, 'fr_FR.UTF-8');

// Define weather coefficients and temperature ranges for each season
$weatherCoefficients = [
    'Hiver' => ['soleil' => 2, 'pluie' => 3, 'neige' => 5, 'brouillard' => 2, 'minTemp' => -10, 'maxTemp' => 5],
    'Printemps' => ['soleil' => 6, 'pluie' => 3, 'neige' => 0, 'brouillard' => 1, 'minTemp' => 5, 'maxTemp' => 15],
    'Eté' => ['soleil' => 8, 'pluie' => 2, 'neige' => 0, 'brouillard' => 0, 'minTemp' => 15, 'maxTemp' => 30],
    'Automne' => ['soleil' => 4, 'pluie' => 4, 'neige' => 1, 'brouillard' => 3, 'minTemp' => 0, 'maxTemp' => 10]
];

function getServerTime() {
    global $weatherCoefficients;

    // Get the current real time
    $realTime = time();

    // Define the base date
    $baseDateStr = "01-01-2025 01:01:01";
    $baseDate = DateTime::createFromFormat('d-m-Y H:i:s', $baseDateStr);
    if ($baseDate === false) {
        die('Error: Invalid base date');
    }

    // Calculate the number of real seconds that have passed since the base date
    $baseTimestamp = $baseDate->getTimestamp();
    $realSecondsPassed = $realTime - $baseTimestamp;

    // Calculate the number of server seconds
    $serverSeconds = $realSecondsPassed * REAL_TO_SERVER_RATIO;

    // Add server seconds to the base date
    $baseDate->modify("+$serverSeconds seconds");
    $serverTime = $baseDate->getTimestamp();

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

    // Determine if it is day or night
    $isDay = generateDayNight($currentSeason, $serverHour);

    // Determine the weather condition and temperature
    $weather = determineWeather($currentSeason, $isDay);
    $temperature = generateTemperature($currentSeason, $weather, $isDay);

    return [
        'serverTime' => date('d-m-Y H:i', $serverTime),
        'serverYear' => $serverYear,
        'serverMonth' => $serverMonth,
        'serverDay' => $serverDay,
        'serverHour' => $serverHour,
        'serverMinute' => $serverMinute,
        'currentSeason' => $currentSeason,
        'weather' => $weather,
        'temperature' => $temperature,
        'isDay' => $isDay
    ];
}

function determineWeather($season, $isDay) {
    global $weatherCoefficients;

    $coefficients = $weatherCoefficients[$season];
    $totalCoeff = $coefficients['soleil'] + $coefficients['pluie'] + $coefficients['neige'] + $coefficients['brouillard'];
    $weather = rand(1, $totalCoeff);

    if ($isDay) {
        if ($weather <= $coefficients['soleil']) {
            return 'soleil';
        } elseif ($weather <= $coefficients['soleil'] + $coefficients['pluie']) {
            return 'pluie';
        } elseif ($weather <= $coefficients['soleil'] + $coefficients['pluie'] + $coefficients['brouillard']) {
            return 'brouillard';
        } else {
            return 'neige';
        }
    } else {
        if ($weather <= $coefficients['pluie']) {
            return 'pluie';
        } elseif ($weather <= $coefficients['pluie'] + $coefficients['brouillard']) {
            return 'brouillard';
        } else {
            return 'neige';
        }
    }
}

function generateTemperature($season, $weather, $isDay) {
    global $weatherCoefficients;

    $coefficients = $weatherCoefficients[$season];
    $baseTemp = rand($coefficients['minTemp'], $coefficients['maxTemp']);

    // Adjust temperature based on weather condition
    switch ($weather) {
        case 'soleil':
            $baseTemp += 5;
            break;
        case 'pluie':
            $baseTemp -= 5;
            break;
        case 'brouillard':
            $baseTemp -= 2;
            break;
        case 'neige':
            $baseTemp = $baseTemp; // No change for neige
            break;
    }

    // Adjust temperature based on time of day
    if ($isDay) {
        $baseTemp += 3; // Daytime adjustment
    } else {
        $baseTemp -= 3; // Nighttime adjustment
    }

    return $baseTemp;
}

function generateDayNight($season, $hour) {
    switch ($season) {
        case 'Hiver': // Winter
            return ($hour >= 8 && $hour < 17);
        case 'Printemps': // Spring
            return ($hour >= 6.5 && $hour < 20);
        case 'Eté': // Summer
            return ($hour >= 5.5 && $hour < 21.5);
        case 'Automne': // Autumn
            return ($hour >= 7 && $hour < 18.5);
        default:
            return false;
    }
}