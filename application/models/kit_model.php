<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kit_model extends CI_Model {
	

	public function __construct()
		{
			//$db2 = $this->load->database('users', TRUE);
		}
		
	//----------------------------------------------------------	
		
	public function all_kit() // Вывод всех комплектов
		{
			$count=$this->db->count_all('device_all');
			$result['result_count']=$count;
			if ($count!=0)
				{
					$this->db->where('education_id !=','0');
					$this->db->group_by('contract');
					$que=$this->db->get('device_all');
					$result['kit']=$this->handler_kit($que->result_array());
					$result['error']=0;
					$result['result_count']=count($result['kit']);
				} else $result['error']=1;
			
			
			return $result;
		}
		
	public function handler_kit($array) // сортировка массива с комплектами
		{
			$count=count($array); $x=-1;
			while($x++<$count-1)
				{
					$this->db->where('id',$array[$x]['education_id']);
					$this->db->Limit(1);
					$teach=$this->db->get('educator');
					$teacher=$teach->result_array();
					$array[$x]['education_id']=$teacher[0]['surname'].' '.$teacher[0]['realname'].' '.$teacher[0]['middlename'];
					
				}
		return $array;
		}
		
	public function all_free_kit() //отобразить все свободные комплекты
		{
			$count=$this->db->count_all('device_all');
			$result['result_count']=$count;
			if ($count!=0)
				{
					
				}
		}
		
		
}
