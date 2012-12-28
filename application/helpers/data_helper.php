<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('convert_to_mysql_date'))
{
	function convert_to_mysql_date($date) 
	{
		$output = false;
		$d = preg_split('#[-/:. ]#', $date);
		if (is_array($d) && count($d) == 3) {
			if (checkdate($d[1], $d[0], $d[2])) {
				$output = "$d[2]-$d[1]-$d[0]";
				echo $output;
			}
		}
		if ($output == false) {
			$this->form_validation->set_message('convert_to_mysql_date', 'The %s field can not be the word "test"');
		}
		
		return $output;
	}
	
	function set_default_time_if_empty($time,$defaultTime) {
		if ($time == "") {
			$time = $defaultTime;
			return $time;
		}
	}
}