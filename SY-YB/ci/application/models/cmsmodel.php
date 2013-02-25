<?php
/**
 *	models/cmsmodel.php
 *	All the models for the CMS
 */
class Cmsmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function getPageList()
	{
		$sql = "SELECT id, title
		FROM CMSContent";
		return $this->db->query($sql);
	}
	/**
	 *	enters data for a new page
	 *	called from admin index page
	 */
	public function putContent()
	{
		$sql = "INSERT INTO CMSContent (title, content)
		VALUES(".$this->db->escape($this->input->post('title')).','.$this->db->escape($this->input->post('content')).")";
		
		$this->db->query($sql);
		
		return true;
	}
		
	public function updateContent()
	{
		$title = $this->db->escape($this->input->post('title'));
		$content = $this->db->escape($this->input->post('content'));
		$sql = "UPDATE CMSContent
				SET title = $title,
				content = $content 
		
				WHERE id = ".$this->session->flashdata('pageID');
		$this->db->query($sql);
		
		return true;
		//}
	}
	
	
	
	/**
	 *	get all the content for a single page, or an update form
	 *	note the clever way it saves the id in flashdata so that it can be used when the form is submitted
	 *	unfortunately, at this stage, a user could browse directly to cms/updatePage/x and update anything they like, so we would have to prevent that, and prevent anyone simply browsing there anyway - authentication!
	 */
	function getContentById()
	{
		$id = ($this->uri->segment(3))?$this->uri->segment(3):1;
		$arr = array('pageID'=>$this->uri->segment(3));
		
		$this->session->set_flashdata($arr);
		// use this later in the update query
		
		$sql = "SELECT title, content
				FROM CMSContent
				WHERE id=$id";
		return $this->db->query($sql);
	}
	

	
}// end class