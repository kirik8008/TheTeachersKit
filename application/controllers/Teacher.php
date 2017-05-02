<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {

	public $data;

	public function __construct()
	{
	parent::__construct(); // ОБЯЗАТЕЛЬНО
		$this->data=array();
		$this->load->model('Auth_model');
		$this->data['user']=$this->Auth_model->authinfo;
		$this->Auth_model->check_();
		$this->load->model('teacher_model');
	} 
	
	public function all() // отображение всех преподователей
	{
		$teacher=$this->teacher_model->all_educator();
		$this->load->view('menu',$this->data);
		$this->load->view('educator_all',$teacher);
		$this->load->view('footer');
	}
	
	public function news() // добавление нового преподователя
	{
		$this->load->view('menu',$this->data);
		if(!empty($_POST)) $this->data['error']=$this->teacher_model->newteacher($_POST);
		$this->load->view('educator_news',$this->data);
		$this->load->view('footer');
	}
	
	public function view($id)
	{
		$teachers=$this->teacher_model->search_educator($id);
		$this->load->view('menu',$this->data);
		$this->load->view('educator_view',$teachers);
		$this->load->view('footer');
	}
}
