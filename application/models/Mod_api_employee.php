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
    //$this->db->where('active',true);

    $query = $this->db->get('ctesystem.employee_view')->result_array();
    if (count($query)>0) {
        foreach($query as $rows){
            $data = array();
            $data['nik'] = $rows['nik'];
            $data['name'] = $rows['fullname'];
            $data['department_code'] =$rows['dept_code']; 
            $data['department_label'] =$rows['dept_label']; 
            $data['position_code'] = $rows['occupation_code'];
            $data['position_label'] = $rows['occupation_label'];
            $data['active'] = $rows['active'];
        }
        $response[]=$data;
        return $response;
    }else{
        return false;
    }
  
 }
 public function valid_nik($nik){
    $this->db->where('nik',$nik);
    $query = $this->db->get('ctesystem.employee_view')->num_rows();
    if($query>0){
        return true;
    }else{
        return false;
    }
 }

 public function get_employee_empty(){
    $data = array();
    $data['nik'] = '-';
    $data['name'] = '-';
    $data['department_code'] ='-'; 
    $data['department_label'] ='-'; 
    $data['position_code'] = '-';
    $data['position_label'] = '-';
    $data['active'] = '-';
    $response[]=$data;
    return $response;

 }
}
