<?php
// admin area controller
class admin extends CI_Controller
{
    
    function __construct(){
        parent::__construct();
        $this->load->model('Bpmodel');
        $this->load->library('form_validation');
        $this->output->enable_profiler(TRUE);
        
    }
    // front page - Oct25 2011 - just the menu
    function index()
    {
        $data['mainContent'] = 'menu';
        $data['title'] = 'Admin Menu';
        
        $this->noCacheHeaders();
        $this->load->view('template/template',$data);
    }
    
    /**
     *sortable
     *http://forums.cibonfire.com/discussion/539/jquery-sortable-new-order-saved-to-database/p1
     */
        function updateOrder () {

        $data =  $this->page_model->getOrderList() ;

        foreach ( $_POST as $key => $value )
        {
            $newRank = $value;
            $currentRank = $data[$key];
            if($currentRank != $newRank){
                $this->page_model->switchOrder($key,$newRank);
            }
        }
    }  




    
    /**
     * make an list of BPs to update/delete
     */
    function listBP()
   {
   
        //load the array for the category dropdown
        $data['list'] = $this->Bpmodel->makeAdminMenu();
        $data['mainContent'] = 'admin/listBP';
        $data['title'] = 'Update/Delete BP';

        $this->noCacheHeaders();
        $this->load->view('template/template',$data);
    }
    
     /**
     * make an list of BPs to update/delete
     */
    function listBPajax()
   {     
        $data['list'] = $this->Bpmodel->makeAdminMenu();
     
        $this->noCacheHeaders();
        $this->load->view('admin/listBPajax',$data);
    }
    
    // make a form for new bp cwalled by ajax
    function newBPForm()
    {
        //load the array for the category dropdown
        $data['arrCats'] = $this->Bpmodel->dropdownCats();
        $this->load->view('admin/newBPajax', $data);
    }
    function handleNewBP(){
        return $this->Bpmodel->bp_insert();
      
    }
    //make a new best practice
    // produces a form to create a new best practice
    // category dropdown list requires an array
    function newbp(){
        $data['mainContent'] = 'admin/newBP';
        $data['title'] = 'New Best Practice';
        
        $data['arrCats'] = $this->Bpmodel->dropdownCats();
        if($this->input->post('mysubmit'))
        {
            $this->Bpmodel->bp_insert();
        }        
        //$this->load->view('template/template',$data);
        $this->load->view('admin/newBP', $data);
    }
    
    // updateBP either handles the data or produces a form
    /**
     * requires a uri->segment(3) , or the id at least
     * if (POST){
        validate it
            if (passes){
                run update query
                redirect to admin/listBP
            }else{
                load view updateForm
            }
     }elseif(iri->segment(3)){
        get the data for the form
        load view updateForm
     }else{
        redirect to admin/listBP
     }
     */
    // this one creates the form
    function updateBP()
    {
 
        $data['updateDetails'] = $this->Bpmodel->getBPbyID();
        //print_r($data['updateDetails']);
        //load the array for the category dropdown
        $data['arrCats'] = $this->Bpmodel->dropdownCats();
           
        $this->noCacheHeaders();

        $this->load->view('updateBPform',$data);
    }
    
    //this one handles the form - combine these when tested
    // check the data
    // write the sql
    //return true
    
    function handleUpdateBP()
    {
     
       // $this->form_validation->set_error_delimiters('<div class="checkWarning"><p>', '</p></div>');
        $this->form_validation->set_message('required', '%s is a required field');
        
        $this->form_validation->set_rules('statement', 'Statement', 	'trim|min-length[1]|xss_clean');
        $this->form_validation->set_rules('category', 'Category',	'trim|required|xss_clean');
        
        if($this->form_validation->run()){
            $this->Bpmodel->bp_update();
        }
        $data['stuff'] = $this->Bpmodel->getSelection();
        $this->output->set_header("HTTP/1.0 200 OK");
        $this->output->set_header("HTTP/1.1 200 OK");
        $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', strtotime('now')).' GMT');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        
        $this->load->view('bestpractices-view',$data);
       // return true;

    }
    /**
     *noCacheHeaders()
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
    
}// end admin