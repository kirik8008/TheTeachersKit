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
		$this->load->model('kit_model');
		$this->load->model('send_model');
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
	
	public function view($id,$operation=false) // отображение пользователя
	{
		$error='';
		if(!empty($_POST['contract'])) $this->teacher_model->assignment_contract($_POST);
		if(!empty($_POST['date'])) $error=$this->teacher_model->new_date($_POST);
		if(!empty($operation)) 
			{
				$error=$this->kit_model->cancellation_kit($id,$operation);
				redirect('/teacher/view/'.$id, 'refresh');
			}
		$teachers=$this->teacher_model->search_educator($id);
		$teachers['error']=$this->send_model->arlet($error);
		$teachers['history']=$this->send_model->my_history($id); // отображение истории
		$this->load->view('menu',$this->data);
		$this->load->view('educator_view',$teachers);
		$this->load->view('footer');
	}
//$data['device']=$this->kit_model->kit($contract,$id);

	public function edit($id=false)
	{
		$error='';
		if(empty($id)) {$view='error_low'; $teachers=array();} else 
			{$view='educator_edit';
			$teachers=$this->teacher_model->search_educator($id,true);}
		if(!empty($_POST)) $this->teacher_model->edit_teacher($_POST,$id);
		$this->load->view('menu',$this->data);
		$this->load->view($view,$teachers);
		$this->load->view('footer');
	}
	
	
	
}
