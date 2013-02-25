
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css"/>

<div id="container">
    
<!--<div id="test">cjhcgjhchchjc</div>-->
<?php


/**
 *"Pass"  and "Distinction" should be defined as constants in a config file
 *
 *  Displays all the BPs in order of modules
 *  Requires one array of
 *  $arr[moduleName][categoryName][level][bp1,bp2,...]
 *
 *  foreach(modulename as ModName => categoryArray){
        echo '<h2>moduleName</h2>
        foreach(categoryArray as catName => BParray)
            echo '<h3>catName</h3>
            foreach(catName as level => BPs)
                echo (level == 1)?'Distinction':'Pass;
                $bpList = <ul>
                foreach(BPs as bp){
                    $bpList .= '<li>bp</li>
                }
                $bpList .= </ul>
 }
 *
 */

foreach($arrProgrammes as $module => $allTheCategoriesForOneModule){
    echo '<section>'."\n";
    echo '<input type="checkbox" />';
/*********************  Put the course id in here ************/
   echo '<h2 data-CourseID="1">';      
   echo $module;     // Module name  WE01 etc
   echo '</h2>'."\n";


   foreach($allTheCategoriesForOneModule as $categ=>$value){
    
      echo '<h3 data-catID="2" class="something">';
      echo $categ;
      echo '</h3>'."\n";
      foreach ($value as $k=>$v){
            echo '<h4>'.$k.'</h4>'."\n";
            
            echo '<ul class="sortable">'."\n";
            foreach($v as $z =>$bp){
               echo '<li  id="order_'.$bp[0].'"  ><input type="checkbox" />'.$bp[1].'<div  class="jqupdate" data-uid="'.$bp[0].'">Update'.$bp[0].'</div></li>'."\n";
            }
      echo '</ul>'."\n";
      }
      echo '<br />'."\n";
   }
   echo '</section>'."\n";
}
echo '<div id="test">TEST DIV</div>';
$this->load->view('menu');
?>
</div>

<div id="cover"><div id="results" style="color:white;font-size:100%;"></div></div>
<div id="formContainer"></div>