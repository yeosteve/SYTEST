<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testing extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data=array(); 
		// step 1 hard code a data array item to pass to the view
		//$data['newstuff'] = 'this is somthing';
		//$this->load->view('testview',$data);
		
		// step 2 load data from a model
		//$this->load->model('Testmodel');
		//$data['newstuff'] = $this->Testmodel->testdata();
		//$this->load->view('testview', $data);
		
	$this->load->model('Testmodel');
	$data['newstuff'] 	= $this->Testmodel->testdata();
	
	$data['title']		= "Page title";
	$data['description']	= "SEO can be greatly enhanced with a good description";
	$this->load->view('includes/startHTML', $data);
	$this->load->view('testview', $data);
	$this->load->view('includes/endHTML');
	}
	
	public function other()
	{
		// step 1 hard code a data array item to pass to the view
		//$data['newstuff'] = 'this is somthing';
		
		// step 2 load data from a model
		//$this->load->model('Testmodel');
		//$data['newstuff'] = $this->Testmodel->testdata();
		//$this->load->view('testview', $data);
		
		$this->load->model('Testmodel');
		$data['newstuff'] = $this->Testmodel->testdata();
		
		$this->load->view('includes/startHTML');
		$this->load->view('alternateview', $data);
		$this->load->view('includes/endHTML');
	}
}