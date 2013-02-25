<?php
/**
 *  publicview will control the display of publicly acccessible views
 *
 *  A) List of all in ascending order of modules, each in two lists, regular and distinction, all bullet pointed
 *      a) web view
 *      b) mobile view
 *      c) print view
 *  B) Show selected module, then all previous DESC by module
 *      a) web view with bullet points
 *      b) marking schedule view  -  format for print, desktop and mobile
 *          checkboxes by each best practice for current module
 *          checkboxes by each category for all past modules
 *      
 *  C) Search for one best practice category  - web view only
 *  
 *
 *  models will return arrays of
 *      a selected module
 *          getCategoriesByModule($id) - returns array of categories  $arrBPs[moduleID][catID]  
 *          foreach(category){
 *              $arrBP[moduleID][catID]['regular'] = getBPs($categoryID ,$excel) excel = 0
 *              $arrBP[moduleID][catID]['distinction'] = getBPs($categoryID ,$excel) excel = 1
 *              }
 *      all modules prior to selected in descending order       getAllModules
 *  
 */
class Bestpractices extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->load->database('bp');
        $this->load->model('Bpmodel');
       $this->load->helper('cache');
    }

    function index()

    {
       //exit(__FILE__);
        //$this->output->enable_profiler(TRUE);
        $data['title'] = 'Best Practices';
        
       
        $data['arrProgrammes'] = $this->Bpmodel->getSelection();
       // $data['arrProgrammes'] = $this->Bpmodel->allCourses();
        //print_r($data['arrProgrammes']);
        $this->output->set_header("HTTP/1.0 200 OK");
        $this->output->set_header("HTTP/1.1 200 OK");
        $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', strtotime('now')).' GMT');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
// this must be made to work with newListView
        $data['mainContent'] = 'bestpractices-view';
       // $data['mainContent'] = 'newListView';
        $this->load->view('template/template',$data);
        //$this->load->view('newListView',$data);
    }
    

    function test()

    {
       //exit(__FILE__);
        //$this->output->enable_profiler(TRUE);
        $data['title'] = 'BP TEST';
        
       
        //$data['arrProgrammes'] = $this->Bpmodel->getSelection();
       $data['arrProgrammes'] = $this->Bpmodel->allCourses();
        //print_r($data['arrProgrammes']);
        //$this->output->set_header("HTTP/1.0 200 OK");
        //$this->output->set_header("HTTP/1.1 200 OK");
        //$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', strtotime('now')).' GMT');
        //$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        //$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        //$this->output->set_header("Pragma: no-cache");
// this must be made to work with newListView
        //$data['mainContent'] = 'bestpractices-view';
        //$data['mainContent'] = 'newListView';
        //$this->load->view('template/template',$data);
        $this->load->view('template/header.inc.php',$data);
        $this->load->view('newListView',$data);
        $this->load->view('template/footer.inc.php',$data);
    }
    
    function sorting(){
        $data['title'] = 'test sorting';
        $this->load->view('content', $data);
    }
    
    
    
    function makeList()
    {
        $this->load->model('Bpmodel');
        $data['stuff'] = $this->Bpmodel->getSelection();
        //noCacheHeaders();
        $this->output->set_header("HTTP/1.0 200 OK");
        $this->output->set_header("HTTP/1.1 200 OK");
        $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', strtotime('now')).' GMT');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        
        //$data['mainContent'] = 'bestpractices-view';
        $this->load->view('templates/header.inc',$data);
        $this->load->view('bestpractices-view',$data);
        $this->load->view('templates/footer.inc',$data);
    }
    
    function changeorder()
    {
        //turn the json into an array
        $aInfo = json_decode($_POST['mine'], true);
  // print_r($aInfo);
   foreach($aInfo as $k =>$row){
    // write and run the SQL here
    echo 'CategoryID: '.$row['categ'].' - CourseID: '.$row['course'].' - Key : ' .$k.'<br />';
   }

    }

}