<?php



class Pages extends Controller {

    private $pageModel;

    public function __construct() {
        $this->pageModel = $this->model('page');
    }

    public function index() {
        

        $this->view('main/index');

    }

    
}