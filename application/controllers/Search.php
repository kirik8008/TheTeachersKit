<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

public $data;

	public function __construct()
	{
	parent::__construct(); // ОБЯЗАТЕЛЬНО
		$this->data=array();
		$this->load->model('Auth_model');
		$this->data['user']=$this->Auth_model->authinfo;
		$this->Auth_model->check_();
	} 
		


	

}
