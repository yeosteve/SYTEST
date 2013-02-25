<?php

class Upload extends CI_Controller {
	
	
	private $imgFolder = 'img/test/';
	

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	

// test imageUpload  -  works!!
function uploadTest(){
	if($this->imageUpload()){
		$data['msg'] = 'ok';
		$this->load->view('tester', $data);
	}else{
		
		$data['msg'] = 'nope';
		$this->load->view('tester', $data);
	}
} // uploadTest

// will leave a blank page - check the files for changes
function testSaveThumb(
		       )
{
	$this->saveThumb('zoo-29.04_.12_.jpg');
}


// will leave a blank page - check the files for changes
function testSaveFull(
		       )
{
	$this->saveFull('zoo-29.04_.12_.jpg');
}




	function uploadManager()
	{
		if($this->imageUpload()){
			//do the next step 1
			// get the filename first
			//$this->getFileName(); // maybe
			$arrFileData = $this->upload->data();
			$fileName = $arrFileData['file_name'];
			
			
			if($this->saveThumb($fileName)){
				// dothe next step 2
				if($this->saveFull($fileName) ){
					// dothe next step 3 
					if($this->saveData($fileName)){
						// dothe next step
						redirect('testing/galleryView');
					}else{
						// cope with the failure
						$data['msg'] = ' Could not save the data';	
						// take them to the upload page again??				
					} // end saveData
					
				}else{
					// cope with the failure
					$data['msg'] = 'save Full size failed';		
					// take them to the upload page again??			
				} // end saveFull		
				
			}else{
				// cope with the failure
				$msg = 'save Thumb failed';		
				// take them to the upload page again??
			} // end saveThumb
		}else{
		$data['msg'] = 'Upload failed, but it was not our fault, OK';
		// take them to the upload page again??
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
		
		
		//$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		
		return $this->image_lib->resize();
	} // end saveThumb		
	
	
	

	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	
	function do_upload()
	{
		$config['upload_path'] = './img/test/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '3000';
		$config['max_width']  = '4000';
		$config['max_height']  = '4000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			// randomize the filename to avoid accidental overwriting
			// save the filename in the db
			// save a thumb
			// save a full size
			// take them to a success page

			// save the filename in the db
			$arrFiles =  $this->upload->data();
			$fileName = $arrFiles['file_name'];
			$this->load->model('Admin');
			
			
			
			
			// make a thumb
			if($this->saveThumb($fileName)){
				
				//if($this->saveFull($fileName)){
				if(1==1){
					if($this->Admin->putImage($fileName)){
						$data['message'] = 'put work';
					}else{
						
						$data['message'] = 'put didn work';
					}
				}else{
					$data['message'] = 'fullf 5675767ed up';
				}
				
			}else{
				$data['message'] = 'thumbf 6666 up';
			}
			
			
			
			
			
			$data = array('upload_data' => $this->upload->data());
			$data['img_name'] = $fileName;
			$this->load->view('upload_success', $data);
		}
		
	}
	
	/**
	
		if(saveThumb($fileName))
		{
			if(saveFull($fileName))
			{
				if(putImage())
				{
					$data = array('upload_data' => $this->upload->data());
					$data['img_name'] = $fileName;
					$this->load->view('upload_success', $data);
				}else{
					'something went wrong when I was saving stuff';
				}
			}else{
				'full size could not be created
			}
		}else
		{
			'thumb could not be created'
		}

	 */
	
	
	
	/**
		 *saveThumbSize()
		 */
		
		public function saveThumbFirstEdition($fileName)
		{
			$config['image_library'] = 'gd2';
			$config['source_image']	= './img/test/'.$fileName;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']	 = 100;
			$config['height']	= 80;
			$config['quality']	= '50%';
			$config['thumb_marker']	= '';	// stop CI adding _thumb to the file name
			$config['new_image'] = './img/test/thumbs/'.$fileName;
			
			$this->load->library('image_lib', $config); 
			
			$this->image_lib->resize();
			return true;
		}
		/**
		 *saveFull()
		 */
		
		//public function saveFull($fileName)
		//{
		//	$config['image_library'] = 'gd2';
		//	$config['source_image']	= './img/test/'.$fileName;
		//	$config['create_thumb'] = TRUE;
		//	$config['maintain_ratio'] = TRUE;
		//	$config['width']	 = 600;
		//	$config['height']	= 400;
		//	$config['quality']	= '70%';
		//	$config['thumb_marker']	= '';	// stop CI adding _thumb to the file name
		//	$config['new_image'] = './img/test/full/'.$fileName;
		//	
		//	$this->load->library('image_lib', $config); 
		//	
		//	$this->image_lib->resize();
		//	return true;
		//}
		
	
function testResize()
{
	$config['image_library'] = 'gd2';
	$config['source_image']	= './img/test/479409N.jpg';
	$config['create_thumb'] = TRUE;
	$config['maintain_ratio'] = TRUE;
	$config['width']	 = 75;
	$config['height']	= 50;
	$config['quality']	= '50%';
	$config['thumb_marker'] = false;
	$config['new_image']	= './img/test/thumbs/';
	
	
	$this->load->library('image_lib', $config); 
	
	if ( ! $this->image_lib->resize())
	{
	    echo $this->image_lib->display_errors();
	}else{
		echo 'worked';
	}
	
}	// end testResize






}
?>