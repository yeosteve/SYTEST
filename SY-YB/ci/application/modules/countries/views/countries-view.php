<!-- country.city selector with Jquery and CodeIgniter -->

<select id="countries">
	
<?php

echo $countryOptions;
?>
</select>

<select id="cities">
	<option>Select a country first</option>
</select>



</div> <!-- / container -->
<div id="notes">
	
	<table>
		<tr><td >Model</td><td>Countries->countries(); 
		</td></tr>
		<tr><td>View</td><td>countries-view.php</td></tr>
		<tr><td>Controller</td><td>lists/index</td></tr>
	</table>
	AJAX
		<table>
		<tr><td >Model</td><td>Countries->cities($countryID);	; 
		</td></tr>
		<tr><td>View</td><td>none - content is echoed directly from controller</td></tr>
		<tr><td>Controller</td><td>lists/makecities/'+id,</td></tr>
	</table>
	

	
</div>	
	

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="http://natcoll.net.nz/JS-LIBS/jquery-1.7.1.min.js"><\/script>')</script>
  <script>
  // get the cities when a country is selected
	$(document).ready(function(){
		
		//$('#countries').load('lists/makecountries');
		
		//$('#countries').change(function(){
		//	var id = $(this).val();
		//	$('#cities').load('lists/makecities/'+id );	
		//});
		
		$('#countries').change(function(){
			var id = $(this).val();
		$.ajax({
			url: '<?=base_url()?>lists/makecities/'+id,
			success: function(data) {
			  $('#cities').html(data);
			}
		  });
		});
		
	}); //end jquery
  </script>