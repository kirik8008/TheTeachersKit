<?


	function alfavit()
		{
		$abc = array('Cube','99',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		foreach (range(chr(0xC0), chr(0xDF)) as $b)
    	$abc[] = iconv('CP1251', 'UTF-8', $b);
		foreach (range('A', 'Z') as $letter) {
    	$abc[]=$letter;
		}
		
		$abc = array_merge($abc, array('?','(','@',';','$','#',"]","&",'*',':',',') );
		$abc = array_merge($abc, array('!',')','_','+','|','%','/','[','.',' ','Ё','-') );
		$abc = array_merge($abc, array('1','2','3','4','5','6','7','8','9','0') );
		return($abc);
		}
		
	function coding($str,$encode=false) //(текст,true) - расшифровка
		{
		$abc=alfavit();
		if ($encode==false)
			{
			$str=mb_strtoupper($str, "UTF-8");
			$mass = preg_split('//u',$str,-1,PREG_SPLIT_NO_EMPTY);
			$k=count($mass);
			$x=-1;
			$mm=rand(1,3);
			$gg=rand(0,9);
			$result=$mm.$gg;
			$okl=count($abc)-1;
			while($x++<$k-1)
				{
					$x_l=18;
					while($x_l++<$okl)
						{
							if ($mass[$x]==$abc[$x_l]) $result=$result.dechex($x_l-$mm);
						}
				}
			} else
			{
			$mass = str_split($str,2);
			$k=count($mass);
			$mms=$mass[0][0];
			$x=0; 
			$ress=''; $bukva=array();
			while($x++<$k-1)
				{
					$hggdfs=hexdec($mass[$x]);
					$bukva[]=$hggdfs+$mms;
				}
			$k=count($bukva);
			$x=-1; $result='';
			while ($x++<$k-1)
				{
					$result=$result.$abc[$bukva[$x]];
				}
			}
		return(ucfirst(mb_strtolower($result, 'UTF-8')));
		}

?>