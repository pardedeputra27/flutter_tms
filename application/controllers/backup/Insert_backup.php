<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insert_backup extends CI_Controller {
	private $db2; 

	public function __construct()
    {
    parent::__construct();
    $this->db2 = $this->load->database('backup_record', TRUE);
    } 
	public function index()
	{

		if(!$this->input->is_cli_request()){
				show_error('You must be access via command lane.');
				exit;
		}
		
		$thisDate = date('Y-m-d');
		if ($this->isWeekend($thisDate) || $this->isHoliday($thisDate)) {
			echo 'This Weekend or Holiday ';
		}else{
			if(!$this->isExist($thisDate)){
				$this->insertData($thisDate);
				echo "Input backup ".$thisDate." berhasil !";
				$this->updateTape();
			}else{
				echo 'Data Exist';
			}
			

		
		}
		
	}
	
	private function insertData($date){
		$query="INSERT INTO backup (date, tape, type, status) VALUES ('$date','-', 'D', 'Ok')";
		$this->db2->query($query);

	}

	private function isExist($date){
		$check = $this->db2->query(" SELECT * FROM backup WHERE date ='$date' ")->num_rows();
		return ($check > 0);

	}

	public function updateTape(){
		$date = $this->db2->query(" SELECT * FROM backup WHERE tape not in ('1','2','3','4','5') AND type != 'F' ")->result_array();
		if($date == null){
			//echo 'No Data';
			return;
		 }

		 //echo 'oke';
		 foreach($date as $row){
			$date =date('N', strtotime($row['date']));
			switch ($date) {
				case '1':
					$query="UPDATE backup SET tape = '1' WHERE date = ' ".$row['date']." ' ";
					break;
				case '2':
					$query="UPDATE backup SET tape = '2' WHERE date = ' ".$row['date']." ' ";
					break;
				case '3':
					$query="UPDATE backup SET tape = '3' WHERE date = ' ".$row['date']." ' ";
					break;
				case '4':
					$query="UPDATE backup SET tape = '4' WHERE date = ' ".$row['date']." ' ";
					break;
				case '5':
					$query="UPDATE backup SET tape = '5' WHERE date = ' ".$row['date']." ' ";
					break;
				
				default:
					$query="SELECT * FROM backup LIMIT 10";
					break;
			}
			$this->db2->query($query);	
		 }
		
	   }

	private function isWeekend($thisDate) {
		$date=date('N', strtotime($thisDate));
		if($date >= 6){//sabtu dan minggu tidak dihitung
			return true;
		}else{
			return false;
		}
	}

	//fungsi check tanggal merah
	private function isHoliday($dateIn) {
		$holiday = $this->holiday();	
		if(isset($holiday[$dateIn])){
			return true;
		}else{
			return false;
		}
	}

	private function holiday(){
		$dataHoliday=[
			 // Libur 2020
			'2020-01-01' => '',
			'2020-01-25' => '',
			'2020-03-22' => '',
			'2020-03-25' => '',
			'2020-04-10' => '',
			'2020-05-07' => '',
			'2020-05-21' => '',
			'2020-05-22' => '',
			'2020-05-23' => '',
			'2020-05-24' => '',
			'2020-05-25' => '',
			'2020-05-26' => '',
			'2020-05-27' => '',
			'2020-06-01' => '',
			'2020-07-31' => '',
			'2020-08-17' => '',
			'2020-08-20' => '',
			'2020-10-29' => '',
			'2020-12-24' => '',
			'2020-12-25' => '',

			//2021
			'2021-01-01' => '',
			'2021-01-12' => '',
			'2021-03-11' => '',
			'2021-03-14' => '',
			'2021-04-02' => '',
			'2021-05-01' => '',
			'2021-05-12' => '',
			'2021-05-13' => '',
			'2021-05-14' => '',
			'2021-05-26' => '',
			'2021-06-01' => '',
			'2021-07-20' => '',
			'2021-08-10' => '',
			'2021-08-17' => '',
			'2021-08-18' => '',
			'2021-10-18' => '',
			'2021-12-24' => '',
			'2021-12-25' => '',

			//2022
			'2022-01-01' => '',
			'2022-02-01' => '',
			'2022-02-28' => '',
			'2022-03-03' => '',
			'2022-04-15' => '',
			'2022-05-01' => '',
			'2022-05-02' => '',
			'2022-05-03' => '',
			'2022-05-16' => '',
			'2022-05-26' => '',
			'2022-06-01' => '',
			'2022-07-09' => '',
			'2022-07-30' => '',
			'2022-08-17' => '',
			'2022-10-08' => '',
			'2022-12-25' => '',
		   ];
		return $dataHoliday;

	}	
}
