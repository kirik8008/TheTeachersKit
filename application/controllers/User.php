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
	} 
		

	public function index()
	{
		$this->load->view('menu',$this->data);
		$this->load->view('index');
		$this->load->view('footer');
	}
	
	public function login()  // форма входа
	{
		if (!empty($_POST['ticket_users']))
		{
			if ((!empty($_POST['ticket_users'])) AND (!empty($_POST['ticket_paska'])))
				{
				$data=array(
				'ticket_users'=> $_POST['ticket_users'],
				'ticket_paska'=>md5(md5($_POST['ticket_paska'])));
				$this->Auth_model->check_login($data);
				}
		} else 
		$this->load->view('login');
	}

	public function logout() //выход 
	{
	$this->Auth_model->del_session();
	}
}
