<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// test various email configs
class Email extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->output->enable_profiler(TRUE);
		
		//$config['protocol'] = 'sendmail';
		//$config['mailpath'] = '/usr/sbin/sendmail';
		//$config['charset'] = 'iso-8859-1';
		//$config['wordwrap'] = TRUE;
		//$config['mailtype'] = 'html';
		//
		//$this->email->initialize($config);
		
		    $config = array(
				'protocol' => "smtp",
				'smtp_host' => "ssl://smtp.googlemail.com",
				'smtp_port' => 465,
				'smtp_user' => "yeosteve@gmail.com",
				'smtp_pass' => "tenty10io"
				 
			    );
		$this->load->library('email', $config);
		
		    //$this->load->library('email'); 

		$name = 'Sent at'.date('h:i:s');
		
		$this->email->from('your@example.com', $name );
		$this->email->to('steve.yeoman@yoobee.ac.nz'); 
		$this->email->cc('yeosteve@gmail.com'); 	
		
		$this->email->subject('Email Test');
		$this->email->message('<b>Testing </b> 	the email class.');	
		
		$this->email->send();
		
		echo $this->email->print_debugger();
	}
	
} // end class
// EOF controllers/email.php