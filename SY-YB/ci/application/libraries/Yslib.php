<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Yslib {

    public function mkFolder($folder)
    {
		if(! is_dir($folder)){
			mkdir($folder, 0755);
			mkdir($folder.'/thumb', 0755);
			mkdir($folder.'/full', 0755);
		}
		return true;
    }
	
	public function mkImage($fileName, $size, $folder, $arrAdapt)
	{
		$CI =& get_instance();
		
		
		$config['image_library'] = 'gd2';
		$config['source_image']	= $folder.$fileName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']	 = 75;
		$config['height']	= 50;
		$config['quality']	= '50%';
		$config['thumb_marker'] = false;
		$config['new_image']	= $folder.'/'.$size.'/'.$filename;
		
		
		//$this->load->library('image_lib', $config);
		$CI->image_lib->initialize($config);
		
		return $CI->image_lib->resize();
	}
	
}

/* End of file Someclass.php */


