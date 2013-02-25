<?php
/** views/showComments.php
 * SY 7 Feb
 * displays all the comments from tbl_comments
 */

 ?>
 <div id="container">
	
	<?php
	// for each item in the $query_result object
	// run it through the result() method which will give us an object representing each row in turn
	// echo them out as you like.
	foreach($query_result->result() as $row) {
	     // $row['test']
	echo $row->date;
	echo $row->comments;
	echo '<hr />';
	}
	?>
	
 </div>