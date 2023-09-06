<?php
class LEAF_time
{
	public function masaWaktu()
	{
		$h = date('G');
		if($h >= 3 && $h <= 10 ){
			return('Pagi');
		}
		elseif($h > 10 && $h <= 15){
			return('Siang');
		}
		elseif($h > 15 && $h <= 19){
			return('Sore');
		}
		else{
			return('Malam');
		}
	}
	
	public function wib()
	{
		$difference = time() + 0;
		return(date('Y-m-d H:i:s', $difference));
	}
	
	
	public function wita()
	{
		$difference = time() + 60*60*1;
		return(date('Y-m-d H:i:s', $difference));
	}
	
	
	public function wit()
	{
		$difference = time() + ( (60*60*2) + (60*15) );
		return(date('Y-m-d H:i:s', $difference));
	}
	
	
	public function activeTime($zone)
	{
		switch($zone){
			case'wit':
				return($this->wit());
				break;
			case'wita':
				return($this->wita());
				break;
			default:
				return($this->wib());
				break;
		}
	}


	public function indMonth($o)
	{
		$obj = array(1=> 'Januari', 'Febuari', 'Maret',
					     'April',   'Mei',     'Juni',
						 'Juli',    'Agustus', 'September',
						 'Oktober', 'Nopember','Desember');
		
		return( $obj[$o] );
	}
	
	public function indMonth3Words($o)
	{
		$obj = array(1=> 'Jan', 'Feb', 'Mar',
					     'Apr', 'Mei', 'Jun',
						 'Jul', 'Agt', 'Sep',
						 'Okt', 'Nov','Des');
		
		return( $obj[$o] );
	}
	
	
	public function enMonth($o)
	{
		$obj = array(1=> 'January', 'February', 'March',
					     'April',   'May',     'June',
						 'July',    'August', 'September',
						 'October', 'November','December');
		
		return( $obj[$o] );
	}
	
	
	public function indDays($obj)
	{
		$day = array(0=>'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
		return($day[$obj]);
	}
	
	
	public function enDays($obj)
	{
		$day = array(0=>'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
		return($day[$obj]);
	}
	
	
	public function dayName($o)
	{
		$day = ($_SESSION[CONFIG_CUSTOMER.'_lang'] == 'en') ? $this->enDays($o) : $this->indDays($o);
		return($day);
	}
	
	
	public function normaldate($o, $singkat=false)
	{
		$explode = explode('-', $o);
		
		# Handle the 'zero' number.
		  ($explode[1]<10)? 
		    $explode[1] = str_replace('0', '', $explode[1]) : ''; 
		
		$year  = $explode[0];
		//$month = ($_SESSION[CONFIG_CUSTOMER.'_lang'] == 'en') ? $this->enMonth($explode[1]) : $this->indMonth($explode[1]);
		
		$month = $this->indMonth($explode[1]);
		if($singkat===true)
			$month = $this->indMonth3Words($explode[1]);
		
		$date  = substr($explode[2],0,2);
		$indonesian_date = $date.'&nbsp;'.$month.'&nbsp;'.$year;
		
		return( $indonesian_date );
	}
	
	
	public function indonesiaTime($o, $zone='N')
	{
		$str = substr($o, 0, 10);
		$indonesian_date = $this->normaldate($str);
		$time = str_replace($str, $indonesian_date, $o);
		
		$time = substr($time, 0, -3);
		
		$zone=='Y' ?
			$time = $time . '&nbsp;' . strtoupper(CONFIG_ZONA_WAKTU) : '';
		
		return($time);
	}
	
	public function panelTime()
	{
		$r = '
			'.$this->indDays(date('w')).'
			<br />
			'.date('d').'/'.date('m').'/'.date('Y').'
		';
		return($r);
	}
	
	public function datePicker($time, $separator='/')
	{
		$str = substr($time, 0, 10);
		$str = explode('-', $str);
		$date = $str[2].$separator.$str[1].$separator.$str[0];
		return($date);
	}
}
?>