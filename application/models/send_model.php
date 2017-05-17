<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class send_model extends CI_Model {
	

	public function arlet($array=false)
	/*
		$this->load->model('send_model');
		$array['error']['text']='Текст отображения для пользователя';
		$array['error']['status']=1; - Статус ошибки.(1-успех, 2-информационное, 3-предупреждение, 4-ошибка)
		$this->send_model->arlet($array);
	*/
		{
		if(!empty($array))
		{
		if(empty($array['error']['text'])) $array['error']['text']='Ошибка уведомления! Обратитесь к разработчику!';
		switch($array['error']['status'])
			{
				case 1: {$status='success'; $icon='fa-check'; break; } // успех зеленое сообщение
				case 2: {$status='info'; $icon='fa-info-circle'; break; } // информационное сообщение синее
				case 3: {$status='warning'; $icon='fa-check'; break; } // внимание желтое сообщение
				case 4: {$status='danger'; $icon='fa-check'; break;}  // опасно красное сообщение
				//default: {$status='danger'; $icon='fa-check'; $array['error']['text']='ERROR Switch! Обратитесь к разработчику!'; break;}
			}
		$result=' <br><div class="alert alert-'.$status.' alert-dismissible fade in shadowed" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-fw '.$icon.'"></i> '.$array['error']['text'].' 
                </div>';
        } else $result='';
            return $result;
		}
		
#	--------------------------------------ИСТОРИЯ
/*
Структура:
	|0 |дата|автор | договор|название оборуд|оборуд.инв|оборуд.сер|учительID|учительФИО  |№операции|примечание|
	|id|date|author|contract|device_name	|device_inv|device_ser|teacher  |teacher_name|operation|note	  |
*/
		public function new_history($array) // сборка и запись
			{
				$this->load->model('auth_model');
				$userinfo=$this->auth_model->authinfo;
				$array=$this->check_array($array);
				$array['note']=$this->operation($array);
				$array['id']=0;
				$array['date']=date("Y-m-d H:i:s");
				$array['author']=$userinfo['users_login'];
				$this->db->insert('history',$array);
			}
		
		public function check_array($array) // проверк пустых
			{
				if(empty($array['contract'])) 
					{
					 if (($array['teacher']!='-') AND (($array['operation']==21) OR ($array['operation']==7)))
					 	{
					 		$teacher=$this->db->get_where('educator',array('id'=>$array['teacher']));
							$teacher=$teacher->result_array();
							$array['contract']=$teacher[0]['contract'];
					 	} else $array['contract']='-';
					}
				if(empty($array['device_name'])) $array['device_name']='-';
				if(empty($array['device_inv'])) $array['device_inv']='-';
				if(empty($array['device_ser'])) $array['device_ser']='-';
				if(empty($array['teacher'])) $array['teacher']='-';
				if(empty($array['teacher_name'])) //если не указан данный массив то
					{
						if ($array['teacher']!='-')  // проверяем если id есть то... ищем по id и получаем ФИО
							{
								$teacher=$this->db->get_where('educator',array('id'=>$array['teacher']));
								$teacher=$teacher->result_array();
								$array['teacher_name']=$teacher[0]['surname'].' '.$teacher[0]['realname'].' '.$teacher[0]['middlename'];
							} else $array['teacher_name']='-';
					}
				if(empty($array['operation'])) $array['operation']=0;
				return $array;	
			}
		
		function operation($array) // примечание по операции
			{	
				$result='';
				switch($array['operation'])
					{
						case 0: { $result='Неизвестная операция'; break;}
						//Учитель(пользователь)
						case 1: { $result='Учитель '.$array['teacher_name'].' создан'; break;}
						case 2: { $result='Учитель '.$array['teacher_name'].' удален'; break;}
						case 3: { $result='Учитель '.$array['teacher_name'].' изменен'; break;}
						case 4: { $result='Принят как совместитель'; break;}
						case 5: { $result='Принят как постоянный работник'; break;}
						case 6: { $result='Учитель'.$array['teacher_name'].'прекратил работу'; break;}
						case 7: { $result='Изменение даты заключения договора.'; break;}
						//Категории + Оборудование
						case 10: { $result='Категория создана';  break; }
						case 11: { $result='Категория удалена';  break; }
						case 12: { $result='Оборудование создано';  break; }
						case 13: { $result='Оборудование удалено';  break; }
						case 14: { $result='Оборудование изменено';  break; }
						case 15: { $result='Добавлен заводской номер '.$array['device_ser']; break; }
						case 16: { $result='Добавлен инвентарный номер '.$array['device_inv']; break; }
						case 17: {if ($array['device_ser']=='-' and $array['device_inv']=='-') $result='Оборудование на ремонт!'; else $result='Оборудование '.$array['device_inv'].' ('.$array['device_ser'].') на ремонт!'; break; }
						case 18: {if ($array['device_ser']=='-' and $array['device_inv']=='-') $result='Оборудование отремонтировано!'; else $result='Оборудование '.$array['device_inv'].' ('.$array['device_ser'].') отремонтировано';  break; }
						//Комплект
						case 20: { $result='Выдан комплект '.$array['contract'];  break; }
						case 21: { $result='Комплект '.$array['contract'].' изъят'; break; }
						case 22: { $result='Изъято '.$array['device_inv'].' ('.$array['device_ser'].')'; break; }
						case 23: { $result='Выдан '.$array['device_inv'].' ('.$array['device_ser'].') временно'; break; }
						case 24: { $result='Замена на '.$array['device_inv'].' ('.$array['device_ser'].')'; break; }
						case 25: { $result='Комплект '.$array['contract'].' расформирован'; break; }
						case 26: { $result='Комплект '.$array['contract'].' собран'; break; }
					}
				return $result;
			}
		
		public function my_history($id) // история определенного пользователя
			{
				$this->db->where('teacher',$id);
				$this->db->order_by('date','desc');
				$this->db->Limit(20); // лимит 20 сообщений
				$result=$this->db->get('history');
				$result=$result->result_array();
				$result['count']=count($result);
				return $result;
			}
		
		public function all_history() // вывой всей истории
			{
				$result=$this->db->get('history');
				$result=$result->result_array();
				return $result;
			}
		
}
