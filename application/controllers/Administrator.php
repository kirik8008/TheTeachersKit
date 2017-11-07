<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public $data;

	public function __construct()
	{
	parent::__construct(); // ОБЯЗАТЕЛЬНО
		$this->data=array();
		$this->load->model('Auth_model');
		$this->data['user']=$this->Auth_model->authinfo;
		$this->Auth_model->check_();
		$this->load->model('admin_model');
		$this->load->model('send_model');
	} 
		

	public function staff() // вывод сотрудников
	{
		$data['users']=$this->admin_model->users_all();
		$this->load->view('menu',$this->data);
		$this->load->view('staff_all',$data);
		$this->load->view('footer');
	}
	
	public function resetpass($coding_one,$coding_two) //сброс пароля
	{
		$this->admin_model->resetpass($this->data['user'],$coding_one,$coding_two);
	}
	
	public function backup($active=false,$id=false) // бекап базы
	{
		switch($active)
			{
				case "create": { $this->admin_model->backup($id);}
				default : {
							$data['backup']=$this->admin_model->all_backup(); 
							$data['count_backup']=count($data['backup']);
						}
			}
			$this->load->view('menu',$this->data);
			$this->load->view('backup',$data);
			$this->load->view('footer');
	}
	
	
}
