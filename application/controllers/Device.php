<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Device extends CI_Controller {

	public $data;

	public function __construct()
	{
	parent::__construct(); // ОБЯЗАТЕЛЬНО
		$this->data=array();
		$this->load->model('Auth_model');
		$this->data['user']=$this->Auth_model->authinfo;
		$this->Auth_model->check_();
		$this->load->model('send_model');
		$this->load->model('device_model');
		$this->load->model('teacher_model');
		$this->load->model('category_model');
		$this->load->helper('summa_helper');
		$this->load->helper('x99_helper');
	} 

	public function all() // отображение всего оборудования
	{
		$config['base_url'] = base_url().'device/all/';
		$config['total_rows'] = $this->db->count_all('device_types');
		$config['per_page'] = 50;
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
		$data=$this->device_model->all_types($config['per_page'],$this->uri->segment(3));
		$this->load->view('menu',$this->data);
		$this->load->view('types_all',$data);
		$this->load->view('footer');
	}
	
	public function view_device($types=false,$error=false)
	{
		$this->load->view('menu',$this->data);
		if(!empty($types))
			{
				$config['base_url'] = base_url().'device/view_device/'.$types;
				$config['total_rows'] = $this->device_model->count_device_group($types);
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
				$data=$this->device_model->all_device_group($types,$config['per_page'],$this->uri->segment(4));
				$data['types']=$types;
				if(!empty($error) AND $error=='equipment_used'){ $ts['error']=array('text'=>'Оборудование используется!', 'status'=>3); $data['error']=$this->send_model->arlet($ts);}
				$this->load->view('device_group_types',$data);
			} else $this->load->view('error_low');
		$this->load->view('footer');
	}
	
	public function news() // добавление нового оборудования 
	{
		$data=$this->category_model->all_category();
		if(!empty($_POST)) $data['error']=$this->device_model->save_device($_POST);
		$this->load->view('menu',$this->data);
		$data['csrf']=$this->Auth_model->csrf;
		$this->load->view('device_news',$data);
		$this->load->view('footer');
	}
	
	public function act_faulty($id,$teacher) // отображение акта изъятия не исправного оборудования
	{
		$data['users']=$this->data;
		$data['device']=$this->device_model->search_device($id,$teacher);
		$data['price_all']=mass($data['device']);
		$data['teacher']=$this->teacher_model->search_educator(coding($teacher,true));
		$this->load->view('act_faulty',$data);
	}
	
	public function clean_device($type)  // очистка(удаление) оборудования безвозвратно.
	{
		if(!empty($type)) 
			{
				$result_delete=$this->device_model->clean_device($type); // само удаление
				if($result_delete) redirect('device/all', 'refresh'); else redirect('device/view_device/'.$type.'/equipment_used', 'refresh'); //результат
			}	
	}
	
	public function test()
	{
		if(!empty($_POST)) $this->device_model->jspost($_POST);
	}
	
	
	
}
