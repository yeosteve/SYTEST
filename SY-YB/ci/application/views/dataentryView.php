<?php
/**
 *  Data entry test page
 */
?>
<html>
<head>

</head>
<body>
<h1>Data entry demo</h1>

<?php
// just some test data sent from the controller
//echo (isset($check))?$check:'no check';

    echo form_open('testing/dataentry');
?>
    <label for="comment">Comment</label>
    
    <input type="text" name="test" value="<?php echo set_value('test'); ?>"/>
   
    <input type="submit" value="Click here to submit your tiresome thought" />
    <?php echo form_error('test'); ?> <!-- the validation error message-->
    </form>

</body>
</html>