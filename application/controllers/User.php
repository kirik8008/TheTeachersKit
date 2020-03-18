<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public $data;

	public function __construct()
	{
	parent::__construct(); // ОБЯЗАТЕЛЬНО
		$this->data=array();
		$this->load->model('Auth_model');
		$this->data['user']=$this->Auth_model->authinfo;
		$this->Auth_model->check_();
		$this->load->model('send_model');
		$this->load->model('Admin_model');
		$this->load->model('Contract_model');
	}


	public function index()
	{
		$this->load->model('kit_model');
		$this->load->model('device_model');
		$this->load->model('teacher_model');
		$data=$this->kit_model->count_kit();
		$data['in_stock']=count($this->kit_model->all_free_kit());
		$data['nonworking']=$this->device_model->nowork();
		$data_temp=$this->teacher_model->all_educator(0,0);
		$data['allteacher']=$data_temp['result_count'];
		$data['expired']=$this->Contract_model->temporary_expired_contract();
		$data['job']=$this->teacher_model->count_teacher_nojob();
		$this->load->view('menu',$this->data);
		$this->load->view('index',$data);
		$this->load->view('footer');
	}

	public function login($error=false,$apiurl=false)  // форма входа
	{

		if (!empty($_POST['realname_users']))
		{
			if ((!empty($_POST['surname_users'])) AND (!empty($_POST['ticket_paska'])))
				{
				$data=array(
				'surname_users'=> $_POST['surname_users'],
				'realname_users'=> $_POST['realname_users'],
				'ticket_paska'=>$_POST['ticket_paska']);
				if(!empty($apiurl)) $data['return_url']=$apiurl; //если есть запрос авторизации то пропускаем url
				$this->Auth_model->check_login($data);
				}
		} else
			{
				if(!empty($error))  // проверяем есть ли пометка на ошибку
					{
						switch($error)
							{
								case 'incorrect': $error_['error']['text']='Неверный пароль!'; break;
								case 'notfound': $error_['error']['text']='Пользователь не найден!'; break;
								case 'api': {if (!empty($apiurl)) $error_['error']['text']='Запрос авторизации со страницы <b>'.str_replace('_','/',$apiurl).'</b> если вы не переходили с указанной страницы, то просто закройте текущее окно! '; else $error_['error']['text']='Аутентификация с НЕИЗВЕСТНОЙ страницы'; break;}
								default : $error_['error']['text']='Ошибка аутентификации';
							}
						$error_['error']['status']=4;
						$send['error']=$this->send_model->arlet($error_);
					} else {unset($send); //если нет то удаляем send
				//$this->load->view('login',$send);
				}// открываем страницу
			}
		$send["csrf"]=$this->Auth_model->csrf;
		$this->load->view('login',$send);
	}

	public function logout() //выход
	{
	$this->Auth_model->del_session();
	}

	public function profile() // отображение профиля
	{
		$this->load->view('menu',$this->data); // подключение меню
		$data=$this->data;
		$data['history']=$this->send_model->history_author($data['user']['users_id']);
		$this->load->view('profile',$this->Admin_model->decode_profile($data));
		$this->load->view('footer'); // вывод футера
	}

	public function edit($newpass=false)
	{
		if(!empty($_POST))
			{
				$this->data['error']=$this->send_model->arlet($this->Admin_model->save_data_profile($_POST));
				//header('Location: '.$_POST['referrer']);
			}
		if(!empty($newpass) AND $newpass=='md5') { $pas['error']['text']='Система обнаружила, что <b>вы используете старый метод хэширование пароля</b>, для вашей же безопасности рекомендуем вам <b>сменить пароль</b> (Пароль при желании можно не менять, а просто пройти повторную смену пароля)'; $pas['error']['status']=3; $this->data['error']=$this->send_model->arlet($pas); }
		$this->data['csrf']=$this->Auth_model->csrf;
		$this->load->view('menu',$this->data); // подключение меню
		$this->load->view('profile_edit',$this->Admin_model->decode_profile($this->data));
		$this->load->view('footer'); // вывод футера
	}
}
