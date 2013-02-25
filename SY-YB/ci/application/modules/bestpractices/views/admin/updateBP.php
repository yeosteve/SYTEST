<div id="container">
    <pre>
    <?php
    
        //exit(__FILE__.__LINE__);
   // print_r($updateDetails);
    $this->load->view('menu'); ?>
    </pre>
    Make a new Best Practice

    echo form_open('admin/updatebp');
    echo form_label('Best Practice statement','statement');
    
    $attr = array(
                  'name'   => 'statement',
                  'value' => $updateDetails[0]['statement'] );
    echo form_textarea($attr);
    
    echo form_hidden('id',$updateDetails[0]['id']);
    
    echo form_label('Category');    
    echo form_dropdown('category', $arrCats, $updateDetails[0]['categoryID']);
    
    echo form_label('Check for advanced BP');
    echo ($updateDetails[0]['excel'] == 1)?form_checkbox('excel', '1', TRUE):form_checkbox('excel', '1', FALSE);
 
    echo form_label('Uncheck to hide');
    echo ($updateDetails[0]['display'] == 1)?form_checkbox('display', '1', TRUE):form_checkbox('display', '1', FALSE);
    
    echo form_submit('mysubmit','Submit!');
    echo form_close();
    ?>

</div>

