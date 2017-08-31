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
		$this->load->model('kit_model'); // работа с комплектами
		$this->load->model('send_model'); // отправка сообщений и т п
		$this->load->model('device_model'); // работа с оборудованием
		$this->load->model('teacher_model'); // работа с преподователями
		$this->load->model('category_model'); // работа с категориями
		$this->load->helper('x99_helper');
		
	} 

	public function all() // отображение всех комплектов
	{
		$config['base_url'] = base_url().'kit/all/';
		$count=$this->kit_model->count_kit();
		$config['total_rows'] = $count['all'];
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
		
		$kit=$this->kit_model->all_kit($config['per_page'],$this->uri->segment(3));
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
		$data['csrf']=$this->Auth_model->csrf; // защита от CSRF
		$this->load->view('menu',$this->data);
		$this->load->view('kit_news',$data);
		$this->load->view('footer');
	}
	
	public function disband($contract) // расформирование комплекта
	{
		$this->load->helper('x99_helper');
		if(!empty($contract)) //проверяем есть ли вообще переменная
			{
				$array=array('contract'=>'0','education_id'=>0); //собираем массив для записи
				$this->db->where('contract',coding($contract,true)); // ищем по контракту(номеру договора)
				$this->db->update('device_all',$array);
				redirect('/kit/all', 'refresh');
			}
	
	}
	
	public function jpost() // получение пост от java
	{
		if(!empty($_POST)) $this->kit_model->jspost($_POST);
	}
	
	public function act_exemptions($id) // отображение акта-изъятия
	{
		$data['users']=$this->data;
		$data['device']=$this->kit_model->kit(false,$id);
		$this->load->helper('summa_helper');
		$data['price_all']=mass($data['device']);
		$data['teacher']=$this->teacher_model->search_educator($id);
		$this->load->view('act_exemptions',$data);
	}
	
	public function contract($id,$work) // отображение договора
	{
		$data['users']=$this->data;
		$data['device']=$this->kit_model->kit(false,$id);
		$this->load->helper('summa_helper');
		$data['price_all']=mass($data['device']);
		$data['teacher']=$this->teacher_model->search_educator($id,true);
		switch($work){
			case 11: $this->load->view('contract',$data); break;
			case 10: $this->load->view('contract',$data); break;}
	}
	
	public function view($id,$teacher,$operation=false) // отображение комплекта у преподователя
	{
		if(!empty($operation)) $data['error']=$this->kit_model->operation_kit($id,$teacher,$operation);
		$data['teacher']=$this->teacher_model->search_educator(coding($teacher,true));
		$data['teacher_kit']=$this->kit_model->kit(coding($id,true),coding($teacher,true));
		$data['storage']=$this->kit_model->storage_kit(coding($id,true),coding($teacher,true));
		$this->load->view('menu',$this->data);
		$this->load->view('kit_view',$data);
		$this->load->view('footer');
	}
	
	public function device($coding) // отображение комплекта без преподователя (свободный)
	{
		$data['contract']=coding($coding,true);
		$data['kit']=$this->kit_model->kit(coding($coding,true),false,1); //расшифровка номера договора.
		$this->load->view('menu',$this->data);
		$this->load->view('kit_view_device',$data);
		$this->load->view('footer');
	}
}
