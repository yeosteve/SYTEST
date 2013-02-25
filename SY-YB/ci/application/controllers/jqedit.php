<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jqedit extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));

		$this->load->model('Cmsmodel');
	}
	// show the content
	function index()
	{
		$data['title'] = 'CI CMS';	
		$data['pageList'] = $this->Cmsmodel->getPageList();		
		$data['query_result']= $this->Cmsmodel->getContentById();
		
		$this->load->view('includes/startHTML', $data);
		$this->load->view('jqedit01', $data);
		$this->load->view('includes/endHTML');
	}
	
	function savePartPage()
	{
		print_r($_POST);exit();
	}


}
// end class