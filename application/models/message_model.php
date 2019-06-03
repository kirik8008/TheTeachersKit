<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class message_model extends CI_Model {

		public $authinfo;
		public $date;
		private $users;

	public function __construct()
		{
			$this->load->helper('x99_helper');
			$this->load->library('parser'); // библиотека парсер
			$this->view_users_add_dialogs(); // вывод в переменную всех пользователей.
			print_r($this->users);
		}
/* Структура таблиц связанных с сообщениями
------------------------------------------------------------------------------------------
chats_room
|id_room|name_room|date_create|user_invitation|id_user|unread|
|ид комнаты|название комнаты|дата создания|кто пригласил|ид пользователя|непрочитанные|
------------------------------------------------------------------------------------------
chats_message
|id_message|id_room|date_send|id_user|message|
|ид сообщения|ид комнаты|дата отправки сообщения|ид отправителя|текст сообщения|
------------------------------------------------------------------------------------------
*/

//--------------------------------------------------------------
		function create_chats_room() // создание новой комнаты
		{

		}
//--------------------------------------------------------------

		function close_chats_room() // закрытие чата
		{

		}
//--------------------------------------------------------------

		function clear_chats_room() // очистка сообщений после удаления чата
		{

		}
//--------------------------------------------------------------

		function add_user_chats_room() // добавление пользователя в чат
		{

		}
//--------------------------------------------------------------

		function view_message_chats_room() // отображение сообщений в комнате
		{

		}
//--------------------------------------------------------------

		function view_chats_room() // отображение комнат(диалогов)
		{
				$chat_room = $this->db->get_where('chats_room',array('id_user'=>$this->authinfo['users_id']));
				$chat_room=$chat_room->result_array();
				if(count($chat_room)!=0)
					{
							$data_parser = array(
									'name' => $chat_room
							);
					}
				return $chat_room;
		}

//--------------------------------------------------------------

		function check_text() // проверка сообщения перед отправкой
		{

		}
//--------------------------------------------------------------

		function send_message() // отправка сообщения
		{

		}
//--------------------------------------------------------------

		function view_users_add_dialogs() // вывод всех пользователей
		{
			$this->db->select('users_id','users_name','users_surname','users_middle');
			$users_db=$this->db->get('users'); // выводим всех пользователей
			$users_db=$users_db->result_array();
			$users=array(); // пустой массив
			/* foreach ($users_db as $key) {
					$users[$key['users_id']]=array(
						'id' => $key['users_id'],
						'name' => $key['users_name'],
						'surname' => $key['users_surname'],
						'middle' => $key['users_middle'],
						'fio' => $key['users_surname'].' '.$key['users_name']
					);
			} */
			$this->users = $users;
			//return $users;
		}

//--------------------------------------------------------------

		function view_user_id($id) //вывод информации о пользователе по его ID
		{

		}

//--------------------------------------------------------------
}
