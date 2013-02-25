<?php
/**
 *	views/CMSpage.php
 *	SY 17/02/2013
 *	Just shows the menu and the content
 *	It would be much better to create the menu once and save it,  to avoid having to ask the system to produce it for each page view, but that can wait. (Storing it in a session would be good)
 *
 */
$objContent = $query_result->row();

if(isset($pageList)){
	$list='<ul>';
	foreach($pageList->result() as $row){
		$list .= '<li>';		
		$list .= '<a href="'.base_url().'cms/index/'.$row->id.'">'.$row->title.'</a>';
		$list .= '</li>';
	}
	$list .= '</ul>';
	echo $list;
}

echo '<hr />';
echo '<h1>'.$objContent->title,'</h1>';
echo '<hr />';
echo $objContent->content;
