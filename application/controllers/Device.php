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
		$this->load->model('category_model');
	} 

	public function all() // отображение всего оборудования
	{
		$config['base_url'] = base_url().'device/all/';
		$config['total_rows'] = $this->db->count_all('device_all');
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
		$data=$this->device_model->all_device($config['per_page'],$this->uri->segment(3));
		$this->load->view('menu',$this->data);
		$this->load->view('device_all',$data);
		$this->load->view('footer');
	}
	
	public function news() // добавление нового оборудования 
	{
		$data=$this->category_model->all_category();
		if(!empty($_POST)) $data['error']=$this->device_model->save_device($_POST);
		$this->load->view('menu',$this->data);
		$this->load->view('device_news',$data);
		$this->load->view('footer');
	}
	
	public function test()
	{
		if(!empty($_POST)) $this->device_model->jspost($_POST);
	}
	
	public function test2()
	{
		$data=$this->category_model->all_category();
		$data['device']=$this->device_model->device_category();
		
		$this->load->view('menu',$this->data);
		//$this->load->view('dinamic_view',$data);
		$this->load->view('kit_news',$data);
		$this->load->view('footer');
		//$this->device_model->jspost(2);
		//echo $this->Auth_model->generateCode(6,true);
		//echo '<hr>';
		//print_r($data);
		//echo $q[18][0]['name'];
	}
	
}
