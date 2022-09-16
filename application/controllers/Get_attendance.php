<?php
 
require (APPPATH.'/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;
 
class Get_attendance extends REST_Controller{
     
    public function __construct(){
        parent::__construct();
        $this->load->model('Mod_api_attendance','model');
    }
     
    public function index_get(){
        //input
        $nik = $this->get('nik');
        $CodeDate= (int) $this->get('periode');
       
        //Get Response
        $response = $this->model->get_Attendance($nik,$CodeDate);
        $noData = $this->model->get_empty_data();
  
            if($response){
                $this->response($response,REST_Controller::HTTP_OK);
            }else{
                $this->response($noData,REST_Controller::HTTP_OK);
            }
        }



}





