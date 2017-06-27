<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {

public $data;

	public function __construct()
	{
	parent::__construct(); // ОБЯЗАТЕЛЬНО
		$this->data=array();
		$this->load->model('Auth_model');
		$this->data['user']=$this->Auth_model->authinfo;
		$this->Auth_model->check_();
		$this->load->model("search_model");
	} 
		

	public function block()
	{
		$data['error']='';
		$data['text']='Проект находится на стадии разработки, доступ к CMS ограничен разработчиком.';
		$this->load->view('menu',$this->data);
		$this->load->view('info',$data);
		$this->load->view('footer');
	}
	
	public function test()
	{

		if(!empty($_POST))
		$this->search_model->search_global($_POST);
		 else echo '
		<div class="container-fluid">
                <div class="row cm-fix-height">
                
                <div class="panel panel-default">
                    <div class="panel-heading">Результат поиска</div>
                    <div class="panel-body">
                        <p>Неверный запрос!</p>
                    </div>
                </div>
            </div>
            
		';
	}
	
	public function test2($ee)
	{
		//$query = $this->db->query("SELECT surname,realname,middlename,realaddress,work,job,contract,contract_date FROM educator WHERE surname LIKE '%".$ee."%' UNION SELECT id,name,inv,ser,price,work,education_id,location FROM device_all WHERE inv LIKE '%".$ee."%' LIMIT 16");
		$query = $this->db->query("SELECT id,name,inv,ser,price,work,education_id,location FROM device_all WHERE inv LIKE '%".$ee."%' UNION SELECT surname,realname,middlename,realaddress,work,job,contract,contract_date FROM educator WHERE surname LIKE '%".$ee."%' LIMIT 16");
		$query=$query->result_array();
		print_r($query);
	}
}
