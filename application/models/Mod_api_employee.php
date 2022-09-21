<?php
class Mod_api_employee extends CI_Model
{
 public function get_employee($nik){
    if ($nik!==null ) {
        if ($this->valid_nik($nik)) {
            $this->db->where('nik',$nik);
        }else{
            return false;
            exit;
        }
        
    }
    //$this->db->where('active',true);
    $this->db->limit(100);
    $this->db->order_by('active','DESC');
    $query = $this->db->get('ctesystem.employee_view')->result_array();

    
    if (count($query)>0) {
        $response=array();
        foreach($query as $row){
            $data = array();
            $data['nik'] = $row['nik']?$row['nik']:'-';
            $data['name'] = $row['fullname']?$row['fullname']:'-';
            $data['department_code'] =$row['dept_code']?$row['dept_code']:'-'; 
            $data['department_label'] =$row['dept_label']?$row['dept_label']:'-'; 
            $data['position_code'] = $row['occupation_code']?$row['occupation_code']:'-';
            $data['position_label'] = $row['occupation_label']?$row['occupation_label']:'-';
            $data['active'] = $row['active']?$row['active']:'-';
            $response[]=$data;
        } 
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


 function coba(){
    return $this->db->get('ctesystem.employee_view')->result_array() ; 
 }
}
