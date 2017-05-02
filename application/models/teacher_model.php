<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class teacher_model extends CI_Model {
	
		public $authinfo;
		public $date;

	public function __construct()
		{
			//$db2 = $this->load->database('users', TRUE);
			
		}
		
	//----------------------------------------------------------	
		
	public function all_educator() // Вывод всех учителей
		{
			$count=$this->db->count_all('educator');
			if ($count!=0)
				{
					$que=$this->db->get('educator'); // получаем всё из базы
					$result['teacher']=$this->handler_educator($que->result_array()); //обробатываем
					$result['error']=0; //говорим что ошибок нет
				} else $result['error']=1; //если пользователей нет в БД то говорим что есть ошибка.
			$result['result_count']=$count;
			
			return $result;
		}
		
	public function handler_educator($array) // обработка вывода информации о преподователе.
		{
			$count=count($array); $x=-1;
			while($x++<$count-1)
				{
					switch($array[$x]['work']) //проверка совместитель или постоянный работник
						{
						case 1: $array[$x]['work']=base_url().'graphics/img/md/dark/person.svg'; break; //картинка если постоянный работник
						case 0: $array[$x]['work']=base_url().'graphics/img/md/dark/directions-walk.svg'; break; //картинка если совместитель
						case 11: $array[$x]['work']='Постоянный'; // текст вместо иконок
						case 10: $array[$x]['work']='Совместитель';
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
					
					switch($array[$x]['contract'])
						{
							case "0": {$array[$x]['contract']='Не закреплено!'; $array[$x]['visible_contract']='visible-xs hidden-xs'; break;}
							default: {$array[$x]['contract']=$array[$x]['contract']; $array[$x]['visible_contract']='';}
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
						'photo'=>$add['img'] // аватар
					);
					
					$this->db->insert('educator',$insert); // занесение в базу
					$objectid = $this->db->insert_id();   //получение номера под которым была занесена информация
					if(!empty($objectid)) // проверяем получили ли мы номер
						{ // при удачном обстоятельстве выдаем хорошее сообщение
							$data['error']['status']=1; 
							$data['error']['text']='Учитель <b>'.$array['surname'].' '.$array['realname'].'</b> успешно занесен в базу под номером '.$objectid;
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
		
		public function search_educator($idteacher) // поиск по id учителя
		{
			$result=$this->db->get_where('educator',array('id' => $idteacher),1); //поиск и вывод только одного
			$end=$result->result_array(); // вывод
			$end[0]['work']='1'.$end[0]['work']; // добавляем 1 вначало
			$end=$this->handler_educator($end); // отправляем в обработчик
			return $end[0];
		}
		
		
}
