
<div id="server-time-box">
    <div class="card">
        <div class="card-header">
            <h4>Météo</h4>
        </div>
        <div class="card-body">
            <img id="currentSeasonImage" src="" alt="Current Season">
            <p id="seasonText"></p>
            <p>Date: <span id="serverTime"></span></p>
            <div class="meteo">
                <div class="meteo-left">
                    <img id="currentDay" src="" alt="Current Day">
                    <p id="textDay"></p>
                </div>
                <div class="meteo-right">
                    <img id="weatherImage" src="" alt="Météo">
            
                    <p id="weather"></p>
                </div>
            </div>
           
            
            <p>Température: <span id="temperature"></span>°C</p>
        </div>
    </div>
</div>

<script>
    const ROOT = '<?php echo WWW_ROOT; ?>';
    console.log(ROOT)
    const STORAGE_KEY = 'serverTimeData';
    const EXPIRATION_TIME = 3 * 60 * 60 * 1000; // 3 hours in milliseconds

    function updateServerTime(data) {
        document.getElementById('serverTime').innerText = data.serverTime;
        document.getElementById('weather').innerText = data.weather;
        document.getElementById('temperature').innerText = data.temperature;
        document.getElementById('textDay').innerText = data.isDay ? 'Jour' : 'Nuit';
        document.getElementById('seasonText').innerText = data.currentSeason;

        const dayImage = document.getElementById('currentDay');
        if (data.isDay){
            dayImage.src = ROOT + 'public/image/day.png';
                dayImage.alt = 'jour';
        } else {
            dayImage.src = ROOT + 'public/image/night.png';
                dayImage.alt = 'nuit'; 
        }

        const seasonImage = document.getElementById('currentSeasonImage');
        switch (data.currentSeason) {
            case 'Hiver':
                seasonImage.src = ROOT + 'public/image/hiver.png';
                seasonImage.alt = 'Hiver';
                break;
            case 'Printemps':
                seasonImage.src = ROOT + 'public/image/printemps.png';
                seasonImage.alt = 'Printemps';
                break;
            case 'Eté':
                seasonImage.src = ROOT + 'public/image/ete.png';
                seasonImage.alt = 'Eté';
                break;
            case 'Automne':
                seasonImage.src = ROOT + 'public/image/automne.png';
                seasonImage.alt = 'Automne';
                break;
            default:
                seasonImage.src = '';
                seasonImage.alt = 'Unknown Season';
                break;
        }
     
        const weatherImage = document.getElementById('weatherImage');
        switch (data.weather) {
            case 'soleil':
                weatherImage.src = ROOT + 'public/image/sun.png';
                weatherImage.alt = 'Soleil';
                break;
            case 'pluie':
                weatherImage.src = ROOT + 'public/image/rain.png';
                weatherImage.alt = 'Pluie';
                break;
            case 'brouillard':
                weatherImage.src = ROOT + 'public/image/fog.png';
                weatherImage.alt = 'Brouillard';
                break;
            case 'neige':
                weatherImage.src = ROOT + 'public/image/snow.png';
                weatherImage.alt = 'Neige';
                break;
            default:
                weatherImage.src = '';
                weatherImage.alt = 'Unknown Season';
                break;
        }
        
    }

    function fetchServerTime() {
        fetch('/agricult/times/index')
            .then(response => response.json())
            .then(data => {
                updateServerTime(data);
                saveToLocalStorage(data);
            })
            .catch(error => console.error('Error fetching server time data:', error));
    }

    function saveToLocalStorage(data) {
        const dataWithTimestamp = {
            ...data,
            timestamp: Date.now()
        };
        localStorage.setItem(STORAGE_KEY, JSON.stringify(dataWithTimestamp));
    }

    function loadFromLocalStorage() {
        const storedData = localStorage.getItem(STORAGE_KEY);
        if (storedData) {
            const data = JSON.parse(storedData);
            if (Date.now() - data.timestamp < EXPIRATION_TIME) {
                return data;
            } else {
                localStorage.removeItem(STORAGE_KEY);
            }
        }
        return null;
    }

    function initializeServerTime() {
        const data = loadFromLocalStorage();
        if (data) {
            updateServerTime(data);
        } else {
            fetchServerTime();
        }
    }

    // Initial update on page load
    document.addEventListener('DOMContentLoaded', initializeServerTime);

setInterval(fetchServerTime,10800000);
</script>

