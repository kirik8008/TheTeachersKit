<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public $data;

	public function __construct()
	{
	parent::__construct(); // ОБЯЗАТЕЛЬНО
		$this->data=array();
		$this->load->model('Auth_model');
		$this->data['user']=$this->Auth_model->authinfo;
		$this->Auth_model->check_();
		$this->load->model('category_model');
		$this->load->model('send_model');
	} 

	public function all($operation=false,$id=false) // отображение всех категорий договора
	{
		if((!empty($operation)) AND (!empty($id))) $this->category_model->operation($operation,$id);
		$category=$this->category_model->all_category();
		$this->load->view('menu',$this->data);
		$this->load->view('category_all',$category);
		$this->load->view('footer');
	}
	
	public function news() // добавление новой категории
	{
		$this->load->view('menu',$this->data);
		$this->data=array();
		if(!empty($_POST)) $this->data=$this->category_model->save_category($_POST);
		else $this->data['error']=$this->send_model->arlet();
		$this->load->view('category_news',$this->data);
		$this->load->view('footer');
	}
	
}
