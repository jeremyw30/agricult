<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main Page</title>
    <link rel="stylesheet" href="<?php echo WWW_ROOT; ?>/public/styles/style.css">

</head>
<body>
    <h1>Welcome to the Main Page</h1>
    <?php
    // Start output buffering
    ob_start();
    require_once ROOT ."controllers/Times.php";
    // Call the Time controller's index method
    $timeController = new Time();
    $timeController->index();
    
    // Get the output and clean the buffer
    $serverTimeBox = ob_get_clean();
    
    // Include the output in the view
    echo $serverTimeBox;
    ?>
</body>
</html>