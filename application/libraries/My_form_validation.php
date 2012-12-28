<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Form_validation extends CI_Form_validation {

	public function convert_to_mysql_date($date) 
	{
		$output = false;
		$d = preg_split('#[-/:. ]#', $date);
		if (is_array($d) && count($d) == 3) {
			if (checkdate($d[1], $d[0], $d[2])) {
				$output = "$d[2]-$d[1]-$d[0]";
			}
		}
		if ($output == false) {
			$this->CI->form_validation->set_message('convert_to_mysql_date', 'The date must be in the following format: DD/MM/YYYY');
		}
		return $output;
	}

}