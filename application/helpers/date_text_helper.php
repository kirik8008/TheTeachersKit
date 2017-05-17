<?
function _date($date) //формат 2017-02-01 (год-месяц-число)
		{
			switch(mb_substr($date,5,2))
				{
				case '01': $month='Января'; break;
				case '02': $month='Февраля'; break;
				case '03': $month='Марта'; break;
				case '04': $month='Апреля'; break;
				case '05': $month='Мая'; break;
				case '06': $month='Июня'; break;
				case '07': $month='Июля'; break;
				case '08': $month='Августа'; break;
				case '09': $month='Сентября'; break;
				case '10': $month='Октября'; break;
				case '11': $month='Ноября'; break;
				case '12': $month='Декабря'; break;
				default: $month='??';
				}
			$result['year']=mb_substr($date,0,4);
			$result['month']=$month;
			$result['day']=mb_substr($date,8,2);	
			return $result;
		}
?>