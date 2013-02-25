<?php
/**
 * make HTML components, usually with an array, eg options , <a tags
 */
class Html_engine {
/**
 * make an option list from an array $row[0]=>array(id => 1,Name => name) - make sure both tables have same field names
 */	
	public function makeOptions($arr)
	{
		
		$a = '';
		foreach($arr as $k => $v){
			$a .= '';
			$v = array_values($v);
			$a .= '<option value="'.$v[0].'">'.$v[1].'</option>';
		}
		return $a;
	}
	
/**
 * make list of links - just the li
 * requires an array of id=>name,  target url
 * returns links in lists
 * 
 */	
	public function makeList($arr, $target='')
	{
		$a = '';
		//$arr = array_values($arr);
		foreach($arr as $k => $v){
			
			$a .= '<li><a href="'.$target.'/'.$k.'">'.$v.'</a></li>';
		}
		return $a;
	}

}
/*end modules/lists/libraries/makeoptions.php