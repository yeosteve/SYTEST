<?php
/*  views/CMS_admin.php
 *	displays a list of the pages with links to either view them or update them
 *	 also displays the form to create a new page
 */ 

// if we hava list of pages, make it now
if(isset($pageList)){
	$list='<table>';
	foreach($pageList->result() as $row){
		$list .= '<tr>';
		$list .= '<td>';
		
		$list .= '<a href="'.base_url().'cms/index/'.$row->id.'">'.$row->title.'</a>';
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
   
   
   
   
   
   
