<?php
/*  views/CMS_newPage.php
 *	default view for the CMS, and it 
 */ 

// if we hava list of pages, make it now
if(isset($pageList)){
	$list='<table>';
	foreach($pageList->result() as $row){
		$list .= '<tr>';
		$list .= '<td>';		
		$list .= '<a href="'.base_url().'cms/page/'.$row->id.'">'.$row->title.'</a>';
		$list .= '</td>';
		$list .= '<td>';
		$list .= '<a href="'.base_url().'cms/updatePage/'.$row->id.'">Update</a>';
		$list .= '</td>';
		$list .= '</tr>';
	}
	$list .= '</table>';
}

echo $list;

// the form
    echo form_open('cms/newPage');
?>
    <label for="title">Title</label>    
    <input type="text" name="title" id="name"  value="<?php echo set_value('title'); ?>"/>
	<?php echo form_error('title'); ?>
 
    <label for="content">Content</label>    
    <input type="text" name="content" id="content" value="<?php echo set_value('content'); ?>"/>
    <?php echo form_error('content'); ?> <!-- the validation error message-->
    
	<input type="submit" value="Click here to submit your tiresome thought" />
   </form>
