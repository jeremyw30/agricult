<?php

require_once ROOT . 'utils/server_time.php';

class Times extends Controller {
    

    public function index() {
        $serverTimeData = getServerTime();
        $data = [
            'serverTime' => $serverTimeData['serverTime'],
            'serverYear' => $serverTimeData['serverYear'],
            'serverMonth' => $serverTimeData['serverMonth'],
            'serverDay' => $serverTimeData['serverDay'],
            'serverHour' => $serverTimeData['serverHour'],
            'serverMinute' => $serverTimeData['serverMinute'],
            'currentSeason' => $serverTimeData['currentSeason'],
            'weather' => $serverTimeData['weather'],
            'temperature' => $serverTimeData['temperature'],
            'isDay' => $serverTimeData['isDay']
        ];    

        $this->view('components/server_time_box',$data);
    }

    
}