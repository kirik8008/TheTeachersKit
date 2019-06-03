<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

		public $authinfo;
		public $date;
		public $db2;
		public $csrf;

/* от подделки межсайтовых запросов
$this->Auth_model->csrf;
<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
*/

	public function __construct()
		{
			$this->db2 = $this->load->database('users', TRUE);
			$this->load->library('session');
			$this->check_();
			$this->date=date("Y-m-d H:i:s");
			if(!empty($this->authinfo)) $this->block_user();
			$this->csrf = array(
        	'name' => $this->security->get_csrf_token_name(),
        	'hash' => $this->security->get_csrf_hash()
			);
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

 	//----------------------------------------------------------

 	function block_user()
 		{
 			$data=$this->authinfo;
 			if (($data['users_hide']!=0)AND($this->uri->segment(2)!='block')) header('Location: '.base_url("info/block"));
 		}


	//----------------------------------------------------------

	public function check_login($data) // проверка и пропуск.
	/*
	pitka_users - логин
	pitka_paska - пароль
	*/
		{
		$this->db2->where('users_name',$data['realname_users']);
		$this->db2->where('users_surname',$data['surname_users']);
		$query=$this->db2->get('users');
		$result=$query->result_array();
		if (count($result)==0) header('Location: '.base_url("user/login/notfound"));
		else
			{
				if ($result[0]['users_old_p']=='')
					{
						if ($result[0]['users_password']==md5(md5($data['ticket_paska'])))
							{
							$this->add_session($result[0]['users_id']);
							header('Location: '.base_url('user/edit/md5'));
							} else
						header('Location: '.base_url("user/login/incorrect"));
					}
				else
					{
						if (password_verify($data['ticket_paska'],$result[0]['users_old_p']))
							{
							$this->add_session($result[0]['users_id']);
							header('Location: '.base_url());
							} else
						header('Location: '.base_url("user/login/incorrect"));
					}

			}
		}

	//----------------------------------------------------------

	public function check_() //проверка авторизован ли пользователь
		{ //

			if (!empty($_SESSION['ticket_hash']) AND !empty($_SESSION['ticket_user']))
				{

					$query=$this->db2->get_where('users',array('users_id'=>$_SESSION['ticket_user']),1);
					$result=$query->result_array();
					if ($_SESSION['ticket_hash']==$result[0]['users_hash'])
						{
							$data=array('users_dateactive'=>$this->date);
							$this->db2->update('users',$data, array('users_id'=>$_SESSION['ticket_user']));
							unset($result[0]['users_hash'],$result[0]['users_password'],$result[0]['users_old_p']); // убираем ненужное!
							$this->authinfo=$result[0];
						} else {
							unset($_SESSION['ticket_hash'],$_SESSION['ticket_user']);
							header('Location: '.base_url('user/login'));
						}
				}
			else
				{
					$in=$this->uri->segment(1,'-');
					$aut=$this->uri->segment(2,'-');
					if ($aut != 'login')
						{
							header('Location: '.base_url('user/login'));
						}
				}
		}

	//----------------------------------------------------------

	public function add_session($data) // добавление сессии
		{
		$db2 = $this->load->database('users', TRUE);
		$hash = md5($this->generateCode(10));
		$session=array(
		'ticket_hash' => $hash,
		'ticket_user' => $data
		);
		$bd=array('users_hash'=>$hash);
		$db2->update('users',$bd,array('users_id'=>$data));
		$this->session->set_userdata($session);
		}

	//----------------------------------------------------------

	public function del_session() // удаление сессии
		{
			$db2 = $this->load->database('users', TRUE);
			$data=array('users_hash'=>' ');
			$db2->update('users',$data,array('users_id'=>$_SESSION['ticket_user']));
		unset(
			$_SESSION['ticket_hash'],
			$_SESSION['ticket_user']
			);
			echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL='.base_url().'">';

		}

	//----------------------------------------------------------

	public function userinfo() // информация о пользователе из сессии.
		{
			if (isset($_SESSION['ticket_hash']) AND isset($_SESSION['ticket_user']))
			{
				$query=$this->db2->get_where('users',array('users_id'=>$_SESSION['ticket_user']),1);
				$result=$query->result_array();
				$result[0]['users_password']=''; // затираем пароль
			}
			else $result=false;
			return $result;
		}
		//21 - rr
	//----------------------------------------------------------

	public function check_text($in) // проверка на запрещенные слова
		{
			if(preg_match("/script|http|&lt;|&gt;|&lt;|&gt;|SELECT|UNION|UPDATE|DROP|exe|exec|INSERT|tmp/i",$in))
			$out=''; else $out=$in;
			return $out;
		}




}
