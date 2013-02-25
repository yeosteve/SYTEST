<?php
$attr = array("class"=>"cf");
   // echo form_open('a', $attr);
    echo '<form action="" >';
    echo '<fieldset>';
    echo form_label('BP statement','statement');
    
    $attr = array(
                  'name'   => 'statement',
                  'id'     => 'statement',
                  'value' => $updateDetails[0]['statement'] );
    echo form_textarea($attr);
    echo '<input type="hidden" value="'.$updateDetails[0]['id'].'" name="id" >';
  //  $attr = array(
  //                'name'   => 'id',
  //                'id'     => 'id',
  //                'value' => $updateDetails[0]['id'] );
  //echo form_hidden($attr);
          
    $attr = 'id   = "category"';  
    echo form_label('Category');
    echo form_dropdown('category', $arrCats, $updateDetails[0]['categoryID'], $attr );
    
    $attr = array(
        'name'  =>  'excel',
        'id'    =>  'excel',
        'value' =>  '1'
    );
    $attr['checked'] = ($updateDetails[0]['excel'] == 1)?TRUE:FALSE;
    
    echo form_label('Advanced');
    echo form_checkbox($attr);
  //  echo ($updateDetails[0]['excel'] == 1)?form_checkbox('excel', '1', TRUE):form_checkbox('excel', '1', FALSE);
 
    echo form_label('Uncheck to hide');
    echo ($updateDetails[0]['display'] == 1)?form_checkbox('display', '1', TRUE):form_checkbox('display', '1', FALSE);
   
    $arrAttr = array('name'=>'mysubmit', 'id'=>'BPUpdate');
    echo form_submit($arrAttr,'Submit!');
    echo '</fieldset>';
      echo form_close();
    ?>