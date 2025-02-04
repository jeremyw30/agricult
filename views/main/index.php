<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>home</h1>
  <div id="server-time"></div>
  <div id="server-season"></div>
  <script>
        function fetchServerTime() {
            fetch('utils/server_time.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('server-time').innerText = `Date serveur: Année ${data.serverYear}, Mois ${data.serverMonth}, Jour ${data.serverDay}`;
                    document.getElementById('server-season').innerText = `Saison actuelle: ${data.currentSeason}`;
                })
                .catch(error =>console.error("erreur pour obtenir le temps serveur:",error));

}

        // Fetch server time on page load
        window.onload = fetchServerTime;
    </script>






</body>
</html>