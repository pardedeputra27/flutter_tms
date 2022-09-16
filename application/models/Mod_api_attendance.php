<?php
Class Mod_api_attendance extends CI_Model
{
 
   public function get_Attendance($nik,$codeDate)
   {
      $year = date("Y");
      $nextYear=date('Y', strtotime('+1 year'));
      $beforeYear=date('Y', strtotime('-1 year'));
      switch ($codeDate) {
         //before Year
         case -1:  $date1 =$beforeYear.'-01-16';$date2 = $beforeYear.'-02-15';break;
         case -2:  $date1 =$beforeYear.'-02-16';$date2 = $beforeYear.'-03-15';break;
         case -3:  $date1 =$beforeYear.'-03-16';$date2 = $beforeYear.'-04-15';break;
         case -4:  $date1 =$beforeYear.'-04-16';$date2 = $beforeYear.'-05-15';break;
         case -5:  $date1 =$beforeYear.'-05-16';$date2 = $beforeYear.'-06-15';break;
         case -6:  $date1 =$beforeYear.'-06-16';$date2 = $beforeYear.'-07-15';break;
         case -7:  $date1 =$beforeYear.'-07-16';$date2 = $beforeYear.'-08-15';break;
         case -8:  $date1 =$beforeYear.'-08-16';$date2 = $beforeYear.'-09-15';break;
         case -9:  $date1 =$beforeYear.'-09-16';$date2 = $beforeYear.'-10-15';break;
         case -10: $date1 =$beforeYear.'-10-16';$date2 = $beforeYear.'-11-15';break;
         case -11: $date1 =$beforeYear.'-11-16';$date2 = $beforeYear.'-12-15';break;
         case -12: $date1 =$beforeYear.'-12-16';$date2 = $year.'-01-15';break;
         //This Year
         case 1:  $date1 =$year.'-01-16';$date2 = $year.'-02-15';break;
         case 2:  $date1 =$year.'-02-16';$date2 = $year.'-03-15';break;
         case 3:  $date1 =$year.'-03-16';$date2 = $year.'-04-15';break;
         case 4:  $date1 =$year.'-04-16';$date2 = $year.'-05-15';break;
         case 5:  $date1 =$year.'-05-16';$date2 = $year.'-06-15';break;
         case 6:  $date1 =$year.'-06-16';$date2 = $year.'-07-15';break;
         case 7:  $date1 =$year.'-07-16';$date2 = $year.'-08-15';break;
         case 8:  $date1 =$year.'-08-16';$date2 = $year.'-09-15';break;
         case 9:  $date1 =$year.'-09-16';$date2 = $year.'-10-15';break;
         case 10: $date1 =$year.'-10-16';$date2 = $year.'-11-15';break;
         case 11: $date1 =$year.'-11-16';$date2 = $year.'-12-15';break;
         //next Years
         case 12: $date1 =$year.'-12-16';$date2 = $nextYear.'-01-15';break;
         //default
         default:$date1 =date('Y-m-d',strtotime('-3 days'));$date2 =date('Y-m-d');break;
      }
       
      if($nik !== null){
         if($this->valid_nik($nik)){//checking nik
            $query = $this->db->query("SELECT * FROM hr.get_employee_attendance('$date1'::date,'$date2'::date) WHERE nik = '$nik' ORDER BY date asc ")->result_array();
         }else{
               return false;
               exit;
         }  
      }else{
         $query = $this->db->query("SELECT * FROM hr.get_employee_attendance('$date1'::date,'$date2'::date) ORDER BY date asc  LIMIT 100 ")->result_array();
      }


      if (count($query) > 0) {
         $response = array();
         $response['error'] = false;
         $response['message'] = 'Success Get Attendance Detail ';

         $total_meal=0;
         $total_transport=0;
         foreach ($query as $row) {
            $hours = $this->minus_break_time($row['time_in'],$row['time_out']);
            $meal = $this->meal($hours);

            $data = array();
            $data['date'] = $row['date']              ?$row['date']:'-';
            $data['nik'] =$row['nik']                 ?$row['nik']:'-';
            $data['name'] =$row['fullname']           ?$row['fullname']:'-';
            $data['department'] =$row['dept_label']   ?$row['dept_label']:'-';
            $data['jabatan'] =$row['jabatan_label']   ?$row['jabatan_label']:'-';
            $data['shift'] =$row['shift_in'].'-'.$row['shift_out'];
            $data['date_in']=$row['date_in']          ?'Present':"-";
            $data['time_in']=$row['time_in']          ?$row['time_in']:'-';
            $data['time_out']=$row['time_out']        ?$row['time_out']:'-';
            $data['meal']=$row['time_out']?$meal:'-'; 
            $data['transport']=$row['time_out']?"1":'-'; 
            $data['hours']= $hours;
            $data['break']=$row['time_out']?"01:00":'00:00'; 
            $data['absent'] =$row['absent_label']     ?$row['absent_label']:'-';
            $response['data'][] = $data;

            $total_hours[]=$data['hours'];
            $total_break[]=$data['break'];
            if($data['meal']!=='-'){
               $total_meal += (int)$data['meal'];
            }
            if($data['transport']!=='-'){
               $total_transport += (int)$data['transport'];
            }
         }
            $total['total_meal']= $total_meal;
            $total['total_transport']=$total_transport;
            $total['total_hours']= $this->total_hours($total_hours);
            $total['total_break']=$this->total_hours($total_break);
            $response['total'][]=$total;
         return $response;
      }
      return false;
   }
   public function get_empty_data(){
   
      $response                  = array();
      $response['error']         = false;
      $response['message']       = 'Empty Attendance';
         $data['date']           ='-';
         $data['nik']            ='-';
         $data['name']           ='-';
         $data['department']     ='-';
         $data['jabatan']        ='-';
         $data['shift']          ='-';
         $data['date_in']        ='-';
         $data['time_in']        ='-';
         $data['time_out']       ='-';
         $data['meal']           ='-'; 
         $data['transport']      ='-'; 
         $data['hours']          = '-';
         $data['break']          ='-'; 
         $data['absent']         ='-';
      $response['data'][]        = $data;
      $total['total_meal']       = 0;
      $total['total_transport']  = 0;
      $total['total_hours']      = '-';
      $total['total_break']      ='-';
      $response['total'][]       =$total;

      return $response;

   }

   function minus_break_time($timeIn,$timeOut){
      if($timeIn===null or $timeOut ===null)
      {
         return '00:00';
      }else{
         $firstTime=strtotime($timeIn);
         $lastTime=strtotime($timeOut); 
         $break=1;
         $perbedaan_waktu =1;
         //str to time itu mengembalikan nilai default datenya (perbedaannya 1 jam)
         $time=$lastTime-$firstTime-(3600*($break+$perbedaan_waktu));
         $formatdate=date("H:i", $time);

         return $formatdate;
         
      }

      
   }

   public function meal($hours){
      $ada= strtotime($hours);
      $dblMeal= strtotime('11:00:00');
      if ($ada > $dblMeal) {
         return '2';
      }else{
         return '1';
      }
   }

   public function total_hours($total_hours) {
      $minutes = 0; 
      foreach ($total_hours as $time) {
          list($hour, $minute) = explode(':', $time);
          $minutes += $hour * 60;
          $minutes += $minute;
      }
      $hours = floor($minutes / 60);
      $minutes -= $hours * 60;
      return sprintf('%02d:%02d', $hours, $minutes);
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


}