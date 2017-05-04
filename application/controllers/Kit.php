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
		$this->load->model('send_model');
		$this->load->model('device_model');
		$this->load->model('category_model');
	} 

	public function all() // отображение всех комплектов
	{
		$kit=$this->kit_model->all_kit();
		$this->load->view('menu',$this->data);
		$this->load->view('kit_all',$kit);
		$this->load->view('footer');
	}
	
	public function news() // сборка нового комплекта
	{
		$data=$this->category_model->all_category();
		$data['device']=$this->device_model->device_category();
		if(!empty($_POST)) 
		{
			$data['error']=$this->kit_model->check_form($_POST);
		}
		$this->load->view('menu',$this->data);
		$this->load->view('kit_news',$data);
		$this->load->view('footer');
	}
	
	public function jpost() // получение пост от java
	{
		if(!empty($_POST)) $this->kit_model->jspost($_POST);
	}
}
