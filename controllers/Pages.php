<?php

class Pages extends Controller {

private $pageModel;



  public function __construct() {
    $this->pageModel = $this->model('page');
   
}


public function index()
{

$users=$this->pageModel->listUser();

$data=['users'=> $users];


$this->view('main/index',$data);

}







}