<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

	public $data;

	public function __construct()
	{
	parent::__construct(); // ОБЯЗАТЕЛЬНО
		$this->data=array();
		$this->load->model('Auth_model');
		$this->data['user']=$this->Auth_model->authinfo;
		//$this->Auth_model->check_(); повтор
		$this->load->model('message_model');
		$this->message_model->authinfo = $this->data['user'];

	}


	public function index()
	{
		$this->load->view('menu',$this->data);
		$this->load->view('message_view');
		$this->load->view('footer');
	}


}
