<?php
/**
 * views/CMS_update.php
 * SY  17/02/2013
 *	usually an update form has to have include a hidden form field containing the id of the row it is updating
 *	In this case I have stored the id in flashdata in the function getContentById() in cmsmodel.php because that is always called to populate the form, so it is available when the form is submitted, then it's gone.
 *	That means no hacker can look at the form at get a clue about how I name my database id fileds.
 */
$objContent = $query_result->row();


$title = $objContent->title;
$content = $objContent->content;

    echo form_open('cms/updatePage');
?>

    <label for="title">Title</label>
    <input type="text" name="title" id="name"  value="<?php echo set_value('title',$title); ?>"/>
	<?php echo form_error('title'); ?>
 
    <label for="content">Content</label>    
    <input type="text" name="content" id="content" value="<?php echo set_value('content', $content); ?>"/>
    <?php echo form_error('content'); ?> <!-- the validation error message-->
    <input type="submit" value="Click here to change your always insightful message" />
   
    </form>

</body>
</html>