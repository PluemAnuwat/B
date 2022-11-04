<?PHP
function thaistart1($ttt)
	{
		$d1 = substr($ttt, 0, 2);
		$m1 = substr($ttt, 3, 2);
		$y = substr($ttt, 6, 4) ;
		$y1 = $y-543;
		$h1 = substr($ttt, 10, 6);
		if ($ttt == "")
		{
			return "";
		} else
		{
			return $y1 . "-" . $m1 . "-" . $d1;
		}
	}

function thaistart2($bbb)
	{
		$d2 = substr($bbb, 8, 2);
		$m2 = substr($bbb, 5, 2);
		$y3 = substr($bbb, 0, 4) ;
		$h2 = substr($bbb, 10, 6);
		$y4=$y3+"543";
	if($m2=="01"){$m2="มกราคม";}
	if($m2=="02"){$m2="กุมภาพันธ์";}
	if($m2=="03"){$m2="มีนาคม";}
	if($m2=="04"){$m2="เมษายน";}
	if($m2=="05"){$m2="พฤษภาคม";}
	if($m2=="06"){$m2="มิถุนายน";}
	if($m2=="07"){$m2="กรกฎาคม";}
	if($m2=="08"){$m2="สิงหาคม";}
	if($m2=="09"){$m2="กันยายน";}
	if($m2=="10"){$m2="ตุลาคม";}
	if($m2=="11"){$m2="พฤศจิกายน";}
	if($m2=="12"){$m2="ธันวาคม";}
		if ($bbb == "")
		{
			return "";
		} else
		{
			//return $y1 . "-" . $m1 . "-" . $d1. "" . $h1;
			return $d2 . "&nbsp;" . $m2 . "&nbsp;" . $y4;
		}
	}

function thaistart3($sss)
	{
		$d3 = substr($sss, 8, 2);
		$m3 = substr($sss, 5, 2);
		$y3= substr($sss, 0, 4) ;
		$y6=$y3+"543";
		if ($sss == "")
		{
			return "";
		} else
		{
			return $d3 . "/" . $m3 . "/" . $y6;
		}
	}


?>