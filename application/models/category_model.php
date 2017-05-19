<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class category_model extends CI_Model {
	

	public function __construct()
		{
			
		}
		
	//----------------------------------------------------------	
		
	public function all_category() // Вывод категорий оборудования
		{
			$count=$this->db->count_all('device_category'); //считаем категории
			$result['result_count']=$count;
			if ($count!=0) // если категории есть то...
				{
					$this->db->order_by('location'); // выводим их по номеру позиции
					$que=$this->db->get('device_category'); // получаем
					$result['category']=$que->result_array(); // записываем в переменную 
					$result['error']=0; // ошибок нет
				} else $result['error']='';
			return $result; 
		}
	
	function generateCode($length=6) {  //генератор случайной строки
  		$chars = "abcdefghijklmnopqrstuvwxyz"; 
    	$code = ""; 
    	$clen = strlen($chars) - 1;   
    	while (strlen($code) < $length) { 
        	$code .= $chars[mt_rand(0,$clen)];   
    	} 
    	return $code;
  	} 
		
	public function operation($operation,$id) // выполнение операции
		{
		$error=array();
			switch($operation)
				{
					case "delete": 
						{
							$this->db->where('category',$id);
							$count=$this->db->count_all_results('device_types');
							if($count==0)
								{
									$this->db->where('id',$id); 
									$this->db->delete('device_category'); 
									header("Location:".base_url()."category/all"); 
									$error['error']['status']=1;
									$error['error']['text']='Категория удалена!';
									break;
								} else
								{
									$error['error']['status']=3;
									$error['error']['text']='Нельзя удалить категорию, пока в ней существует оборудование!';
								}
						} // удаление категории
				}
		return $error;
		}
	
	public function save_category($array=false) //  создание новой категории
		{
			if(!empty($array)) // проверяем переданы ли данные массива то.....
				{
					$data=array(
						'id'=>0,
						'name'=>$array['name'],
						'location'=>$array['id'],
						'display'=>1,
						'low_key'=>$this->generateCode()
					); // собираем новый массив
					$db_result=$this->db->get('device_category'); // получаем всё из таблицы
					$device=$db_result->result_array(); // 
					foreach($device as $item) //перебираем полученный массив
						{
							if($array['id']<=$item['location']) // если новая позиция больше или равна существующему то...
								{
									$save_new=array('location'=>$item['location']+1); // в существующей прибавляем позицию на 1 и...
									$this->db->update('device_category',$save_new,array('id'=>$item['id'])); // записываем эту категорию с новой позицией
								}
						}
					$this->db->insert('device_category',$data); // записываем новую категорию в освобожденную позицию
					$id=$this->db->insert_id(); // получаем номер сохраненной позиции
					$this->load->model('send_model'); // выводим сообщение...
					if($id>0)  //если номер больше 0 то....
						{
							$info['error']['status']=1; // удачное сообщение
							$info['error']['text']='Категория '.$array['name'].' создана!';
							$result['error']=$this->send_model->arlet($info); // собираем сообщение
						} else // если 0 или меньше то...
						{
							$info['error']['status']=4; // сообщение ошибки
							$info['error']['text']='Ошибка записи, обратитесь к разработчику!';
							$result['error']=$this->send_model->arlet($info);
						}
				}
			else // если не нейден массив то выводим сообщение с ошибкой
				{
					$info['error']['status']=3;
					$info['error']['text']='Внимание! Вы не заполнили все строки!';
					$result['error']=$this->send_model->arlet($info);
				}
		return $result;
		}
		
		
}
