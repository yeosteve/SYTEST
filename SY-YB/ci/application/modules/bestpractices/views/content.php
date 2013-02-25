<!--<ul id="sortable">
    <li id="1">Item 1</li>
    <li id="2">Item 2</li>
    <li id="3">Item 3</li>
</ul>-->

 
<!--<ul id="test-list">
    <li class="ui-state-default" id="test_1"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>
    <li class="ui-state-default" id="test_2"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>
    <li class="ui-state-default" id="test_3"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>
    <li class="ui-state-default" id="test_4"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>
    <li class="ui-state-default" id="test_5"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>
    <li class="ui-state-default" id="test_6"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>
    <li class="ui-state-default" id="test_7"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li>
</ul>-->

 <ul id="test-list"> 
<li id="listItem_1" data-uid="1"> 
<img src="images/arrow.png" alt="move" width="16" height="16" class="handle" /> 
gyuogugougou</li>
<li id="listItem_2" data-uid="2"> 
<img src="images/arrow.png" alt="move" width="16" height="16" class="handle" /> 
comenntnj;xvk</li>
<li id="listItem_3" data-uid="3"> 
<img src="images/arrow.png" alt="move" width="16" height="16" class="handle" /> 
Tis so too</li>
<li id="listItem_4" data-uid="4"> 
<img src="images/arrow.png" alt="move" width="16" height="16" class="handle" /> 
it works</li>
<li id="listItem_5" data-uid="5"> 
<img src="images/arrow.png" alt="move" width="16" height="16" class="handle" /> 
gggg</li>
<li id="listItem_6" data-uid="6"> 
<img src="images/arrow.png" alt="move" width="16" height="16" class="handle" /> 
gggg</li>
<li id="listItem_7" data-uid="7"> 
<img src="images/arrow.png" alt="move" width="16" height="16" class="handle" /> 
First comment</li>
<li id="listItem_8" data-uid="8"> 
<img src="images/arrow.png" alt="move" width="16" height="16" class="handle" /> 
gggg</li>
<li id="listItem_9" data-uid="9"> 
<img src="images/arrow.png" alt="move" width="16" height="16" class="handle" /> 
gggg</li>
<li id="listItem_10" data-uid="10"> 
<img src="images/arrow.png" alt="move" width="16" height="16" class="handle" /> 
fourth one</li>
<li id="listItem_11" data-uid="11"> 
<img src="images/arrow.png" alt="move" width="16" height="16" class="handle" /> 
thirdcomment</li>
<li id="listItem_12" data-uid="12"> 
<img src="img/arrow.png" alt="move" width="16" height="16" class="handle" /> 
secondcomment</li>
</ul> 

<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script> <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"></script>

<script src="http://sy.yoobee.net.nz/js/jquery.sortable.min.js"></script>  <script>jQuery.ui || document.write('<script src="http://webconsultant.co.nz/jslibs/jquery-ui-1.8.17.custom.min.js"><\/script>')</script>
  
<script>
$(function(){
//$('#vis-checklist, #nonvis-checklist').sortable({
//	containment: 'parent',
//	opacity: '0.5',
//	update: function(e, ui){
//		newOrder = $(this).sortable("serialize");
//		console.log(newOrder);
//
////Send data to controller------------------------
//		$.ajax({
//			url: "http://m.moolla.natcoll.net.nz/_Assignments/Industry/setup/do_sort",
//			type: "POST",
//			data: newOrder,
//			// complete: function(){},
//			success: function(feedback){
//				 $("#test").html(feedback);
//				 //$.jGrowl(feedback, { theme: 'success' });
//			}
//		});
////------------------------------------------------   
//		
//	}
//	
//});

$('#test-list').sortable({
	containment: 'parent',
	opacity: '0.5',
	update: function(e, ui){
		newOrder = $(this).sortable("serialize");
		console.log(newOrder);

//Send data to controller------------------------
		$.ajax({
			url: "http://m.moolla.natcoll.net.nz/_Assignments/Industry/setup/do_sort",
			type: "POST",
			data: newOrder,
			// complete: function(){},
			success: function(feedback){
				 $("#test").html(feedback);
				 //$.jGrowl(feedback, { theme: 'success' });
			}
		});
//------------------------------------------------   
		
	}
	
});	
//	$("#test-list").sortable({ 
//    //handle : '.handle',
//	type:'GET',
//    update : function () { 
//      var order = $('#test-list').sortable('serialize');
//	  alert(order);
//      $("#info").load("process-sortable.php?"+order); 
//    } 
//  });
//	
//	
//	$('#sortable').sortable({
//		update:function(){ alert('boo')}
//		});
//    $('#sortable').sortable({
//        update: function(event, ui) {
//            var stringDiv = "";
//            $("#sortable").children().each(function(i) {
//                var li = $(this);
//                stringDiv += " "+li.attr("id") + '=' + i + '&';
//            });
//			alert(stringDiv);
//            $.ajax({
//                type: "POST",
//                url: "'/admin/updateOrder'?>",
//                data: stringDiv
//            
//            }); 
//        }
 //   }); 
//   $( "#sortable" ).disableSelection();    
});
</script>
<!--http://forums.cibonfire.com/discussion/539/jquery-sortable-new-order-saved-to-database/p1-->