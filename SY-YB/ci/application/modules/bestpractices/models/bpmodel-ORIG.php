<?php
// $a is used throughout this class to be the internal buffer for output that is being accumulated by successive calls
class Bpmodel extends CI_Model {
  
  
    function __construct()
    {
  
        parent::__construct();
    }
    
    /**
     * getCatsArray
     * returns array of id=>catname
     */
    function getCatsArray()
    {
        //$queryAllCats = 'SELECT tbl_category.id , tbl_category.name 
        //                FROM tbl_category
        //                ORDER BY tbl_category.moduleID ASC, tbl_category.sortorder ASC';
                $queryAllCats = 'SELECT tbl_category.id as catID, tbl_category.name as catName, tbl_module.name as moduleName ,tbl_category.moduleID , tbl_module.id 
                        FROM tbl_category
                        JOIN tbl_module
                        HAVING tbl_category.moduleID = tbl_module.id 
                        ORDER BY tbl_category.moduleID ASC, tbl_category.sortorder ASC';
        
        $query = $this->db->query($queryAllCats);
        $arrCats =$query->result_array();
        // now loop through the result calling bpByCat to return an array , but wtf would I do with it?
        //foreach ($query->result_array() as $row)
        //{
        //  $arrCats[$row->id] = $row->name;
        //}
        return $arrCats;
    }
      
 
    
    //put the bps into the cats array
    function bpByCat($categID, $excel)
    {
        
        $this->db->select('statement');
        $this->db->where('categoryID',$categID);
        $this->db->where('excel',$excel);
        $this->db->where('display', 1);
        $this->db->order_by('sortorder');
        
        $query=$this->db->get('tbl_bp');
        return $query->result_array();
        
    }  
    
    /** Nov 20 2012
     * why is this only returning $a?
     */
    
    function getBPs($categID, $excel)
    {

        //$this->db->select('statement');
        $this->db->select('id, statement');
        $this->db->where('categoryID',$categID);
        $this->db->where('excel',$excel);
        $this->db->where('display', 1);
        $this->db->order_by('sortorder');
        
        $query=$this->db->get('tbl_bp');
        
        $a='';
        
        
        if($query->num_rows() > 0)          // don't write anything unless there's something to wrte
        {
            $a.= ($excel == 1)?'<h3>Excellent</h3>':'';     // if excel = 1 then this is a list of 
            
        }
        return $a;
   
    }



// insert new best practice
    function bp_insert()
    {
        $data = array(
              'statement'   =>  $this->input->post('statement'),
              'categoryID'  =>  $this->input->post('category'),
              'excel'       =>  $this->input->post('excel'),
              'display'       =>  $this->input->post('display')
            );
    $this->db->insert('tbl_bp',$data);

    }
// update BP

    function bp_update()
    {
        $data = array(
              'statement'   =>  $this->input->post('statement'),
              'categoryID'  =>  $this->input->post('category'),
              'excel'       =>  $this->input->post('excel'),
              'display'       =>  $this->input->post('display')
            );
        
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('tbl_bp', $data);
        
        // $data['mainContent'] = 'bp/index';
        //$data['title'] = 'Home again';
        //
        //$this->load->view('template/template',$data);

    }

    function bp_delete()
    {
        $delID = $this->uri->segment(3);
        $this->db->delete('tbl_bp', array('id' => $delID));
        redirect('/bp','location');
        
    }

// produce an array of id => category
    function dropdownCats()
    {
        
        $this->db->select('id,name,moduleID,sortorder');
        $this->db->order_by('moduleID');
        $this->db->order_by('sortorder');
        
        $query = $this->db->get('tbl_category');
        $arrCats =array();
        foreach($query->result() as $row){
            $arrCats[$row->id]=$row->name;
        }
        return $arrCats;
    }
 
    
    
