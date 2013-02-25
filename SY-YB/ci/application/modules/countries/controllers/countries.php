<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * country/city selector list with Jquery and Codeigniter
 * 
 */
class Countries extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	$this->output->enable_profiler(TRUE);
	}


	public function index()
	{
		//		// make the dropdown
		//1) Get the array of countries
		//2) Feed it to the makeOptions method in the Html-egine library
		
		
		$this->load->library('Html_engine');
		// $row[0]=>array(id => 1,Name => name)
		// matches the pattern when calling row_array() in the db class
		$arrOptions =  array(1=>array('id'=>1,
										'name'=>'one'
										),
							 2=>array('id'=>2,
										'name'=>'two'
										)
							 );
		
		
	    $data['countryOptions'] =  $this->html_engine->makeOptions($arrOptions);
//	    
		$data['title'] = 'Country/City selector';
    	    $this->load->view('includes/startHTML',$data);
   	    $this->load->view('countries-view',$data);
    	    $this->load->view('includes/endHTML',$data);
	}
}

/* End of file modules/countries/countries.php*/
