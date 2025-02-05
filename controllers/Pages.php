<?php

require_once ROOT . 'utils/server_time.php';

class Pages extends Controller {

    private $pageModel;

    public function __construct() {
        $this->pageModel = $this->model('page');
    }

    public function index() {
        $serverTimeData = getServerTime();
        $data = [
            'serverTime' => $serverTimeData['serverTime'],
            'serverYear' => $serverTimeData['serverYear'],
            'serverMonth' => $serverTimeData['serverMonth'],
            'serverDay' => $serverTimeData['serverDay'],
            'currentSeason' => $serverTimeData['currentSeason']
        ];

        $this->view('main/index', $data);
    }
}