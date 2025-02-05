<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
echo "View loaded successfully.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Server Time</title>
</head>
<body>
    <h1>Welcome to the Main Page</h1>
    <?php if (isset($data)): ?>
        <p>Server Time: <?php echo $data['serverTime']; ?></p>
        <p>Server Year: <?php echo $data['serverYear']; ?></p>
        <p>Server Month: <?php echo $data['serverMonth']; ?></p>
        <p>Server Day: <?php echo $data['serverDay']; ?></p>
        <p>Current Season: <?php echo $data['currentSeason']; ?></p>
    <?php else: ?>
        <p>No data received.</p>
    <?php endif; ?>
</body>
</html>