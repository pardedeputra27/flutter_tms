<?php
class Mod_api_employee extends CI_Model
{
 public function get_employee($nik){
    if ($nik!==null) {
        if($this->valid_nik($nik)){
            $this->db->where('nik',$nik);
        }else{
            return false;
            exit;
        }
        
    }
    $this->db->where('active',true);

    $query = $this->db->get('hr.v_employee')->result_array();
    if (count($query)>0) {
        return $query;
    }else{
        return false;
    }
  
 }
 public function valid_nik($nik){
    $this->db->where('nik',$nik);
    $query = $this->db->get('hr.v_employee')->num_rows();
    if($query>0){
        return true;
    }else{
        return false;
    }
 }

 public function get_employee_empty(){
    $data = array();
    $data['id'] = '-';
    $data['nik'] = '-';
    $data['name'] = '-';
    $data['email'] = '-';
    $data['department_id'] ='-'; 
    $data['department_code'] ='-'; 
    $data['department_label'] ='-'; 
    $data['position_id'] = '-';
    $data['position_code'] = '-';
    $data['position_label'] = '-';
    $data['active'] = '-';
    $data['user_active'] = '-';
    $response[]=$data;
    return $response;

 }
}
