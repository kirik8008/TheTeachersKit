<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {

public $db2;

	public function __construct()
	{
	parent::__construct(); // ОБЯЗАТЕЛЬНО
	$this->db2 = $this->load->database('users', TRUE);
	} 


public function aut($active) // проверка есть такой пользователь и авторизован ли он.
	{
	/*
	собираем запрос
	http://сайт/teacher/API/aut/{куки}
	если пользователь найден то собираем немножно информации по нему.
	*/
		//$this->db2->where('users_hash',$active);
		$qs=$this->db2->get_where('users',array('users_hash'=>$active),1);
		$return=$qs->result_array();
		if (count($return)==1) 
			{ 
				$data=$return[0]['users_login'].'='.$return[0]['users_name']; 
				if($return[0]['user_stat']!==1) $data.='=9';
					else $data.='=0';
			}
		else $data='error=error';
		echo $data;
	}
	
}
