<?php

class Admin extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	public function putComments()
	{
$sql = "INSERT INTO tbl_comments (comments) VALUES(".$this->db->escape($this->input->post('test')).")";
		$this->db->query($sql);
		
		return true;
	}
	
	
	public function getAllComments()
	{
		$sql = "SELECT comments, date FROM tbl_comments";
		return $this->db->query($sql);
	}
	
	
	
	
	
	
	
	
	
	
	// get the muber of rows in the gallery table
	public function getPhotoNum()
	{
	    $query = $this->db->get('tbl_gallery');
	    return $query->num_rows();
	}
	
	
	// may need to use active records so that CI can extend the query
	public function getAllPhotos($numRecords, $offset)
	{
	    
		//$sql = "SELECT filename, comment, date
		//		FROM tbl_gallery LIMIT 4, 2";
		//return $this->db->query($sql);
		$this->db->limit($numRecords, $offset);
		return $this->db->get('tbl_gallery');
	}













	
	public function putImage($fileName)
	{

$sqltest="INSERT INTO tbl_gallery (filename, comment) VALUES ('filename.jpg','comment')";

		$sql = "INSERT INTO tbl_gallery(filename, comment) VALUES ('".$fileName. " ', '". $this->input->post('comments') ."')";
		return $this->db->query($sql);
	}









	
	/**
	 * doUpload
	 * We want to upload an image
		if that works, we want to resize it to a thumbnail
			if that works, we want to make a full size display copy
				if that works, we want to save the details


	 */
	
	 
	
	
	
	
}













