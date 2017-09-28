<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class contract_model extends CI_Model {
	
	public function __construct()
		{
			
		}
		
	//----------------------------------------------------------	
		
	public function permanent_teachers_equipment() // постоянные преподаватели с оборудованием (только подсчет)
		{
			$where=array('work'=>'0','job'=>'1','contract !='=>'0');
			$this->db->where($where);
			$pte=$this->db->count_all_results('educator');
			return $pte;
		}
		
	public function temporary_teachers_equipment() // временные преподаватели с оборудованием (только подсчет)
		{
			$where=array('work'=>'1','job'=>'1','contract !='=>'0');
			$this->db->where($where);
			$tte=$this->db->count_all_results('educator');
			return $tte;
		}
		
	public function temporary_expired_contract() // временные преподаватели с просроченными договорами (только подсчет)
		{
			$date_temp=explode('-',date("Y-m-d"));
			if($date_temp[1]<6) $date_temp[0]=$date_temp[0]-1; // находим год начала учебного года.
			$where=array('work'=>'1','job'=>'1','contract_date <'=>$date_temp[0].'-05-31'); // выводим информацию о заключенных ранее 31 мая **** года
			$this->db->where($where);
			$tec=$this->db->count_all_results('educator');
			return $tec;
		}
		
	public function contract_teachers($num,$offset,$status=false) // сбор массива для страницы: краткая информация по договорам
		{
			$return['pte']=$this->permanent_teachers_equipment();
			$return['tte']=$this->temporary_teachers_equipment();
			$return['tec']=$this->temporary_expired_contract();
			if ($return['tec']>0) $return['tec_info']=$this->info_temporary_expired_contract();
			$return['contract']=$this->all_signed_contract($num,$offset,$status);
			return $return;
		}
		
	public function info_temporary_expired_contract() // информация об учителях с истекшим договором
		{
			$date_temp=explode('-',date("Y-m-d"));
			if($date_temp[1]<6) $date_temp[0]=$date_temp[0]-1; // находим год начала учебного года.
			$where=array('work'=>'1','job'=>'1','contract_date <'=>$date_temp[0].'-05-31'); // выводим информацию о заключенных ранее 31 мая **** года
			$this->db->select('id,surname,realname,middlename,telephone,contract,contract_date'); // выводим только нужную информацию.
			$this->db->where($where);
			$dbase=$this->db->get('educator');
			$info=$dbase->result_array();
			return $info;
		}
	
	public function all_signed_contract($num,$offset,$status=false) // вывод всех договоров: заключенный и просроченных
	/*
	Если $status пустой то выводим и все договора
	если $status = 'temporary' то выводим только временных
	если $status = 'permanent' то выводим постоянные
	*/
		{
			switch ($status)
				{
					case "temporary": $where=array('work'=>'1','job'=>'1','contract !='=>'0'); break;
					case "permanent": $where=array('work'=>'0','job'=>'1','contract !='=>'0'); break;
					default: $where=array('job'=>'1','contract !='=>'0');
				}
			$this->db->where($where);
			$this->db->order_by('contract_date');
			$temp=$this->db->get('educator',$num,$offset);
			$result=$temp->result_array();
			return $result;
		}
			
}