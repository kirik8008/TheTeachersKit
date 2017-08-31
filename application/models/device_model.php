<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class device_model extends CI_Model {
/*
WORK (device_all)
1 - рабочее
2 - временно изьято
0 - не рабочее

*/	

	public function __construct()
		{
			
		}
		
	//----------------------------------------------------------	
	
	public function all_device($num,$offset) // Вывод оборудования
		{
			$count=$this->db->count_all('device_all'); //считаем оборудование
			$result['result_count']=$count;
			if ($count!=0) // если есть то...
				{
					$que=$this->db->get('device_all',$num,$offset); // получаем
					$result['device']=$que->result_array(); // записываем в переменную 
					$result['error']=0; // ошибок нет
				} else $result['error']=1;
			return $result; 
		}	
	
	public function all_types($num,$offset) // Вывод категорий
		{
			$count=$this->db->count_all('device_types'); //считаем оборудование
			$result['result_count']=$count;
			if ($count!=0) // если есть то...
				{
					$que=$this->db->get('device_types',$num,$offset); // получаем
					$result['device']=$que->result_array(); // записываем в переменную 
					$result['error']=0; // ошибок нет
				} else $result['error']=1;
			return $result; 
		}
		
	public function all_device_group($types,$num,$offset) //вывод оборудования определенной группы
		{
			$types=$this->Auth_model->check_text($types);
			$type=$this->db->get_where('device_types',array('low_key'=>$types)); // ищем код по таблице types 
			$type=$type->result_array();
			if(count($type)!=0)
				{
					$result=$this->db->get_where('device_all',array('types'=>$type[0]['id']),$num,$offset); //ищем всё оборудование по номеру types
					$end['device']=$result->result_array();
					$end['result_count']=count($end['device']);
				} else $end['result_count']=0;
			return $end; 
		}
		
	public function count_device_group($types) // функция для подсчета оборудования в группе ВРЕМЕННАЯ ФУНКЦИЯ!
		{
			$type=$this->db->get_where('device_types',array('low_key'=>$types)); // ищем код по таблице types 
			$type=$type->result_array();
			if(count($type)!=0)
				{
					$this->db->where('types',$type[0]['id']);
					$count=$this->db->count_all_results('device_all');
				} else $count=0;
			return $count;
		}
	
	public function nowork() // вывод нерабочего оборудования
		{
			$result=$this->db->get_where('device_all',array('work',0));
			$data['device']=$result->result_array();
			$count=count($data['device']);
			return $count;
		}
		
		
  	function generateCode($length=6) //Функция для генерации случайной строки 
  		{ 
  			$chars = "abcdefghijklmnopqrstuvwxyz"; 
    		$code = ""; 
    		$clen = strlen($chars) - 1;   
    		while (strlen($code) < $length) 
    			{ 
        			$code .= $chars[mt_rand(0,$clen)];   
    			} 
    		return $code;
  		} 
	
	public function all_device_select() //вывод в select сгрупировав по имени
		{
			$this->db->group_by('name');
			$res=$this->db->get('device_all');
			$result=$res->result_array();
			return $result;
		}
	
	public function device_category() // вывод по категориям
		{
			$this->load->model('category_model');
			$category=$this->category_model->all_category();
			if ($category['result_count']>0) 
				{
					foreach($category['category'] as $item)
						{
							$query=$this->db->get_where('device_types',array('category'=>$item['id']));
							$result[$item['id']]=$query->result_array();
						}
				} else $result='';
			return $result;
		}
		
	public function save_device($array) // запись оборудования в БД
		{
			$error=0; $k=0; $text='';
			if(empty($array['name'])) {$error++; $errorinfo[$error]='Не указано НАЗВАНИЕ оборудования!';}
			if(empty($array['price'])) {$error++; $errorinfo[$error]='Не указана ЦЕНА оборудования!';}
			if($array['category']==0) {$error++; $errorinfo[$error]='Не выбрана КАТЕГОРИЯ оборудования!';}
			switch($array['optionsRadios'])
				{
					case '1': {if((empty($array['inv_start'])) OR (empty($array['inv_finish']))) {$error++; $errorinfo[$error]='Не правильно указан диапозон ИНВ.номеров';} break;} 
					case '0': {if(empty($array['inv_count'])) {$error++; $errorinfo[$error]='Не указано колличество оборудования!';} break;}
					default: {$error++; $errorinfo[$error]='Неверный запрос! Обратитесь к разработчику!';}
				}
			$this->load->model('send_model');
			if($error==0)
				{
					$array['inv_start']= str_replace(' ','',$array['inv_start']);
					$array['inv_finish']= str_replace(' ','',$array['inv_finish']);
					switch($array['optionsRadios'])
						{
							case '1': $data=$this->oprionsradios($array); break;
							case '0': $data=$this->oprionsradios($array,true); break;
						}
					
				} else
				{
					$data['error']['status']=4;
					$data['error']['text']='Ошибка! Некоторые поля не верно заполнены или вообще не заполнены: <ol>';
					foreach($errorinfo as $info)
						{
							$data['error']['text'].='<li>'.$info.'</li>';
						}
					$data['error']['text'].='</ol>';	
				}
					$result=$this->send_model->arlet($data);
		return $result;
		}
		
	function oprionsradios($array,$in=false) // функция сбора и записи
		{
		$k=0; $text='';
			if(!empty($in))
				{
					$x=0;
					$oborud_array=array(
					'id'=>0,
					'category'=>$array['category'],
					'name'=>$this->Auth_model->check_text($array['name']),
					'price'=>$array['price'],
					'count_device'=>$array['inv_count'],
					'inv_view'=>0,
					'inv_start'=>'-',
					'inv_end'=>'-',
					'low_key'=>$this->generateCode(),
					'purchasing'=>$array['purchasing']
					);
					$this->db->insert('device_types',$oborud_array);
					$id_types=$this->db->insert_id();
					while($x++<$array['inv_count'])
						{
							$k++;
							$dbinsert=array(
							'id'=>0,
							'contract'=>'0',
							'category'=>$array['category'],
							'types'=>$id_types,
							'name'=>$this->Auth_model->check_text($array['name']),
							'inv'=>'-',
							'ser'=>'-',
							'price'=>$array['price'],
							'work'=>1,
							'education_id'=>0,
							'location'=>'ЦЛПДО'
							);
							$this->db->insert('device_all',$dbinsert);
						}
					$data['error']['status']=1;
					$data['error']['text']='Будет создано '.$k.' оборудования.';
					
				}
				else
				{	
					$startinv=$array['inv_start'];
					$count_device=$startinv-$array['inv_finish']+1;
					$oborud_array=array(
					'id'=>0,
					'category'=>$array['category'],
					'name'=>$this->Auth_model->check_text($array['name']),
					'price'=>$array['price'],
					'count_device'=>$count_device,
					'inv_view'=>1,
					'inv_start'=>$startinv,
					'inv_end'=>$array['inv_finish'],
					'low_key'=>$this->generateCode(),
					'purchasing'=>$array['purchasing']
					);
					$this->db->insert('device_types',$oborud_array);
					$id_types=$this->db->insert_id();
					while($startinv<=$array['inv_finish'])
						{
							$k++;
							$dbinsert=array(
							'id'=>0,
							'contract'=>'0',
							'category'=>$array['category'],
							'types'=>$id_types,
							'name'=>$this->Auth_model->check_text($array['name']),
							'inv'=>$startinv,
							'ser'=>'-',
							'price'=>$this->Auth_model->check_text($array['price']),
							'work'=>1,
							'education_id'=>0,
							'location'=>'ЦЛПДО'
							);
							$this->db->insert('device_all',$dbinsert);
							$startinv++;
						}
					$data['error']['status']=1;
					$data['error']['text']='Будет создано '.$k.' оборудования. C инв.номерами начиная с '.$array['inv_start'].' заканчивая '.$array['inv_finish'];
					
				}
				
			return $data;
		}
		
	public function search_category($id) //поиск категории по ID
		{
			$id=$this->Auth_model->check_text($id);
			$result=$this->db->get_where('device_category',array('id'=>$id));
			$result=$result->result_array();
			return $result;
		}
		
	public function search_device($array,$teacher) //вывод информации об оборудовании по id и пользователю
		{
			
			$result=$this->db->get_where('device_all', array('id'=>$this->Auth_model->check_text($array),'education_id'=>coding($this->Auth_model->check_text($teacher),true)));
			$result=$result->result_array();
			return $result;
		}
		


}
