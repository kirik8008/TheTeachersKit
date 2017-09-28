<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contract extends CI_Controller {

	public $data;

	public function __construct()
	{
	parent::__construct(); // ОБЯЗАТЕЛЬНО
		$this->data=array();
		$this->load->model('Auth_model');
		$this->data['user']=$this->Auth_model->authinfo;
		$this->Auth_model->check_();
		$this->load->model('contract_model');
		$this->load->model('teacher_model');
	} 

public function all() //  отображение всех договоров
	{
		$where=array('job'=>'1','contract !='=>'0');
		$this->db->where($where);
		$config['base_url'] = base_url().'contract/all/';
		$config['total_rows'] = $this->db->count_all_results('educator');
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
		$data=$this->contract_model->contract_teachers($config['per_page'],$this->uri->segment(3));
		$data['contract']=$this->teacher_model->handler_educator($data['contract']);
		$this->load->view('menu',$this->data);
		$this->load->view('contract_view',$data);
		$this->load->view('footer');
	}	

public function temporary() // отображение только временных
	{
		$where=array('work'=>'1','job'=>'1','contract !='=>'0');
		$this->db->where($where);
		$config['base_url'] = base_url().'contract/temporary/';
		$config['total_rows'] = $this->db->count_all_results('educator');
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
		$data=$this->contract_model->contract_teachers($config['per_page'],$this->uri->segment(3),'temporary');
		$data['contract']=$this->teacher_model->handler_educator($data['contract']);
		$this->load->view('menu',$this->data);
		$this->load->view('contract_temporary_view',$data);
		$this->load->view('footer');
	}
	
public function permanent() // отображение только временных
	{
		$where=array('work'=>'0','job'=>'1','contract !='=>'0');
		$this->db->where($where);
		$config['base_url'] = base_url().'contract/permanent/';
		$config['total_rows'] = $this->db->count_all_results('educator');
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
		$data=$this->contract_model->contract_teachers($config['per_page'],$this->uri->segment(3),'permanent');
		$data['contract']=$this->teacher_model->handler_educator($data['contract']);
		$this->load->view('menu',$this->data);
		$this->load->view('contract_permanent_view',$data);
		$this->load->view('footer');
	}
	
	
	
}
