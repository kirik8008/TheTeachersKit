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

public function view() // отображение преподователей с договорами
	{
		$operation=$this->uri->segment(3); // получаем сегмент 
		switch($operation) // смотрим что получили
			{
				case "permanent":  // Постоянные преподователи
					{
						$where=array('work'=>'0','job'=>'1','contract !='=>'0'); //поиск только постоянных с оборудованием
						$array=array('permanent','contract_view','permanent'); // сборка массива для дальнейшей разборки
						break;
					}
				case "temporary":  // Временные преподователи
					{
						$where=array('work'=>'1','job'=>'1','contract !='=>'0'); //поиск по временным с оборудованием
						$array=array('temporary','contract_view','temporary'); // сборка массива для дальнейшей разборки
						break;
					}
				default: // ПОстоянные и Временные вместе
					{
						$where=array('job'=>'1','contract !='=>'0'); //поиск по всем работающим преподователям с оборудованием
						$array=array('all','contract_view',false); // ну и сборка массива....
					}
			}	
		$this->db->where($where); // поиск
		$config['base_url'] = base_url().'contract/view/'.$array[0].'/';
		$config['total_rows'] = $this->db->count_all_results('educator'); // считаем сколько нашли
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
		$data=$this->contract_model->contract_teachers($config['per_page'],$this->uri->segment(4),$array[2]); //получаем нужную информацию
		$data['contract']=$this->teacher_model->handler_educator($data['contract']); // форматируем и обробатываем
		$this->load->view('menu',$this->data);
		$this->load->view($array[1],$data); // передаем в шаблон нужную информацию
		$this->load->view('footer');
	}	
}