<div id="server-time-box">
    <div class="card">
        <div class="card-header">
            <h2>Météo</h2>
        </div>
        <div class="card-body">
            <img id="currentSeasonImage" src="<?php echo ROOT . '/public/image/' . strtolower($currentSeason) . '.png'; ?>" alt="<?php echo $currentSeason; ?>">
            <p id="seasonText"><?php echo $currentSeason; ?></p>
            <p>Date: <span id="serverTime"><?php echo $serverTime; ?></span></p>
            <img id="currentDay" src="<?php echo ROOT . '/public/image/' . ($isDay ? 'day' : 'night') . '.png'; ?>" alt="<?php echo $isDay ? 'jour' : 'nuit'; ?>">
            <p id="textDay"><?php echo $isDay ? 'Jour' : 'Nuit'; ?></p>
            <img id="weatherImage" src="<?php echo ROOT . '/public/image/' . strtolower($weather) . '.png'; ?>" alt="<?php echo $weather; ?>">
            <p id="weather"><?php echo $weather; ?></p>
            <p>Température: <span id="temperature"><?php echo $temperature; ?></span>°C</p>
</div>
    </div>
</div>