<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class search_model extends CI_Model {
	
		public $authinfo;
		public $date;

	public function __construct()
		{
			//$db2 = $this->load->database('users', TRUE);
			$this->load->helper('x99_helper');
			
		}
		
	public function search_global($array)
		{
			//  $sql = "SELECT * FROM invnomber WHERE inv LIKE '%" . $word . "%' LIMIT ".$limit;
			$query = $this->db->query("
			SELECT id,name,inv,ser,price,work,contract,location,education_id,category FROM device_all WHERE inv LIKE '%".$array['search']."%'
			UNION 
			SELECT surname,realname,middlename,photo,work,job,contract,contract_date,id,person FROM educator WHERE surname LIKE '%".$array['search']."%' LIMIT 16");
			$query=$query->result_array();
			$this->constructor_result($query);
		}
		
	function constructor_result($array)
		{
			echo '
				<div class="container-fluid">
                <div class="row cm-fix-height">
                
                <div class="panel panel-default">
                    <div class="panel-heading">Быстрый Поиск по преподователям и оборудованию</div>
                    <div class="panel-body">
                        <p>'; 
              if(count($array)!=0)	{
              echo '<table class="table">';
              foreach($array as $table)
              	{
              			if(($table['id']-1)==-1)
              				{
              					echo '<tr>';
              					switch($table['ser'])
									{ // вывод аватара пользователя, если аватара нет то выводим аватар по полу
						 				case "0": {if($table['category']==1) $x='<img src="'.base_url().'graphics/photo/male.png" width="32" height="32" class="img-circle">'; else $x='<img src="'.base_url().'graphics/photo/female.png" width="32" height="32" class="img-circle">'; break;}
						 				default: $x='<img src="'.base_url().'graphics/photo/'.$table['category'].'" width="32" height="32" class="img-circle">';
									} 
              					echo '<td>'.$x.' '.$table['id'].' '.$table['name'].' '.$table['inv'].'</td>';
              					if($table['work']==1) echo '<td><span class="label label-success">Работает</span></td>'; else echo '<td><span class="label label-danger">Уволен</span></td>';
              					if($table['price']==1) echo '<td>Совместитель</td>'; else echo '<td>Постоянный</td>';
              					if($table['contract']!='0') echo '<td>'.$table['contract'].' (от '.$table['location'].')</td>'; else echo '<td>Договор не заключен.</td>';
              					echo '<td><a href="'.base_url().'teacher/view/'.$table['education_id'].'"><img src="'.base_url().'graphics/img/sf/user-id.svg" height="24" width="24"></a></td>';
              					echo '</tr>';
              					
              				} else
              				{
              					echo '<tr>';
              					echo '<td>'.$table['name'].' ('.$table['price'].' руб.)</td>';
              					echo '<td>'.$table['inv'].'</td>';
              					echo '<td>'.$table['ser'].'</td>';
              					echo '<td>'.$table['contract'].'</td>';
              					echo '<td>'.$table['location'].'</td>';
              					echo '</tr>';
              				}
              			
              			
              	}
              	echo '</table>';
              	} else echo 'Поиск результатов не дал...'; 
                        
        	echo'</p>
                    </div>
			';
		}
		
}
