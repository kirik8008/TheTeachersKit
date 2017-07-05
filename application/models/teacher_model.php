<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class teacher_model extends CI_Model {
	
		public $authinfo;
		public $date;

	public function __construct()
		{
			//$db2 = $this->load->database('users', TRUE);
			$this->load->helper('x99_helper');
			
		}
		
	//----------------------------------------------------------	
	# Функция для генерации случайной строки 
  	function generateCode($length=6,$abc=false) { 
    	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789"; 
    	$code = ""; 
    	$clen = strlen($chars) - 1;   
    	while (strlen($code) < $length) { 
        	$code .= $chars[mt_rand(0,$clen)];   
    	} 
    	return $code;
  	} 
  	
  	function update_time($id) // изменение даты обновления профиля
  		{
  			$this->date=date("Y-m-d H:i:s");
  			$array=array('update_profile'=>$this->date);
  			$this->db->where('id',$id);
  			$this->db->update('educator',$array);
  		}
  	
  	function getDateDiff($d) // сравнение даты и вывод сколько прошло времени.
	{
	$datetime2 = new DateTime();    
	//$datetime1 = DateTime::createFromFormat('d.m.Y H:i:s', $d);
	$datetime1 = DateTime::createFromFormat('Y-m-d H:i:s', $d);
	$interval = $datetime1->diff($datetime2);
	//$param = $interval->format('%a день час: %h мин: %i сек: %s');
	if($interval->format('%a')<1) 
		{
			if($interval->format('%h')<1) 
				{
					if($interval->format('%i')<1) 
						{
							$result=$interval->format('%s').' сек назад';
						} else $result=$interval->format('%i').' мин '.$interval->format('%s').' сек назад';
				} else $result='больше '.$interval->format('%h').' час назад';
		} else $result='больше '.$interval->format('%a').' день назад';
	return $result;	
	}
	
		
	public function all_educator($num,$offset) // Вывод всех учителей
		{
			$count=$this->db->count_all('educator');
			if ($count!=0)
				{
					$this->db->order_by('surname');
					$que=$this->db->get('educator',$num,$offset); // получаем всё из базы
					$result['teacher']=$this->handler_educator($que->result_array()); //обробатываем
					$result['error']=0; //говорим что ошибок нет
				} else $result['error']=1; //если пользователей нет в БД то говорим что есть ошибка.
			$result['result_count']=$count;
			
			return $result;
		}
		
	public function handler_educator($array,$safe=false) // обработка вывода информации о преподователе.
		{
			$this->load->model('kit_model');
			$count=count($array); $x=-1;
			while($x++<$count-1)
				{
					if(($array[$x]['job']==1) AND ($array[$x]['contract']=='0'))
						{
							$freekit=$this->kit_model->all_free_kit();
							$array[$x]['kit']='<form name="myForm"><input type="hidden" name="id_teachers" value="'.$array[$x]['id'].'"> <select name="contract" onchange="submit();" class="form-control"><option value="0">Выбрать договор</option>';
							foreach($freekit as $kit)
								{
									$array[$x]['kit'].='
									<option value="'.$kit['contract'].'">'.$kit['contract'].'</option>
									';
								}
							$array[$x]['kit'].='</select></form>';
							$view_contract=1;
							if($count==1) // проверяем если показываем только одного учителя то проверяем прошлый договор если есть
								{
									$this->db->where('teacher',$array[$x]['id']);
									$this->db->where('contract!=','-');
									$last_contract_db=$this->db->get('history');
									$last_contract_db=$last_contract_db->result_array();
									if(count($last_contract_db)!=0) $array[$x]['kit'].='<span class="label label-info">Прошлый договор: '.$last_contract_db[0]['contract'].'</span>'; else $array[$x]['kit'].='<span class="label label-danger">Договор прошлых лет не найден.</span>';
								}
							
						}
					$array[$x]['coding_id']=coding($array[$x]['id']); //шифрование id
					$array[$x]['update_profile']=$this->getDateDiff($array[$x]['update_profile']); // проверка сколько прошло времени с последнего изменения профиля
					switch($array[$x]['work']) //проверка совместитель или постоянный работник
						{
						case 0: {$array[$x]['work_source']=$array[$x]['work']; $array[$x]['work']=base_url().'graphics/img/md/dark/person.svg'; break;} //картинка если постоянный работник
						case 1: {$array[$x]['work_source']=$array[$x]['work']; $array[$x]['work']=base_url().'graphics/img/md/dark/directions-walk.svg'; break;} //картинка если совместитель
						case 10: {$array[$x]['work_source']=$array[$x]['work']; $array[$x]['work']='Постоянный';  break;}// текст вместо иконок
						case 11: {$array[$x]['work_source']=$array[$x]['work']; $array[$x]['work']='Совместитель'; break;}
						}
					
					switch($array[$x]['job']) //проверка работает или уволен
						{
						case 1: $array[$x]['job']='<span class="label label-success">Работает</span>'; break; // работает
						case 0: $array[$x]['job']='<span class="label label-danger">Не работает</span>'; break; // не работает
						}
						
					switch($array[$x]['teacher']) //иконка вместо текста о предмете пользователя
						{
						case "Учитель Математики": {$array[$x]['teacher_icon']='mathematics'; break; }
						case "Учитель Русского языка и Литературы": {$array[$x]['teacher_icon']='rus'; break; }
						case "Учитель Истории и(или) Общества": {$array[$x]['teacher_icon']='society'; break; }
						case "Учитель Информатики": {$array[$x]['teacher_icon']='infor'; break; }
						case "Учитель Иностранных языков": {$array[$x]['teacher_icon']='foreign'; break; }
						case "Учитель Физики": {$array[$x]['teacher_icon']='molecule'; break; }
						case "Учитель Химии": {$array[$x]['teacher_icon']='chemistry'; break; }
						case "Учитель Биологии": {$array[$x]['teacher_icon']='biology'; break; }
						case "Учитель Музыки и(или) МХК": {$array[$x]['teacher_icon']='music'; break; }
						case "Учитель Технологии": {$array[$x]['teacher_icon']='technology'; break; }
						case "Учитель Географии": {$array[$x]['teacher_icon']='geography'; break; }
						case "Психолог": {$array[$x]['teacher_icon']='no_icon'; break; }
						case "Логопед": {$array[$x]['teacher_icon']='no_icon'; break; }
						case "Другое": {$array[$x]['teacher_icon']='no_icon'; break; }
						}
					if(empty($safe))
						{
							if(($this->encrypt->decode($array[$x]['passport_issued'])<>'0')AND $count==1)
								{
									$array[$x]['passport_number']='**** ***'.substr($this->encrypt->decode($array[$x]['passport_number']),-3);
									$array[$x]['passport_issued']='************';
									$array[$x]['passport_address']=$this->encrypt->decode($array[$x]['passport_address']);
								} 
								else 
								{
									$array[$x]['passport_number']='Не найден';
									$array[$x]['passport_issued']='Не найден';
									$array[$x]['passport_address']='Не найден';
								}
						} else
						{
								if(($this->encrypt->decode($array[$x]['passport_issued'])<>'0')AND $count==1)
								{
									$array[$x]['passport_number']=$this->encrypt->decode($array[$x]['passport_number']);
									$array[$x]['passport_issued']=$this->encrypt->decode($array[$x]['passport_issued']);
									$array[$x]['passport_address']=$this->encrypt->decode($array[$x]['passport_address']);
								} 
								else 
								{
									$array[$x]['passport_number']='Не найден';
									$array[$x]['passport_issued']='Не найден';
									$array[$x]['passport_address']='Не найден';
								}
						}
					
					switch($array[$x]['contract'])
						{
							case "0": {if(empty($view_contract)) $array[$x]['kit']='Не закреплено!'; $array[$x]['visible_contract']='visible-xs hidden-xs'; break;}
							default: {
										$kit_contrac=$this->kit_model->search_kit($array[$x]['contract']); // получаем оборудование
										//$array[$x]['kit_contract']='<table class="table"><tr><td>'.$kit_contrac['contract'].'</td><td><p class="tooltip-test" data-toggle="tooltip" data-placement="top" title="Стоимость комплекта">'.$kit_contrac['price_all'].'</p></td><td><p class="tooltip-test" data-toggle="tooltip" data-placement="top" title="Всего оборудования / Оборудование изъято / Не работающее">'.$kit_contrac['count_all'].'/'.$kit_contrac['location'].'/'.$kit_contrac['no_work'].'</p></td></tr></table>';
										$button='
											<a href="'.base_url().'kit/act_exemptions/'.$array[$x]['id'].'" target="_blank"><img src="'.base_url().'graphics/img/sf/file-text.svg" class="tooltip-test pull-right" data-toggle="tooltip" data-placement="top" title="Показать акт изъятия" height="24" width="24"></a>
											<a href="'.base_url().'kit/contract/'.$array[$x]['id'].'/'.$array[$x]['work_source'].'" target="_blank"><img src="'.base_url().'graphics/img/sf/file-word.svg" class="tooltip-test pull-right" data-toggle="tooltip" data-placement="top" title="Показать Договор" height="24" width="24"></a>
											<a href="'.base_url().'kit/view/'.coding($array[$x]['contract']).'/'.coding($array[$x]['id']).'"><img src="'.base_url().'graphics/img/sf/window-layout.svg" class="tooltip-test pull-right" data-toggle="tooltip" data-placement="top" title="Посмотреть комплект" height="24" width="24"></a>
											</div>
										';
										$array[$x]['kit_contract']='<div class="alert alert-success">Договор № <b>'.$kit_contrac['contract'].'</b> (от <a href="#"  data-toggle="modal" data-target="#myModal">'.$array[$x]['contract_date'].'</a>) на сумму '.$kit_contrac['price_all'].' руб. Всего оборудования: <b>'.$kit_contrac['count_all'].'</b>. На складе: <b>'.$kit_contrac['location'].'</b>. Не работающее: <b>'.$kit_contrac['no_work'].'</b></a>'.$button;
										if($array[$x]['work_source']==11) $add_text_kit='и уволить'; else $add_text_kit='';
										$array[$x]['kit']=$array[$x]['contract'].' <a href="'.base_url().'teacher/view/'.$array[$x]['id'].'/cancellation"><img src="'.base_url().'graphics/img/sf/sign-up.svg" class="tooltip-test" data-toggle="tooltip" data-placement="top" title="Изъять комплект '.$add_text_kit.'" height="20" width="20"></a>'; 
										$array[$x]['visible_contract']='';
										$array[$x]['coding_contract']=coding($array[$x]['contract']); //шифрование номера договора
									}
						}
						
						
					switch($array[$x]['photo'])
						{ // вывод аватара пользователя, если аватара нет то выводим аватар по полу
						 case "0": {if($array[$x]['person']==1) $array[$x]['photo']=base_url().'graphics/photo/male.png'; else $array[$x]['photo']=base_url().'graphics/photo/female.png'; break;}
						 default: $array[$x]['photo']=base_url().'graphics/photo/'.$array[$x]['photo'];
						} 
				}
			return $array;
		}
		
	public function newteacher($array) //проверка пост запроса на нового учителя.
		{
			$error=0; // обьявляем что ошибок нет
			if(empty($array['surname'])) {$error++; $error_info[$error]='Не заполнена строка Фамилия!';} // проверка строк
			if(empty($array['realname'])) {$error++; $error_info[$error]='Не заполнена строка Имя!';}
			if($array['person']==2) {$error++; $error_info[$error]='Не выбран пол преподавателя!';}
			if($array['teacher']=="0") {$error++; $error_info[$error]='Не указан предмет!';}
			if($array['work']==2) {$error++; $error_info[$error]='Не указано работа преподователя, совместитель или постоянный!';}
			if($array['job']==2) {$error++; $error_info[$error]='Не указано состояние, работает или уволен!';}
			
			$this->load->model('send_model'); // загрузка модели для вывода сообщений
			if($error>0) // проверяем есть ли ошибки при заполнении формы
				{ // выводим ошибки
					$data['error']['status']=4;
					$data['error']['text']='Ошибка! Некоторые поля не заполненны или не выбраны: <ol>';
					foreach($error_info as $info)
						{
							$data['error']['text'].='<li>'.$info.'</li>';
						}
					$data['error']['text'].='</ol>';	
				}
				else 
				{ // добавляем учителя
					//Загрузка фото		
					$config['upload_path'] = './graphics/photo/'; 
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']	= 2000;
        			$config['encrypt_name'] = TRUE;
					$config['remove_spaces'] = TRUE;
					$this->load->library('upload', $config);
					$this->upload->do_upload();
        			$upload_data = $this->upload->data(); 
        			$add['img'] = $upload_data['file_name']; 
        			if(empty($add['img'])) $add['img']='0'; //если небыло загружена фотография, то используется стандарный аватар.
					//---------
					// Проверяем есть ли введенные паспортные данные, если есть то начинаем кодировать их.
					if(!empty($array['passport_serial']) AND !empty($array['passport_number']) AND !empty($array['passport_issued']))
						{
							$array['passport_number']=$array['passport_serial'].' '.$array['passport_number'];
							$array['passport_serial']='';
							$array['passport_number']=$this->encrypt->encode($array['passport_number']); // кодируем номер и серию
							$array['passport_issued']=$this->encrypt->encode($array['passport_issued']); // кодируем раздел выдан
							$array['passport_address']=$this->encrypt->encode($array['passport_address']); // кодируем адрес
						} else // если в строках паспортных данных ничего нет, то записываем туда нули
						{ 
							$array['passport_number']=$this->encrypt->encode('0'); // записываем закодированный ноль в каждую строку!
							$array['passport_issued']=$this->encrypt->encode('0');
							$array['passport_address']=$this->encrypt->encode('0');
						}
					
					$insert=array( // собираем массив для записи базу
						'id'=>0, // ID
						'surname'=>$array['surname'], //фамилия
						'realname'=>$array['realname'], //имя
						'middlename'=>$array['middlename'], //отчество
						'person'=>$array['person'], // пол
						'teacher'=>$array['teacher'], //преподователь какого предмета
						'birthdate'=>0, // день рождение
						'telephone'=>$array['telephone'], // телефон
						'skype'=>'no', // скайп
						'passport_address'=>$array['passport_address'], //прописка
						'passport_number'=>$array['passport_number'], // серия номер паспорта
						'passport_issued'=>$array['passport_issued'], // выдан
						'realaddress'=>$array['realaddress'], // фактический адрес
						'work'=>$array['work'], // постоянный или совместитель
						'job'=>$array['job'], // работает или уволен
						'contract'=>'0', // номер присвоенного договора
						'contract_date'=>'0000-00-00', // номер присвоенного договора
						'photo'=>$add['img'], // аватар
						'low_key'=>$this->generateCode(), // проверочный код
						'update_profile'=>date('Y-m-d H:i:s') // дата обновления 
					);
					
					$this->db->insert('educator',$insert); // занесение в базу
					$objectid = $this->db->insert_id();   //получение номера под которым была занесена информация
					if(!empty($objectid)) // проверяем получили ли мы номер
						{ // при удачном обстоятельстве выдаем хорошее сообщение
							$data['error']['status']=1; 
							$data['error']['text']='Учитель <b>'.$array['surname'].' '.$array['realname'].'</b> успешно занесен в базу под номером '.$objectid;
							# История операция -->
							$this->send_model->new_history(array('operation'=>1,'teacher'=>$objectid,'teacher_name'=>$array['surname'].' '.$array['realname'].' '.$array['middlename']));
							# <-- Конец истории
						}
						else
						{ // при ошибке базы выдает соответственно не очень хорошее сообщение.
							$data['error']['status']=3;
							$data['error']['text']='Ошибка записи в MySQL! Обратитесь к разработчику!';
						}
					}
			$result=$this->send_model->arlet($data); // вывод результата
			return $result;
		}
		
		public function search_educator($idteacher,$safe=false) // поиск по id учителя
		{
			$result=$this->db->get_where('educator',array('id' => $idteacher),1); //поиск и вывод только одного
			$end=$result->result_array(); // вывод
			$end[0]['work']='1'.$end[0]['work']; // добавляем 1 вначало
			$this->load->helper('date_text_helper'); //использование функции для перевода даты в строку
			$contract_date=_date($end[0]['contract_date']); // получаем строку с датой
			$end[0]['contract_date_source']=$end[0]['contract_date'];
			$end[0]['contract_date']=$contract_date['day'].' '.$contract_date['month'].' '.$contract_date['year'];
			$end=$this->handler_educator($end,$safe); // отправляем в обработчик
			return $end[0];
		}
		
		public function operation($id,$operation=false,$ex=false)
		{
			
		}
		
	
		public function assignment_contract($array) // присвоение договора учителю(пользователю)
		{
			if(!empty($array['contract']))
				{
					$this->db->where('id',$array['id_teachers']); // ищем пользователя
					$update=array('contract'=>$array['contract'],'contract_date'=>date("Y-m-d")); // собрали новый массив
					$this->db->update('educator',$update); // обновили профиль
					$this->update_time($array['id_teachers']); // обновляем дату профиля
					/* начинаем заполнять поля оборудования, указывая у кого это оборудование */
					//сначало ищем пользователя, чтобы вытащить от туда адрес расположения оборудования
					$teachers=$this->db->get_where('educator',array('id'=>$array['id_teachers']));
					$teachers=$teachers->result_array();
					$this->db->where('contract',$array['contract']);
					$update_device=array('education_id'=>$array['id_teachers'], 'location'=>$teachers[0]['realaddress']);
					$this->db->update('device_all',$update_device);
					# История операция -->
					$this->send_model->new_history(array('operation'=>20,'teacher'=>$array['id_teachers'],'contract'=>$array['contract']));
					# <-- Конец истории
				}
		}
		
		public function new_date($array) // новая дата заключения договора
		{
			if(!empty($array['date']) AND !empty($array['teacher_id']))
				{	
					$data=array('contract_date'=>$array['date']);
					$this->db->where('id',$array['teacher_id']);
					$this->db->update('educator',$data);
					$result['error']['status']=1;
					$result['error']['text']='Дата заключения договора была изменена!';
					# История операция -->
					$this->send_model->new_history(array('operation'=>7,'teacher'=>$array['teacher_id']));
					# <-- Конец истории
				}
					else {
							$result['error']['status']=4;
							$result['error']['text']='Ошибка запроса...!';
						}
			return $result;
		}
		
		public function edit_teacher($array,$id) // изменение профиля учителя
		{
			$error=0; // обьявляем что ошибок нет
			if(empty($array['surname'])) {$error++; $error_info[$error]='Не заполнена строка Фамилия!';} // проверка строк
			if(empty($array['realname'])) {$error++; $error_info[$error]='Не заполнена строка Имя!';}
			
			$this->load->model('send_model'); // загрузка модели для вывода сообщений
			if($error>0) // проверяем есть ли ошибки при заполнении формы
				{ // выводим ошибки
					$data['error']['status']=4;
					$data['error']['text']='Ошибка! Некоторые поля не заполненны или не выбраны: <ol>';
					foreach($error_info as $info)
						{
							$data['error']['text'].='<li>'.$info.'</li>';
						}
					$data['error']['text'].='</ol>';	
				}
				else 
				{
				 	$config['upload_path'] = './graphics/photo/'; 
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']	= 2000;
        			$config['encrypt_name'] = TRUE;
					$config['remove_spaces'] = TRUE;
					$this->load->library('upload', $config);
					$this->upload->do_upload();
        			$upload_data = $this->upload->data(); 
        			$add['img'] = $upload_data['file_name']; 
					
					//проверяем есть ли паспортные данные
					if(!empty($array['passport_serial']) AND !empty($array['passport_number']) AND !empty($array['passport_issued']))
						{
							$array['passport_number']=$array['passport_serial'].' '.$array['passport_number'];
							$update['passport_number']=$this->encrypt->encode($array['passport_number']); // кодируем номер и серию
							$update['passport_issued']=$this->encrypt->encode($array['passport_issued']); // кодируем раздел выдан
							$update['passport_address']=$this->encrypt->encode($array['passport_address']); // кодируем адрес
						} else // если в строках паспортных данных ничего нет, то записываем туда нули
						{ 
							$update['passport_number']=$this->encrypt->encode('0'); // записываем закодированный ноль в каждую строку!
							$update['passport_issued']=$this->encrypt->encode('0');
							$update['passport_address']=$this->encrypt->encode('0');
						}
					if(!empty($add['img'])) $update['photo']=$add['img'];
					$update['realname']=$array['realname'];
					$update['surname']=$array['surname'];
					$update['middlename']=$array['middlename'];
					if($array['teacher']!='0') $update['teacher']=$array['teacher'];
					if($array['work']!='2') $update['work']=$array['work'];
					if($array['job']!='2') $update['job']=$array['job'];	
					$update['realaddress']=$array['realaddress'];
					$this->check_realaddress($id,$update['realaddress']);
					$update['telephone']=$array['telephone'];
					
					$this->db->where('id',$id);
					$this->db->where('surname',$array['surname']);
					$this->db->update('educator',$update);
					# История операция -->
					$this->send_model->new_history(array('operation'=>3,'teacher'=>$id));
					# <-- Конец истории
					redirect('/teacher/view/'.$id, 'refresh');
				}
		}
		
	public function delete_teacher($id) // удаление пользователя
		{
			$error=0;
			$id=coding($id,true);
			$array=$this->db->get_where('educator',array('id'=>$id));
			$array=$array->result_array();
			if(count($array)!=0)
				{
					if($array[0]['contract']=='0') $this->db->delete('educator',array('id'=>$id));	
					redirect('/teacher/all', 'refresh');
				}	
		}
		
	public function dismiss($id) // изменение работает преподователь и не работает
		{
			$id=coding($id,true);
			$teacher=$this->db->get_where('educator',array('id'=>$id));
			$teacher=$teacher->result_array();
			//if($teacher[0]['contract']=
		}
		
	public function check_realaddress($id,$address) // проверка изменен ли адрес, в случае если изменен и у преподователя есть оборудование, то записываем в оборудование адрес
		{
			$this->db->where('id',$id);
			$this->db->where('realaddress',$address);
			$this->db->from('educator');
			$count=$this->db->count_all_results();
			if($count!=1)
				{
					$this->db->where('education_id',$id);
					$this->db->where('location !=','ЦЛПДО');
					$array=array('location'=>$address);	
					$this->db->update('device_all',$array);
				}
		}
		
	public function count_teacher_work() // проверяем сколько временных без/с оборудованием
		{
			$this->db->where('work',1);
			$this->db->where('contract','0');
			$result=$this->db->count_all_results('educator');
			$this->db->where('work',1);
			$this->db->where('contract !=','0');
			$result.='/'.$this->db->count_all_results('educator');
			return $result;
		}
	
	public function count_teacher_nojob() //сколько преподователей работают но без оборудования и 
		{
			$this->db->where('work',0);
			$this->db->where('contract','0');
			$result=$this->db->count_all_results('educator');
			$this->db->where('work',0);
			$this->db->where('contract !=','0');
			$result.='/'.$this->db->count_all_results('educator');
			return $result;
		}
	
		
		
}
