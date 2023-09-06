<?php
class DateClass{
		function IndonesianMonth($intMon){
			$intMon = (int) $intMon; 
			$arMon = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
				return $arMon[$intMon];
		}
		
		function IndonesianDay($intMon){
			$hari = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
			return $hari[$intMon];
		}		
		
		function SQLIndonesianDay($intMon){
			$hari = array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
			return $hari[$intMon];
		}
		
				
		function IndonesianDate($sqldate,$delim=' '){	
			$intBln=substr($sqldate,5,2);	
			$bln = $this->IndonesianMonth($intBln);	
			
			return substr($sqldate,8,2).$delim.$bln.$delim.substr($sqldate,0,4);
		}
		
		function IndonesianDatetime($sqldate){	
			$intBln=substr($sqldate,5,2);	
			$bln = $this->IndonesianMonth($intBln);	
			
			return substr($sqldate,8,2).' '.$bln.' '.substr($sqldate,0,4).' '.substr($sqldate,11,5);
		}
		
		function hariini(){		
		return $this->IndonesianDay(@date("w")-1).', '.$this->IndonesianDate(@date("Y-m-d"));
		}

		function date_eng($in){
			if ($in<>'') {
				$date = str_replace('/', '-', $in);
				return date('Y/m/d', strtotime($date));	
			}
			else{
				return '0000-00-00';
			}
		
		}

		function datetime_eng($in){
			$date = str_replace('/', '-', $in);
			return date('Y/m/d H:i', strtotime($date));			
		}

		function date_ind($in){
			if ($in<>'0000-00-00') {
				$date = str_replace('/', '-', $in);
				return date('d/m/Y', strtotime($date));
			}
			else{
				return '';
			}
			
		}

		function datetime_ind($in){
			$date = str_replace('/', '-', $in);
			return date('d/m/Y H:i', strtotime($date));			
		}

		function FormatTime($sqldate,$delim=' '){	
			$intBln=substr($sqldate,5,2);	
			$bln = $this->IndonesianMonth($intBln);	
			
			return substr($sqldate,11,5);
		}

		#Fungsi menciptakan nama hari dalam bahasa Indonesia
		function ambilHari($in){
			$day = $in;
			switch($day){
			case "Mon": $hari="Senin"; break;
			case "Tue": $hari="Selasa"; break;
			case "Wed": $hari="Rabu"; break;
			case "Thu": $hari="Kamis"; break;
			case "Fri": $hari="Jumat"; break;
			case "Sat": $hari="Sabtu"; break;
			case "Sun": $hari="Minggu"; break;
			}
			return($hari);
		} 	

		function indonesianFormat($in) {
			list($tahun,$bulan,$hari) = explode("-", $in);
			return $hari."-".$bulan."-".$tahun;
		}



}
?>