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
		
	public function jspost($post) //вывод инв номеров при сборке комплекта
	{
		$type_id = trim($post['type_id']); // получаем номер оборудования
		$this->db->where('types',$type_id); // ищем
		$ddb=$this->db->get('device_all'); 
		$type=$ddb->result_array(); // получаем
		$k=0;
		foreach($type as $item) // собираем массив для дальнейших действий
			{
				if($item['inv']=='-') continue;  //если нет инвентарника пропускаем
				else 
					{
						$k++;
						$array[$item['types']][$item['id']]=$item['inv']; 
					}
			}
		$result = NULL;
		$i = 0;
		if ($k==0) //если инвентарников нет, то отправляем что оборуд. без инв.
			{
				$result[$i]['kind_id']='no'; 
				$result[$i]['kind'] = 'Без ИНВ.номера';
			}
		else { 
			# собираем массив с инвентарниками
				foreach ($array[$type_id] as $kind_id => $kind) {
					$result[$i]['kind_id'] = $kind_id;
					$result[$i]['kind'] = $kind;
					$i++;
					}
			}
		echo json_encode($result); // показываем массив в виде JSON
	}
		
		
}
