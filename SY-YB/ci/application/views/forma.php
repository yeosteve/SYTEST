<?php
/**
 *  Forms 1
 *  Write two identical forms - one with plain HTML, one wiwth the Form helper.
 *      ?? Why should you use the form helper??
 */
?>
<html>
<head>

</head>
<body>
FORM DEMO

<?php
    echo form_open('books/input');
    
?>
<form action="books/input" >
    
    
<label for="newField">New</label<input type="tel" name = "newField"/>
<?php
    echo 'title';
    echo form_label('Title', 'title');
    echo form_input('title'); 
    echo '<br />';
    echo 'AUTHOR';
    echo form_input('author'); 
    echo '<br />';
    echo 'Publisher'; 
    echo form_input('publisher'); 
    echo '<br />';
    echo 'YEAR'; 
    //echo form_dropdown('year',$years); 
    echo '<br />';
    echo 'AVAILABLE';
    echo form_checkbox('available','yes',TRUE); 
    echo '<br />';
    echo 'Summary';
    echo form_textarea('Summary'); 
    echo '<br />';
    echo form_submit('mysubmit','Submit!');
    echo form_close();
?>
</body>
</html>