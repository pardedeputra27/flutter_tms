<?php  

class Coba extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mod_api_attendance','model');
    }

    public function index(){
        echo $this->model->minus_break_time('08:00','17:00');
    }
}