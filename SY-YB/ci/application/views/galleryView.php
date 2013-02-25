<?
echo ucwords(str_replace('Public/','',$this->session->flashdata('galleryName')) );
?>
<a href="<?=base_url()?>ysgallery" >Back</a><div id="container">
<?php
 

	// for each item in the $query_result object
	// run it through the result() method which will give us an object representing each row in turn
	// echo them out as you like.
	foreach($query_result->result() as $row) {
	     // $row['test']
	echo '<div class="thumb">';
	// if (!file_exists(base_url().'Public/gallery/thumbs/'.$row->filename.)){
		// saveThumbAdaptive(base_url().'Public/gallery/thumbs/'.$row->filename);
		//}
		$size=getimagesize(base_url().'Public/gallery/thumbs/'.$row->filename);
		
            echo '<img src="'.base_url().'Public/gallery/thumbs/'.$row->filename.'" data-width="'.$size[0].'" data-height="'.$size[1].'" />';
        echo '</div> ';
            //echo $row->comment;
            //echo '<br />'.$row->date;
	}
        echo '<br />';
        echo $links;
	?>
	
 </div>

<div id="cover"></div>
<div class="centerMe">
<div id="fullDisplay"></div>
</div>


