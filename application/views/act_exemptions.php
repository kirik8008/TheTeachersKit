<ins><?=$teacher['surname'];?> <?=$teacher['realname'];?> <?=$teacher['middlename'];?></ins>
Номер договора <?=$teacher['contract'];?> 
Дата договора «<? $d = explode(' ',$teacher['contract_date']); echo $d[0]; ?>» <ins><?=$d[1];?></ins> <?=$d[2];?> г.
Стоимость <?=$price_all['rub'];?> р. <?=$price_all['cop'];?> коп. (<?=$price_all['text'];?>).
 
<p style="text-align: right; margin-bottom:0; page-break-before: always;"><b>Приложение 1</b></p>
<p style="text-align: center; margin-bottom:0;"><b>ПЕРЕЧЕНЬ ОБОРУДОВАНИЯ</b></p>
<br>


<?php


echo "<table style=\"border: 1px solid #000; border-collapse: collapse; width: 100%;\" cellpadding=\"0\" cellspacing=\"0\">
<tr>
<td style=\"border: 1px solid #000; width: 5%;\" cellpadding=\"0\" cellspacing=\"0\"><p style=\"text-align: center;\">№ П/П</p></td>
<td style=\"border: 1px solid #000; width: 25%;\" cellpadding=\"0\" cellspacing=\"0\"><p style=\"text-align: center;\">Наименование и основные характеристики</p></td>
<td style=\"border: 1px solid #000; width: 25%;\" cellpadding=\"0\" cellspacing=\"0\"><p style=\"text-align: center;\">Заводской номер</p></td>
<td style=\"border: 1px solid #000; width: 25%;\" cellpadding=\"0\" cellspacing=\"0\"><p style=\"text-align: center;\">Инвентарный номер</p></td>
<td style=\"border: 1px solid #000; width: 10%;\" cellpadding=\"0\" cellspacing=\"0\"><p style=\"text-align: center;\">Количество</p></td>
<td style=\"border: 1px solid #000; width: 10%;\" cellpadding=\"0\" cellspacing=\"0\"><p style=\"text-align: center;\">Стоимость имущества</p></td>
</tr>";
$x=0;
foreach($device as $dv)
	{
		$x++; 
		echo "
			<tr>
			<td style=\"border: 1px solid #000; width: 5%;\" cellpadding=\"0\" cellspacing=\"0\"><p style=\"text-align: center;\">".$x."</p></td>
			<td style=\"border: 1px solid #000; width: 25%;\" cellpadding=\"0\" cellspacing=\"0\"><p style=\"text-align: left;\">".$dv['name']."</p></td>
			<td style=\"border: 1px solid #000; width: 25%;\" cellpadding=\"0\" cellspacing=\"0\"><p style=\"text-align: left;\">".$dv['ser']."</p></td>
			<td style=\"border: 1px solid #000; width: 25%;\" cellpadding=\"0\" cellspacing=\"0\"><p style=\"text-align: left;\">".$dv['inv']."</p></td>
			<td style=\"border: 1px solid #000; width: 10%;\" cellpadding=\"0\" cellspacing=\"0\"><p style=\"text-align: center;\">1</p></td>
			<td style=\"border: 1px solid #000; width: 10%;\" cellpadding=\"0\" cellspacing=\"0\"><p style=\"text-align: left;\">".$dv['price']."</p></td>
			</tr>";
		
	}

echo
"<tr>

<td style=\"border: 1px solid #000; width: 25%;\" COLSPAN=5 cellpadding=\"0\" cellspacing=\"0\"><p>ИТОГО:</p></td>
<td style=\"border: 1px solid #000; width: 10%;\" cellpadding=\"0\" cellspacing=\"0\"><p>".$price_all['all']."</p></td>
</tr>
</table>";





?>
