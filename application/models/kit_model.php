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
					$this->db->where('contract !=','0');
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
					if(count($teacher)>0)
					$array[$x]['education_id']=$teacher[0]['surname'].' '.$teacher[0]['realname'].' '.$teacher[0]['middlename'];
					else $array[$x]['education_id']='<span class="label label-success">Свободный</span>';
					$array[$x]['count']=$this->count_device($array[$x]['contract']);
					$array[$x]['price']=$this->price_device($array[$x]['contract']);
					
				}
		return $array;
		}
	
	public function count_device($contract) // подсчет оборудования в комплекте
		{
			$this->db->where('contract',$contract);
			$count=$this->db->count_all_results('device_all'); //получение результата с условием выше
			return $count;
		}
	
	public function price_device($contract) // сумма комплекта
		{
			$qs=$this->db->get_where('device_all',array('contract'=>$contract));
			$qs=$qs->result_array();
			$result=0;
			foreach($qs as $sq)
				{
					$result=$result+$sq['price'];
				}
			return $result;
		}
	
		
	public function all_free_kit() //отобразить все свободные комплекты
		{
			$this->db->group_by('contract');
			$result=$this->db->get_where('device_all',array('contract !='=>'0', 'education_id'=>0));
			$result=$result->result_array();
			return $result;
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
						if($item['contract']=='0') $array[$item['types']][$item['id']]=$item['inv']; 
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
	
	public function check_form($array) // проверка формы сборки комплекта
		{	
		$this->load->model('send_model');
		$x=0; $error=0; $m=0;
		if (empty($array['contract'])) {$error++; $errorinfo[$error]='Не указан номер договора!';}
			if($array['W1']<>0) // проверяем, есть ли главное оборудование в первой категории
				{
					while($x++<=$array['all']-1) // запускаем цикл с общим числом категорий
						{
						$W='W'.$x; $S='S'.$x; $ser='ser'.$x;
							if($array[$W]<>0) // проверяем выбрана ли категория
								{
									if(!empty($array[$S])) // проверка для подстраховки, так как не выбрав категорию, данное меню не откроется.
										{
											if(($array[$S]==0) OR ($array[$S]=='no')) 
												{
													$insert[$m]['inv']='-'; // проверяем есть ли инвентарный номер.
													$insert[$m]['id']=$this->search_free_device($insert[$m]['inv'],$array[$W]);
													if ($insert[$m]['id']=='error') {$error++; $kat=$m+1; $errorinfo[$error]='Не найдено свободное оборудование из категории № '.$kat;}
												}
											else 
												{
													$insert[$m]['id']=$this->search_free_device($array[$S]); //если указан инв.номер то запоминаем его.
													if ($insert[$m]['id']=='error') {$error++; $errorinfo[$error]='Оборудование с данным ИНВ.номером занято';}
												}
										}
									else {$error++; $kat=$m+1; $errorinfo[$error]='Не выбран инвентарный номер! В категории № '.$kat;} 
									if(!empty($array[$ser])) $insert[$m]['ser']=$array[$ser]; // опять же для подстраховки, при выборе категории серийный номер запишит.
								$insert[$m]['contract']=$array['contract'];
								$m++;
								}
						}
				} else {$error++; $errorinfo[$error]='Не указано главное оборудование в первой категории!';}
				
			if($error==0)
				{
					foreach($insert as $in)
						{
							$this->db->where('id',$in['id']);
							$this->db->update('device_all',$in);
						}
					$data['error']['status']=1;
					$data['error']['text']='Возможно Удачно! Система не вернула никаких ошибок, значит комплект '.$array['contract'].' был сформирован правильно!';
				} else
				{
					$data['error']['status']=4;
					$data['error']['text']='Ошибка! Не полная информация: <ol>';
					foreach($errorinfo as $info)
						{
							$data['error']['text'].='<li>'.$info.'</li>';
						}
					$data['error']['text'].='</ol>';	
				}
				$result=$this->send_model->arlet($data);
		return $result;
		}
		
	function search_free_device($inv,$type=false)
		{
			$this->db->where('contract','0');
			if($inv=='-')
				{
					$this->db->where('types',$type);
					$this->db->where('ser',$inv);
				} else $this->db->where('id',$inv);
			$this->db->limit(1);
			$qs=$this->db->get('device_all');
			$result=$qs->result_array();
			if(count($result)<1) $result[0]['id']='error';
		return $result[0]['id'];
		}
		
	public function search_kit($contract=false, $id_teacher=false) // поиск оборудования принадлежащее пользователю по договору
		{
			$result=$this->db->get_where('device_all',array('contract'=>$contract));
			$result=$result->result_array();
			$nowork=0;
			$count_device=0;
			$location_clpdo=0;
			foreach($result as $item)
				{
					if($item['work']!=1) $nowork++;
					if($item['location']=='ЦЛПДО') $location_clpdo++;
					$count_device++;
				}
			$data['contract']=$contract; // номер договора
			$data['no_work']=$nowork; //не работающее оборудование
			$data['location']=$location_clpdo; // сколько находится на складе
			$data['count_all']=$count_device; // получаем количество оборудования в комплекте
			$data['price_all']=$this->price_device($contract); // получаем полную стоимость комплекта
			return $data;
		}
		
	public function kit($contract,$id_teacher) // вывод оборудования по номеру договора или id пользователя 
		{
			$data=array();
			$this->load->model('device_model');
			$this->db->where('location !=','ЦЛПДО'); // ищем только те комплекты которые находятся не на складе
			if(!empty($contract)) $this->db->where('contract',$contract); // поиск по номеру договора
			if(!empty($id_teacher)) $this->db->where('education_id',$id_teacher); // поиск по id пользователя
			$result=$this->db->get('device_all'); //запрос
			$result=$result->result_array();//вывод
			foreach($result as $item)
				{
					
					$category=$this->device_model->search_category($item['category']);
					$item['id']=$category[0]['location'];
					$data[$category[0]['location']]=$item;
				}
			return $data;
		}
		
	public function cancellation_kit($id_teacher,$operation=false) // изъятие комплекта
		{
			# История операция -->
			$this->send_model->new_history(array('operation'=>21,'teacher'=>$id_teacher));
			# <-- Конец истории
			$this->db->where('id',$id_teacher); // поиск пользователя
			$this->db->update('educator',array('contract'=>'0','contract_date'=>'0000-00-00')); //удаление информации о комплекте у пользователя
			$this->db->where('education_id',$id_teacher);
			$this->db->update('device_all',array('education_id'=>'0','location'=>'ЦЛПДО'));
			$data['error']['status']=1;
			$data['error']['text']='Операция выполнена!';
			$this->load->model('teacher_model');
			$this->teacher_model->update_time($id_teacher);
			return $data;
		}
		
}