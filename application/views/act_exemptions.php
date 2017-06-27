<meta name="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
 @page { size: 21cm 29.7cm; margin-left: 3cm; margin-right: 1.5cm; margin-top: 2cm; margin-bottom: 2cm; }
   p {
    font-family: 'Times New Roman', Times, serif;
    font-size: 12pt;
	text-align: justify;
   }
 </style>

<p style="text-align: center;"><b>АКТ ИЗЪЯТИЯ ОБОРУДОВАНИЯ</b></p>
<p>г. Воронеж «____»_____________ 20___ г.</p>
<p>Мы, нижеподписавшиеся, комиссия КОУ ВО «ЦЛПДО» в составе</p>
<p>________________________________________________________________________________</p>
<p style="text-align: left;">с одной стороны, и преподователь <b><ins><?=$teacher['surname'];?> <?=$teacher['realname'];?> <?=$teacher['middlename'];?></ins></b>
с другой стороны, составили настоящий Акт о нижеследующем:</p>
<p>Во исполнении пункта 7.1 договора № <?=$teacher['contract'];?> от «<? $d = explode(' ',$teacher['contract_date']); echo $d[0]; ?>» <ins><?=$d[1];?></ins> <?=$d[2];?> г. КОУ ВО «ЦЛПДО» изымает у Преподователя следующее оборудование, находящееся в исправном состоянии.</p>
<p style="text-align: center;"><b>ПЕРЕЧЕНЬ ОБОРУДОВАНИЯ</b></p>
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
<p>Стоимость оборудования, передаваемого по Акту, составляет <?=$price_all['rub'];?> р. <?=$price_all['cop'];?> коп. (<?=$price_all['text'];?>).</p>
<p>Настоящий Акт изъятия оборудования составлен в 2 (двух) экземплярах, по одному для каждой из сторон.</p>

<table style="width: 100%;">
<tr>
<td><p>Комиссия КОУ ВО «ЦЛПДО»</p></td>
<td><p style="text-align: right;">Преподователь</p></td>
</tr>
<tr>
<td><p>________________/____________/</p></td>
<td ><p style="text-align: right;">_______________/<ins><?=$teacher['surname'];?> <? echo mb_substr($teacher['realname'], 0, 1);?>. <? echo mb_substr($teacher['middlename'], 0, 1);?>.</ins>/</p></td>
</tr>
<tr>
<td><p>________________/____________/</p></td>
<td><p style="text-align: right; font-size: 8pt;">(Ф.И.О. преподователя)</p>
</td>
</tr>
</table>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;МП.</p>