    /* get all the categories*/
    function getAllCats()
    {
        $queryAllCats = 'SELECT tbl_category.id as catID, tbl_category.name as catName, tbl_module.name as moduleName ,tbl_category.moduleID , tbl_module.id 
                        FROM tbl_category
                        JOIN tbl_module
                        HAVING tbl_category.moduleID = tbl_module.id 
                        ORDER BY tbl_category.moduleID ASC, tbl_category.sortorder ASC';
        
        $query = $this->db->query($queryAllCats);
        $a='';
        foreach($query->result() as $row)
        {
     
            $a .= '<h2>';
            $a .= $row->catName;
            $a .= '</h2>';
            $a .= '<p>';
            $a .= $row->moduleName;
            $a .= '</p>';
           
            $a .= $this->getAllBPs($row->catID);
        }
        

        return $a;
    }
  
//    //make 2 lists, first the normal BPs then the excellent BPs, if there are any
    function getAllBPs($categID)
    {
        $a = $this->getBPs($categID,0);
        $a .= $this->getBPs($categID,1);
        return $a;
       //return __FUNCTION__;
    }
//    
//  
//    /* select the BPs for one module and previous
//    it should produce, eg
//    
//module 3
//    cat12
//        bp51
//        bp23
//    cat13
//        bp111
//        bp23
// then
// 
// module 1
//    cat1
//        bp1
//        etc
//module 2
//
//ie the sort order from the query where module id <= 4
//should be 4,1,2,3
//
//      
//        
//    
//    
//    */
//    
//    
    function CatsbyModule()
    {
        $modID= $this->uri->segment(3);
         $queryAllCats = "SELECT tbl_category.id as catID, tbl_category.name as catName, tbl_module.name as moduleName ,tbl_category.moduleID , tbl_module.id 
                            FROM tbl_category
                            JOIN tbl_module
                            HAVING tbl_category.moduleID = tbl_module.id
                            AND tbl_category.moduleID = $modID 
                            ORDER BY tbl_category.moduleID ASC, tbl_category.sortorder ASC";

        $query = $this->db->query($queryAllCats);
        $arrCats = $query->result_array($query);
        
        $a='';
        foreach($arrCats as $row)
        {
            $a .= '<h2>';
            $a .= $row['catName'];
            $a .= '</h2>';
            $a .= '<p>';
            $a .= $row['moduleName'];
            $a .= '</p>';
           
            $a .= $this->getAllBPs($row['catID']);
        }
$a .= '<hr />';
// now repeat the above, but with the module id < $moduleID

        $queryAllCats = "SELECT tbl_category.id as catID, tbl_category.name as catName, tbl_module.name as moduleName ,tbl_category.moduleID , tbl_module.id 
                        FROM tbl_category
                        JOIN tbl_module
                        HAVING tbl_category.moduleID = tbl_module.id
                        AND tbl_category.moduleID < $modID  
                        ORDER BY tbl_category.moduleID ASC, tbl_category.sortorder ASC"; 
        
        $query = $this->db->query($queryAllCats);
        $arrCats = $query->result_array($query);
        
        foreach($arrCats as $row)
        {
            $a .= '<h2>';
            $a .= $row['catName'];
            $a .= '</h2>';
            $a .= '<p>';
            $a .= $row['moduleName'];
            $a .= '</p>';
           
            $a .= $this->getAllBPs($row['catID']);
        }
        return $a;
    }
//..

//    /**
//    * make a list of all best practices for updaate/delete functions
//    * requires table name
//    * returns list of links to update or delete all records
//    */
//    
    function makeAdminMenu()
    {
        //$this->load->library('table');
        $query = $this->db->query('SELECT id, statement FROM tbl_bp ORDER BY id DESC');
       // $query = $this->db->get('tbl_bp');
        return  $query->result_array($query);
    }
//    
//    // get data for the updateBP form
    function getBPbyID()
    {
        $id = $this->uri->segment(3);
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_bp');
        return $query->result_array($query);
    }
//    
//    
//    function updateBP()
//    {
//        $this->db->update('tbl_bp', $data, "id = 4");
//    }
    
#####################    MAKE THE FRONT PAGE      ############################
/**
 * getTheList
 * assemble an array of all best practices
 * $arr['module]['category']['regular/distinction']['BP statement']
 * $arrBP = 'regular' => array(bp1, bp2, bp3 ...),

 *
 * The views can walk through this array writing our each one differently depending on the results required
 *  Write the innermost arrays first?
 *1) $moduleQuery = SELECT id, name FROM tbl-module
 *
 *2) $bpHeadingsQuery = SELECT id, name FROM tbl_category WHERE moduleID = $row['moduleID'] ORDER BY sortorder
 *      
 *
 *3a) $statementQueryReg = SELECT statement FROM tbl_bp WHERE categoryID = (this heading ID) AND display = 1 AND excel = 0 ORDER BY sortorder
 *
 *  
 *3b) $statementQueryReg = SELECT statement FROM tbl_bp WHERE categoryID = (this heading ID) AND display = 1 AND excel = 1 ORDER BY sortorder
 *
 * 1)  foreach(module){
 *      i)get all the BP headings (categories) WHERE category.moduleID = (this module's id)
 *      ii) store them in $array['moduleName']['heading']
 *
 * 2)         foreach(category){
 * 3a)           a) get the statements for this category where excel = 0 and save them in an array $arr[module][heading][regular]['statement1','statement2', ....]
 * 3b)          b) get the statements for this category where excel = 1 and save them in an array $arr[module][heading][distinction]['statement1','statement2', ....]
 *              } // end foreach(category)
    
 } // end foreach(module)
 *
 */

/**
 *  function getSelection($id)
 *  assemble array of the selected module's bps, then all the previous, in module order
 *  
 */
function getSelection()
{
    
    $moduleID = $this->uri->segment(3);

    $arrModule = $this->theWholeLot($moduleID);
    $i=$moduleID;
    $limit = $moduleID-1;
    $arrAll = $arrModule;
    for($i=1;$i <= $limit; $i++)
    {
       $arrRest = $this->theWholeLot($i);  //  NO.  This needs to be limited to modules 1 - ($id -1)
    //$arrRestDESC = array_reverse($arrRest);
    $arrAll = array_merge($arrAll,$arrRest); 
    }
    
    
    return $arrAll;
    
}



/**
 *  the WholeLot
 *  collects all the BP statements as an array $arr[module][category][level][statement1,statement2,...]
 *  $id to get one module only
 */
function theWholeLot($moduleID=0){
    $arrAll = array();

    $arrModules = $this->getAllModules($moduleID);
    // set the module name as the key of the $arrAll
    // we will assign the value of the array of categories for this module in the first step,
    foreach($arrModules as $rowModule){
                
        $arrAll[$rowModule['name']] = array(); // sets the module name as the key
        
        $arrCats = $this->getCatsById($rowModule['id']); // get array of categories
            foreach($arrCats as $id => $rowCats){
                $bpPass = $this->getBPbyCat($rowCats['id'], 0);
                $bpDistinction = $this->getBPbyCat($rowCats['id'], 1);
                if(count($bpPass)>0)
                {
                    $arrAll[$rowModule['name']][$rowCats['name']]['PASS'] = $bpPass; // PASS set in index.php
                }
                if(count($bpDistinction)>0)
                {
                    $arrAll[$rowModule['name']][$rowCats['name']]['BETTER'] = $bpDistinction; // ditto B
                }
            }
    }
    return $arrAll;
} // end function the WholeLt


/**
 *return array of [0][id & name] of all modules
 *  defaults to 0 to give all modules, otherwise gives all modules from id upwards
 *  so we can select just the group we need to follow the main module
 */
function getAllModules($id=0)
{
    if($id>0)
    {
        $this->db->where('id',$id);
    }
    $query = $this->db->get('tbl_module');            
    return $query->result_array();      
}

function getCatsById($id)
{
    $this->db->select('id,name');
    $this->db->where('moduleID', $id);
    $query = $this->db->get('tbl_category');           
    return $query->result_array();      
}


/* get the BPs for a category
   receives category id and $excel - boolean 0 = regular 1 = excellence
   returns simple array of best practice statements
   if $excel == 1 write the h3 headline before the unordered list
 */
function getBPbyCat($categID, $excel)
{

    $this->db->select('id,statement'); // select id here?
    $this->db->where('categoryID',$categID);
    $this->db->where('excel',$excel);
    $this->db->where('display', 1);
    $this->db->order_by('sortorder');
    
    $query=$this->db->get('tbl_bp');
    $arr =  $query->result_array();
    $arrBP = array();
    foreach($arr as $row)
    {
        array_push($arrBP,array($row['id'],$row['statement']) );
    }

    return $arrBP;
}   
    
    
    
    
} //end classPASS