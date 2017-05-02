<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kit extends CI_Controller {

	public $data;

	public function __construct()
	{
	parent::__construct(); // ОБЯЗАТЕЛЬНО
		$this->data=array();
		$this->load->model('Auth_model');
		$this->data['user']=$this->Auth_model->authinfo;
		$this->Auth_model->check_();
		$this->load->model('kit_model');
	} 

	public function all() // отображение всех комплектов
	{
		$kit=$this->kit_model->all_kit();
		$this->load->view('menu',$this->data);
		$this->load->view('kit_all',$kit);
		$this->load->view('footer');
	}
}
