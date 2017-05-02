<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class send_model extends CI_Model {
	

	public function arlet($array=false)
	/*
		$this->load->model('send_model');
		$array['error']['text']='Текст отображения для пользователя';
		$array['error']['status']=1; - Статус ошибки.(1-успех, 2-информационное, 3-предупреждение, 4-ошибка)
		$this->send_model->arlet($array);
	*/
		{
		if(!empty($array))
		{
		if(empty($array['error']['text'])) $array['error']['text']='Ошибка уведомления! Обратитесь к разработчику!';
		switch($array['error']['status'])
			{
				case 1: {$status='success'; $icon='fa-check'; break; } // успех зеленое сообщение
				case 2: {$status='info'; $icon='fa-info-circle'; break; } // информационное сообщение синее
				case 3: {$status='warning'; $icon='fa-check'; break; } // внимание желтое сообщение
				case 4: {$status='danger'; $icon='fa-check'; break;}  // опасно красное сообщение
				//default: {$status='danger'; $icon='fa-check'; $array['error']['text']='ERROR Switch! Обратитесь к разработчику!'; break;}
			}
		$result=' <br><div class="alert alert-'.$status.' alert-dismissible fade in shadowed" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-fw '.$icon.'"></i> '.$array['error']['text'].' 
                </div>';
        } else $result='';
            return $result;
		}
		
}
