<?php

class Testmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	public function testdata()
	{
		return 'This is data from the model';
	}
}