<?php
 
require (APPPATH.'/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;
 
class Get_employee extends REST_Controller{
     
    public function __construct(){
        parent::__construct();
        $this->load->model('Mod_api_employee','model');
    }
     
    public function index_get(){
        //input
        $nik = $this->get('nik');

        $response = $this->model->get_employee($nik);
        $noData = $this->model->get_employee_empty();
       
        if($response){
            $this->response($response,REST_Controller::HTTP_OK);
        }else{
            $this->response($noData,REST_Controller::HTTP_OK);
        }
    }


    public function coba_get(){
        print_r($this->model->coba());
    }
}





