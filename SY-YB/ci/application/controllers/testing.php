<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testing extends CI_Controller {


/**
 * dataentry - demo and test data entry on a single field
 * if POST has been received,{
 * 	validate it
 * 		if OK -
 * 		{	go to model to put data into db
 * 			if that works, redirect them to the list of entries
 * 			}
 * 		else{
 * 			write the form with error messages
 * 		}
 * 	}else{
	write a virgin form
	}
 }
 */

	public function dataentryTheForm()
	{

		$this->load->view('includes/startHTML');
			$this->load->view('dataentryView', $data);
		$this->load->view('includes/endHTML');
	}
	
// testing  $this->input->post 

	public function dataentryStep1()
	{
		//$_POST['test']
		//$this->output->enable_profiler(TRUE);
		if($this->input->post('test')) {		// test to see if $_POST['test'] has been set yet
			$data['check'] = $this->input->post('test');
		}else{
			
			$data['check'] = 'Nothing yet';
		}
		
		$this->load->view('includes/startHTML');
			$this->load->view('dataentryView', $data);
		$this->load->view('includes/endHTML');
	}		
// test the validation methods







	public function dataentry()
	{
		//$this->output->enable_profiler(TRUE);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('test', '5', 'required|min_length[5]');
		
		$this->form_validation->set_message('required', 'We need at least %s characters, please');
		$this->form_validation->set_message('min_length', 'Surely you can manage %s lousy characters');
		//run the rules. If anything fails show the form
		if ($this->form_validation->run() == FALSE){
			$this->load->view('includes/startHTML');
			$this->load->view('dataentryView');;
			$this->load->view('includes/endHTML');
			
		}else{
			$this->load->model('Admin');
			if($this->Admin->putComments()){				
				redirect('testing/showComments');			
			}else{
				redirect('testing/databaseFailed');
			}
		}
	}
/**
 *simply show a list of all the comments so far
 */
	public function showComments()
	{
		$this->load->model('Admin');
		$data['query_result'] = $this->Admin->getAllComments();
		
		$this->load->view('includes/startHTML');
		$this->load->view('showComments', $data);
		$this->load->view('includes/endHTML');

	}
	//http://bayusantiko.wordpress.com/2012/04/05/insert-data-to-database-in-codeigniter/ might be worth checking out.
	

	
	function galleryView()
	{
		$this->load->view('galleryView');
	}
	
	
	
}
// end class