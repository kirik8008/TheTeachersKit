<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_model extends CI_Model {
	
	public $db2;
	public function __construct()
		{
			$this->db2 = $this->load->database('users', TRUE);
			$this->load->helper('x99_helper');
			$this->load->model('teacher_model');
		}
		
//----------------------------------------------------------	

	public function users_all() // вывод информации о сотрудниках
		{
			$this->db->like('users_id', 'users_login','users_name','users_surname','users_middle','users_hide','user_stat','telegram_reg','users_dateactive');
			$result=$this->db2->get('users');
			$result=$this->handling($result->result_array());
			return $result;
		}
		
//----------------------------------------------------------	

	public function handling($array) // обработчик вывода пользователей!
		{
			$result=array();
			$k=0;
			foreach($array as $user)
				{
					$result[$k]=$user;
					switch($user['user_stat']) // статус пользователя
						{
							case 0: $result[$k]['user_stat']='Сотрудник'; break;
							case 2: $result[$k]['user_stat']='Разработчик'; break;
							case 3: $result[$k]['user_stat']='Администратор'; break;
							default: $result[$k]['user_stat']='Неизвестный';
						}
						
					switch($user['users_hide']) // заблокирован или активирован профиль сотрудника
						{
							case 0: $result[$k]['users_hide']='<span class="label label-success">Активный</span>'; break;
							case 1: $result[$k]['users_hide']='<span class="label label-warning">Заблокированный</span>'; break;
							default: $result[$k]['users_hide']='<span class="label label-danger">Неизвестный</span>';
						}
					
					switch($user['telegram_reg']) // зарегистрирован ли пользователь у бота в телеграме
						{
							case 0: $result[$k]['telegram_reg']='<span class="label label-default">Не зарегистрирован</span>'; break;
							case 1: $result[$k]['telegram_reg']='<span class="label label-success">Зарегистрирован</span>'; break;
							default: $result[$k]['telegram_reg']='<span class="label label-danger">Неизвестный</span>';
						}
					$result[$k]['data_to_active']=$this->teacher_model->getDateDiff($user['users_dateactive']); // время прошло с последней активности
					$coding_one=coding($user['users_id']); // кодирование id пользователя
					$coding_two=coding($user['users_login']); // кодирование логина пользователя
					$result[$k]['reset_password']='<a href="'.base_url().'administrator/resetpass/'.$coding_one.'/'.$coding_two.'" target="_blank" class="tooltip-test pull-right btn-xs btn btn-default" data-toggle="tooltip" data-placement="top" title="Сброс пароля на 12345678">!</a>';
					$k++;
				}
		return $result;
		}
		
//----------------------------------------------------------	
	
	public function resetpass($my,$coding_one,$coding_two) //сброс пароля сотрудника
		{
			$this->load->model('auth_model'); //подключение модели авторизации
			$data['user']=$this->auth_model->authinfo; // получение информации, кто ты.
			$this->load->view('menu',$data); // подгрузка меню
			 if(($my['user_stat']==3) OR ($my['user_stat']==2)) // проверяем статус пользователя (администратор или разработчик)
				{
					$coding_one=coding($coding_one,true); // расшифрововаем информацию о пользователе
					$coding_two=coding($coding_two,true);
					$new_pass=array('users_password'=>md5(md5('12345678')),'users_old_p'=>''); // кодируем новый пароль и сбрасываем его
					$this->db2->where('users_id',$coding_one); // ищем пользователя
					$this->db2->where('users_login',$coding_two);
					$temp=$this->db2->count_all_results('users'); //проверяем есть ли вообще такой пользоватлеь
					if($temp!=0) 
						{
						$this->db2->update('users',$new_pass,array('users_id'=>$coding_one,'users_login'=>$coding_two)); //записываем новый пароль
						$this->load->view('successfully'); // загрузка удачной страницы
						}  else $this->load->view('error_low');
				} else header('Location: '.base_url("info/block")); // если запрашивал страницу сотрудник то кидаем его на страницу блокировки

		$this->load->view('footer'); // подгружаем футер
		}
//----------------------------------------------------------
 // сохранение изменений в профиле
	public function save_data_profile($array)
		{
				$error=0;
				if(!empty($array['telephone'])) $update['users_phone']=$this->encrypt->encode($array['telephone']); // кодируем и готовим для внесения изменения
				if(!empty($array['email'])) $update['users_email']=$this->encrypt->encode($array['email']);
				if(!empty($array['old']) AND !empty($array['new']) AND !empty($array['retur']))
					{
						if($array['old']!='')
							{
								$this->load->model('auth_model'); //подключение модели авторизации
								$my=$this->auth_model->authinfo;
								if(md5(md5($array['old']))==$my['users_password'])
									{
										if(($array['new']==$array['retur']) AND ($array['new']!=''))
											{
												$update['users_password']=md5(md5($array['new']));
												$update['users_old_p']=password_hash($array['new'],PASSWORD_DEFAULT);
												$error=2;
												
												
											} else {$return['error']['text']='Новые пароли не совпадают!'; $return['error']['status']=4; $error=1; }
									} else {$return['error']['text']='Введенный вами пароль неверный! Обратитесь к разработчику для сброса пароля.'; $return['error']['status']=4; $error=1; }
							}
					}
				$this->Auth_model->db2->where('users_id',$this->data['user']['users_id']);
				$this->Auth_model->db2->update('users',$update);	
				if ($error==0) header('Location: '.base_url("user/profile"));
				if ($error==2) header('Location: '.base_url("user/logout"));
		return $return;
		}	
		
//----------------------------------------------------------
	// декодирование профиля
	public function decode_profile($array)
		{
			$array['user']['users_phone']=$this->encrypt->decode($array['user']['users_phone']);
			$array['user']['users_email']=$this->encrypt->decode($array['user']['users_email']);
			return $array;
		}	
	
		
		
}
