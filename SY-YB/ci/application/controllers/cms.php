<?php
/**
 *	controllers/cms.php
 *	SY 18/02/2013
 *	
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Cmsmodel');
	}
	// show the content
	function index()
	{
		$data['title'] = 'CI CMS';	
		$data['pageList'] = $this->Cmsmodel->getPageList();		
		$data['query_result']= $this->Cmsmodel->getContentById();
		
		$this->load->view('includes/startHTML', $data);
		$this->load->view('CMSpage', $data);
		$this->load->view('includes/endHTML');
	}
	
    // admin front page  
	function admin()
	{
		$data['title'] = 'CI CMS admin';
		$data['pageList'] = $this->Cmsmodel->getPageList();
		
		$this->load->view('includes/startHTML', $data);
		$this->load->view('CMS_admin', $data);
		$this->load->view('includes/endHTML');
	}
	

		// make a new page
	public function newPage()
	{
		// These should be autoloaded. Included here to remind you.
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', '5', 'required|min_length[5]');
		$this->form_validation->set_rules('content', '5', 'required|min_length[5]');
		
		$this->form_validation->set_message('required', 'We need at least %s characters, please');
		$this->form_validation->set_message('min_length', 'Surely you can manage %s lousy characters');
		
		//run the rules. If anything fails show the form
		if ($this->form_validation->run() == FALSE){
			$this->load->view('includes/startHTML');
			$this->load->view('CMS_newPage');
			$this->load->view('includes/endHTML');
		}else{
			// this should be in a conditional statement to handle what happens if putContent() fails
			$this->Cmsmodel->putContent();
			redirect('cms');			
		}		
		
	}// end newPage
		

		
		/**
		 * make an update page
		 * ??  redirect if they don't have uri-segment(3)
		 */
		
		function updatePage()
		{
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->model('Cmsmodel');
	
			$this->form_validation->set_rules('title', '5', 'required|min_length[5]');
			$this->form_validation->set_rules('content', '5', 'required|min_length[5]');
			
			$this->form_validation->set_message('required', 'We need at least %s characters, please');
			$this->form_validation->set_message('min_length', 'Surely you can manage %s lousy characters');
			//run the rules. If anything fails show the form
			if ($this->form_validation->run() == FALSE){
				$data['query_result']= $this->Cmsmodel->getContentById();
				$this->load->view('CMS_updatePage',$data);
				
			}else{
				if($this->Cmsmodel->updateContent() ){
					redirect('cms');
				}else{
					redirect('cms/admin');
				}
				
			} 
		} // end updatePage
		

}// end class Cmss