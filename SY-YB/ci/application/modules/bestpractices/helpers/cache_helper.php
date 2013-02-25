<?php
    /**
     *noCacheHeaaders()
     *use before views requested by ajax to force the browser to refresh the cahe
     */
    function noCacheHeaders(){
        $this->output->set_header("HTTP/1.0 200 OK");
        $this->output->set_header("HTTP/1.1 200 OK");
        $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', strtotime('now')).' GMT');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
// end modules/bestpractices/helpers/cach_helper.php