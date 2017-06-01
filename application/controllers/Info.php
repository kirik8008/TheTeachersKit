<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {

public $data;

	public function __construct()
	{
	parent::__construct(); // ОБЯЗАТЕЛЬНО
		$this->data=array();
		$this->load->model('Auth_model');
		$this->data['user']=$this->Auth_model->authinfo;
		$this->Auth_model->check_();
	} 
		

	public function block()
	{
		$data['error']='';
		$data['text']='Проект находится на стадии разработки, доступ к CMS ограничен разработчиком.';
		$this->load->view('menu',$this->data);
		$this->load->view('info',$data);
		$this->load->view('footer');
	}
	
}
