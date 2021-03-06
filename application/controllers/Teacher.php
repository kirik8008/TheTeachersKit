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
		$this->load->helper('x99_helper');
	} 
	
	public function all() // отображение всех преподователей
	{
		$config['base_url'] = base_url().'teacher/all/';
		$config['total_rows'] = $this->db->count_all('educator');
		$config['per_page'] = 20;
		$config['full_tag_open'] = '<center><ul class="pagination">';
        $config['full_tag_close'] = '</ul></center>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = '«';
        $config['prev_link'] = '‹';
        $config['last_link'] = '»';
        $config['next_link'] = '›';
    	$config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';   
		$this->pagination->initialize($config);
		$teacher=$this->teacher_model->all_educator($config['per_page'],$this->uri->segment(3));
		//$teacher['check_skype_com']=$this->Auth_model->check_url();
		$this->load->view('menu',$this->data);
		$this->load->view('educator_all',$teacher);
		$this->load->view('footer');
	}
	
	public function news() // добавление нового преподователя
	{
		$this->load->view('menu',$this->data);
		if(!empty($_POST)) $this->data['error']=$this->teacher_model->newteacher($_POST);
		$data=$this->data;
		$data['csrf']=$this->Auth_model->csrf; // защита CSRF
		$this->load->view('educator_news',$data);
		$this->load->view('footer');
	}
	
	public function view($id,$operation=false,$variable=false) // отображение пользователя
	{
		$error='';
		if(!empty($_POST['contract'])) $this->teacher_model->assignment_contract($_POST);
		if(!empty($_POST['date'])) $error=$this->teacher_model->new_date($_POST);
		if(!empty($operation)) 
			{
				switch($operation)
					{
						case 'cancellation':
											{
												$id=coding($id,true);
												$error=$this->kit_model->cancellation_kit($id,$operation);
												redirect('/teacher/view/'.$id, 'refresh');
												break;
											}
						case 'remove_one_story':
											{
												$error=$this->send_model->delhistory($variable);
												break;
											}
						default: {$error['error']['text']='Неизвестный запрос'; $array['error']['status']=3;}
					}
				
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
			{
				$view='educator_edit';
				$teachers=$this->teacher_model->search_educator($id,true);
				$teachers['id_code']=coding($teachers['id']);
			}
		if(!empty($_POST)) $this->teacher_model->edit_teacher($_POST,$id);
		$this->load->view('menu',$this->data);
		$teachers['csrf']=$this->Auth_model->csrf; // защита CSRF
		$this->load->view($view,$teachers);
		$this->load->view('footer');
	}
	
	public function delete($id=false) // удаление преподователя
	{
		if(empty($id)) {$view='error_low';} else 
			{
				$view='please_wait';
				$this->teacher_model->delete_teacher($id);
			}
		$this->load->view('menu',$this->data);
		$this->load->view($view);
		$this->load->view('footer');
	}
	
	public function dismiss() // изменение статуса преподователя работает/не работает
	{
		$this->teacher_model->download_avatar(9,'nad_art');
	}
	
	
	
}
