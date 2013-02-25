<?php
// create a new BP form
    $attribs = array('class'=>'adminForm');
    echo form_open('admin/newbp',$attribs);
    
    echo form_fieldset('New Best Practice');
    echo form_label('Statement');
    
    $attribs = array('name'=>'statement','id'=>'statement','cols'=>'95','rows'=>'5');
    echo form_textarea($attribs);
    
    echo form_label('Category');
    $options = $arrCats;
    echo form_dropdown('category', $options, '');
    
    echo form_label('Check for advanced BP');
    echo form_checkbox('excel', '1', FALSE);

    echo form_label('Uncheck to hide');
    echo form_checkbox('display', '1', TRUE);
    
    echo '<input type="submit" name="newBP" id="newBP" value="Make a new BP" />';
    echo form_fieldset_close();
    echo form_close(); 