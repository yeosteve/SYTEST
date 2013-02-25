<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ysgallery extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('Yslib');
		
		$this->session->set_flashdata('galleryName', $this->imgFolder);
		
		// set defaullt clientState if nec
		if(!$this->session->userdata('clientState') ){
			$this->session->set_userdata(array('clientState'=>50));
		}

        
    }
// sets the values for the image resizing
// test the output and adhust according to your needs
	public $arrAdapt = array
            (
            30 => array
                (
				'thumb' => array
							(
							'width'    =>  80,
							'qual'     =>  50
							),
				'full' => array
							(
							'width'     =>  320,
							'qual'      =>  70
							)
				),
            50 => array
                (
				'thumb' => array
							(
							'width'    =>  120,
							'qual'     =>  650
							),
				'full' => array
							(
							'width'     =>  500,
							'qual'      =>  70
							)
				),
            80 => array
                (
				'thumb' => array
							(
							'width'    =>  150,
							'qual'     =>  50
							),
				'full' => array
							(
							'width'     =>  900,
							'qual'      =>  70
							)
				)
				

            );
	
	
	private $imgFolder = 'Public/gallery/';
	
	function testGetImage(){
		if($this->getImage('gorge03.jpg', 'thumb')){
			$data['msg']="worked";
		}else{
			$data['msg']="failed";
		}
		$this->load->view('includes/startHTML.php');
			$this->load->view('tester',$data);
		$this->load->view('includes/endHTML.php');
	}
	
	
	
/**
 *generic file creator
 * params, file name, thumb/full
 * checks if a directory exists for $this->session->userdata('clientState')
 * uses values from $this->arrAdapt for size and quality
 */
	
	function getImage($fileName, $size)
	{
//exit($this->imgFolder.$size);
$folder = $this->imgFolder.$this->session->userdata('clientState');
		
		if($this->yslib->mkFolder($folder))
		{
				
			return $this->yslib->mkImage($fileName, $size, $this->imgFolder, $this->arrAdapt);
		
		}else{
			return false;
		}
		
	
	} // end saveThumb	
	
	
	
	
	

	function index()
	{
		$this->load->view('includes/startHTML.php');
		$this->load->view('upload_form', array('error' =>'' ));
		$this->load->view('includes/endHTML.php');
	}
	
	function galleryView()
	{
		$this->load->model('Admin');
		
		$numRows = $this->Admin->getPhotoNum();
		
		$this->load->library('pagination');

		$config['base_url'] = 'http://sy.yoobee.net.nz/ysgallery/galleryView';
		$config['total_rows'] = $numRows;
		$config['per_page'] = 10; 
		
		$this->pagination->initialize($config); 
		
		$data['links'] =  $this->pagination->create_links();
		//if($this->uri->segment(3){$offset=$this->uri->segment(3)}else($offset=0);
		$offset=($this->uri->segment(3))?$this->uri->segment(3):0;
		$data['query_result'] = $this->Admin->getAllPhotos($config['per_page'], $offset);
		$this->load->view('includes/startHTML');
		$this->load->view('galleryView', $data);
		$this->load->view('includes/endHTML');
	}
	
	
 
/** uploadManager
 * calls the image upload method
 * then saves a thumb
 * then saves a full size version
 * then writes to the database
 */

	function uploadManager()
	{
		if($this->imageUpload()){
			$arrFileData = $this->upload->data();
			$fileName = $arrFileData['file_name'];
			if($this->saveThumb($fileName)){
				if($this->saveFull($fileName) ){
					if($this->saveData($fileName)){
						redirect('ysgallery/galleryView');
					}else{
						$data['msg'] = ' Could not save the data';
					$this->load->view('upload_form', $data);
					} // end saveData
				}else{
					// cope with the failure
					$data['msg'] = 'save Full size failed';	
					$this->load->view('upload_form', $data);			
				} // end saveFull	
			}else{
				// cope with the failure
				$data['msg'] = 'save Thumb failed';
				$this->load->view('upload_form', $data);
			} // end saveThumb
		}else{
		$data['msg'] = 'Upload failed, but it was not our fault, OK';
		$this->load->view('upload_form', $data);
		} //end imageUpload
	}

	/* saves the recently uploaded file name etc*/
	function saveData($fileName)
	{
		$this->load->model('Admin');
		return $this->Admin->putImage($fileName);
		
	}
	
	/*
	copy code from CI docs - doUpload()
	uploads an image
	returns true if works, false if fails
	CALLED ONLY FROM do_upload which has been called from a multipart form
	*/
	function imageUpload()
	{
		$config['upload_path'] = $this->imgFolder;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '3000';
		$config['max_width']  = '4000';
		$config['max_height']  = '4000';
	
		$this->load->library('upload', $config);
		
		return $this->upload->do_upload();
		
	}
	// end imageUpload
		
		
		
		
		
		
	/**
	 * saveThumb
	 * grabs recently uploaded file and produces a thumbnail
	 * requires filename - jpg please
	 * returns true/false
	 */
	
	function saveThumb($fileName)
	{
		$config['image_library'] = 'gd2';
		$config['source_image']	= $this->imgFolder.$fileName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']	 = 75;
		$config['height']	= 50;
		$config['quality']	= '50%';
		$config['thumb_marker'] = false;
		$config['new_image']	= $this->imgFolder.'thumbs/';
		
		
		//$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		
		return $this->image_lib->resize();
	} // end saveThumb	
		
		
		
	/**
	 * saveFull
	 * grabs recently uploaded file and produces a thumbnail
	 * requires filename - jpg please
	 * returns true/false
	 */
	
	function saveFull($fileName)
	{
		$config['image_library'] = 'gd2';
		$config['source_image']	= $this->imgFolder.$fileName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']	 = 1200;
		$config['height']	= 800;
		$config['quality']	= '70%';
		$config['thumb_marker'] = false;
		$config['new_image']	= $this->imgFolder.'full/';
		$this->image_lib->initialize($config);
		
		return $this->image_lib->resize();

	} // end saveFull
	
	/** set the session variable for the current screen width
	 * sets values equal to the breakpoints in the media queries
	 */
	function setEnv()
	{
		$this->session->set_userdata(array('clientState'=>50));
		if(isset($_POST['width']) && is_numeric($_POST['width'])){		
			if($_POST['width'] <= 480){
				$this->session->set_userdata(array('clientState'=>30));
			}elseif( $_POST['width'] >= 481 && $_POST['width'] <= 800 ){
				$this->session->set_userdata(array('clientState'=>50));
			}elseif( $_POST['width'] >= 801 ){
				$this->session->set_userdata(array('clientState'=>80));
			}else{
				$this->session->set_userdata(array('clientState'=>50));
			}
		}
		$data['thisSession'] =  $this->session->userdata('clientState');
		// this is used to test this function by returning the client state to the client. This won't be necessary in production
		$this->load->view('sessionData', $data);
		//return $this->session->userdata('clientState');
	}
	
	function doesImgExist($path)
	{
		
	}
}
// end class