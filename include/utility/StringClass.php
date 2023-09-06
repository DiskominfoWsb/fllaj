<?php
class StringClass{		
	function money($string, $koma=true, $null = '0'){		
		$string = number_format($string, 2, '.', ',');
		
		if( preg_match('/./', $string) ){
			$ex = explode('.', $string);
			$string = $ex[0];
		}
		
		$string = str_replace(',', '', $string);
		
		if($koma === false)
			$money = number_format($string, 0, ',', '.');
		else
			$money = number_format($string, 2, ',', '.');
		
		if( $money == 0 )
			$money = $null;		
		
		return($money);
	}

	function terbilang($x)
	{
		if( preg_match("/-/i", $x) ){
			$x = str_replace('-', '', $x);
		}
		if( preg_match("/./i", $x) ){
			$x = explode('.', $x);
			$x = $x[0];
		}
		
		$abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		if ($x < 12){
			return " " . $abil[$x];
		}elseif ($x < 20){
			return $this->terbilang($x - 10) . "belas";
		}elseif ($x < 100){
			return $this->terbilang($x / 10) . " Puluh" . $this->terbilang($x % 10);
		}elseif ($x < 200){
			return " Seratus" . $this->terbilang($x - 100);
		}elseif ($x < 1000){
			return $this->terbilang($x / 100) . " Ratus" . $this->terbilang($x % 100);
		}elseif ($x < 2000){
			return " Seribu" . $this->terbilang($x - 1000);
		}elseif ($x < 1000000){
			return $this->terbilang($x / 1000) . " Ribu" . $this->terbilang($x % 1000);
		}elseif ($x < 1000000000){
			return $this->terbilang($x / 1000000) . " Juta" . $this->terbilang($x % 1000000);
		}elseif ($x < 1000000000000){
			return $this->terbilang($x / 1000000000) . " Miliar" . $this->terbilang($x % 1000000000);
		}
	}

	function getSynopsis($con,$nmfrase='20'){
		$con = strip_tags($con);
		$bufPartCnt = array();
					$buddCnt = explode(" ",$con );
					 for($i=0;$i<=$nmfrase;$i++)
					 {
						$bufPartCnt[$i] = $buddCnt[$i];
					 }
					$partCnt = implode(" ", $bufPartCnt);
					
					return ($con <> '')?$partCnt." ... ":"";
	}	

	function formatDesimalkoma($angka){
		$xx = number_format($angka, 2, ',', '.');
		$nilai = str_replace(array(",00"), " ", $xx);
		return $nilai;
	}

}
?>