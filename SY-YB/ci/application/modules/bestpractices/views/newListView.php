<?php

//main array produces courses - selected, then previous in course order
// 2nd array is categories within that course
// 3rd array is excel rating
// 4 level array is bp statements

//
//Make the display for the main page including admin buttons
//$aCourses = whatever('SELECT id, name FROM tbl_course');  array(id=>1, name=>WE01)
//foreach($aCourses as $k=>$courseRow){
//$aCatsPerCourse = whatever('SELECT id as CourseID, name FROM tbl_category WHERE moduleID = courseID');
//$aProgramme = array(CourseID =>$aCourses) 
//
//} // end foreach($aCourses
//$arrProgramme = array(
//            'course'=> array(
//                id=> 'idvalue',
//                name=>'coursename',
//                categories => array(
//                                id=>'catID',
//                                name=>'catname',
//                                excel => array(
//                                                0=>array(
//                                                    bpid=>'bpid',
//                                                    statement=>'statement'
//                                                ),
//                                                1=>array(
//                                                    bpid=>'bpid',
//                                                    statement=>'statement'
//                                                )
//                                        ) // end $arrProgramme['module']['categories']['excel']
//                                    
//                                    ) //end $arrProgramme['module']['categories']
//                            ) //end $arrProgramme['module']
//                    ); // end $arrProgramme

// array keys and closing brackets in one vertical line
$arrProgramme = array(
                1=> array(
                    'courseName'=> 'WE01',
                    'categories' => array(
                        1=>array(
                            'catName'=>'Cat1',
                            'excel'=> array(
                                0=>array(
                                    1=>'bp1',
                                    2=>'bp2'
                                    ),
                                1=>array(
                                    15=>'bp15',
                                    18=>'bp18'
                                )
                                )
                            ),
                        
                        
                        
                        2=>array(
                            'catName'=>'Cat2',
                            'excel'=> array(
                                0=>array(
                                    1=>'bp1',
                                    2=>'bp2'
                                    ),
                                1=>array(
                                    15=>'bp15',
                                    18=>'bp18'
                                )
                                )
                            ),
                        20=>array(
                            'catName'=>'Cat3',
                            'excel'=> array(
                                0=>array(
                                    1=>'bp1',
                                    2=>'bp2'
                                    ),
                                1=>array(
                                    15=>'bp15',
                                    18=>'bp18'
                                )
                                )
                            )
                    )
                ),
                2=> array(
                    'courseName'=> 'WE02',
                    'categories' => array(
                        1=>array(
                            'catName'=>'Cat5',
                            'excel'=> array(
                                0=>array(
                                    1=>'bp66',
                                    2=>'bp26'
                                    ),
                                1=>array(
                                    15=>'bp156',
                                    18=>'bp186'
                                )
                                )
                            ),
                        
                        
                        
                        2=>array(
                            'catName'=>'Cat26',
                            'excel'=> array(
                                0=>array(
                                    1=>'bp16',
                                    2=>'bp26'
                                    ),
                                1=>array(
                                    15=>'bp156',
                                    18=>'bp186'
                                )
                                )
                            ),
                        20=>array(
                            'catName'=>'Cat36',
                            'excel'=> array(
                                0=>array(
                                    1=>'bp16',
                                    2=>'bp26'
                                    ),
                                1=>array(
                                    15=>'bp165',
                                    18=>'bp18'
                                )
                                )
                            )
                    )
                )
		    /*,
                
                
                
                2=>'WE02',
                3=>'WE03'*/
                      
); // end $arrProgramme

                      
//echo 'DB<pre>';
//print_r($arrProgrammes);
//echo '</pre>'; 
//
//echo 'Hardcoded<pre>';
//print_r($arrProgramme);
//echo '</pre>';
$html = '';
foreach($arrProgrammes as $courseKey=>$rowCourse) { 
    $html .=  '<section >';
       $html .=  '<input type="checkbox" value="'.$rowCourse['id'].'" />';
      $html .=  '<h2 data-courseid="'.$rowCourse['id'].'">Course:- '.$rowCourse['name'].'</h2>';// <!--course id & name-->  eg We01-Web Communication
      $arrCats = $rowCourse[0];
	  foreach($arrCats as $k=>$cat){
      $html .= '<h3 data-catid="'.$cat['id'].'">'. $cat['name'].'</h3>'; 
            $arrBPs = $cat[0];
            $html .= '<b>PASS</b><br />';
            $html .= '<ul class="sortable">';
            foreach($arrBPs as $excel=>$arrBp)
                $html .= '<li>'.$arrBp[1].'</li>';
                $html .= '</ul>';
                 
                 $arrBPs = $cat[1];
                 if(count($arrBPs > 0)) {
                    $html .= '<b>AWESOME</b><br />';
                    $html .= '<ul class="sortable">';
                        foreach($arrBPs as $excel=>$arrBp)
                            $html .= '<li>'.$arrBp[1].'</li>';
                        }
                    $html .= '</ul>';
	  }
////
//           foreach($arrCourse['categories'] as $k => $arrCat){
//			$html .= 'Category: -'.$arrCat['catName'].'<hr />';
//			foreach($arrCat['excel'] as $key => $bps){
//				$html .= ($key==0)?'Pass':'Excellent';
//					$html .= '<br />';
//				
//				foreach($bps as $bpID => $bpStatement){
//					$html .= $bpStatement;
//					$html .= '<br />';
//				}
//				
//				$html .= '<hr />';
//			}
//	     }
//                       $html .=  ($excel==0)?'PASS':'EXCELLENT';
//                      // foreach($arrCat)
//                //$html .=  '<h3 data-CatID="'.$arrCat['id'].'">'.$arrCat['name'].'</h3>';
////                    foreach($arrCat['excel'] as $excelKey => $arrBPs) {
////                        $html .=  '<h4>';
////                        $html .=  '</h4>';
////                        $html .=  '<ul>';
////                        foreach($arrBPs as $bpid => $statement){
////                            $html .=  '<li><input type="checkbox" />'.$statement.'<div  class="jqupdate" data-bpid="'.$bpid.'">Update</div></li>';
////                        }
////                        $html .=  '</ul>';
////                        
////                    } // end  foreach($arrCar['excel']
////                
////                
////                
//            } // endforeach($arrCourse['excel']
////
$html .=  '</section>'; 
}    //<!-- end foreach($arrProgramme
//
echo $html;

