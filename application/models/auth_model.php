<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	
		public $authinfo;
		public $date;

	public function __construct()
		{
			$db2 = $this->load->database('users', TRUE);
			$this->load->library('session');
			$this->check_();
			$this->date=date("Y-m-d H:i:s");
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
	
	public function check_login($data) // проверка и пропуск.
	/*
	pitka_users - логин
	pitka_paska - пароль
	*/
		{
		$db2 = $this->load->database('users', TRUE);
		//$this->db->where('users_login',$data['ticket_users']);
		//$this->db->limit('1');
		$query=$db2->get_where('users',array('users_login'=>$data['ticket_users']),1);
		$result=$query->result_array();
		if ($result[0]['users_password']==$data['ticket_paska'])
			{
			$this->add_session($result[0]['users_id']);
			header('Location: '.base_url()); 
			} else
		header('Location: '.base_url("user/login")); 
		}
	
	//----------------------------------------------------------
	
	public function check_() //проверка авторизован ли пользователь
		{ //
		
			if (!empty($_SESSION['ticket_hash']) AND !empty($_SESSION['ticket_user'])) 
				{
					$db2 = $this->load->database('users', TRUE);
					//$this->db->where('users_id',$_SESSION['ticket_user']);
					//$this->db->limit('1');
					$query=$db2->get_where('users',array('users_id'=>$_SESSION['ticket_user']),1);
					$result=$query->result_array();
					if ($_SESSION['ticket_hash']==$result[0]['users_hash'])
						{
							$data=array('users_dateactive'=>$this->date);
							//$this->db->where('users_id',$_SESSION['ticket_user']);
							$db2->update('users',$data, array('users_id'=>$_SESSION['ticket_user']));
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
		//$this->db->where('users_id',$data);
		$db2->update('users',$bd,array('users_id'=>$data));
		$this->session->set_userdata($session);
		}
	
	//----------------------------------------------------------
	
	public function del_session() // удаление сессии
		{
			$db2 = $this->load->database('users', TRUE);
			$data=array('users_hash'=>' ');
			//$this->db->where('users_id',$_SESSION['ticket_user']);
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
				//$this->db->limit('1');
				//$this->db->where('users_id',$_SESSION['ticket_user']);
				$query=$db2->get_where('users',array('users_id'=>$_SESSION['ticket_user']),1);
				$result=$query->result_array();
			} 
			else $result=false;
			return $result;
		}
		
	
		
}
