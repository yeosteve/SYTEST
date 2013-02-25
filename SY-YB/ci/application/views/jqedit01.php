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
	
}

echo '<hr />';
echo '<h1>'.$objContent->title,'</h1>';
echo '<hr />';
echo $objContent->content;
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!--<link rel="stylesheet" href="css/style.css">-->
  <!---->
<link rel="stylesheet" href="Public/css/jquery.wysiwyg.css" type="text/css">
</head>

<body>

  <div id="container">
    <header>
      <?=$list?>
     
<!--<button id="button_div_1" class="tab">Div1</button>
<button id="button_div_2" class="tab">Div2</button>-->
    </header>
    <div id="main" role="main">
    <div class="edit live" id="headline" data_live="live"><?=$objContent->title?></div>
<div class="edit_area live" id="content"  data_live="live"><?=$objContent->content?></div>
    </div>
    <footer>

    </footer>
  </div> <!--! end of #container -->


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="http://webconsultant.co.nz/jslibs/jquery-1.8.1.min.js"><\/script>')</script>
  
 <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
  <script>jQuery.ui || document.write('<script src="http://webconsultant.co.nz/jslibs/jquery-ui-min.1.8.23.js"><\/script>')</script>


  <!-- http://www.appelsiini.net/projects/jeditable-->
 <!-- http://www.appelsiini.net/2008/9/wysiwyg-for-jeditable-->
<script src="Public/js/jquery.wysiwyg.js" type="text/javascript"></script>
<script src="Public/js/jquery.jeditable.js"></script>
<script src="Public/js/jquery.jeditable.wysiwyg.js" type="text/javascript"></script>


  <script>
//https://github.com/jwysiwyg/jwysiwyg

  $(document).ready(function() {
    
     // when .live is moused over get the id and fill it up
  $(document).on('click','.tab', function(event){   
    var id = $(this).attr('id').replace('button_','');
    loadContent(id);	
  });
    
    function loadContent(divID){
     console.log('Public/data/'+divID+'.txt');
      $('#'+divID).load('Public/data/'+divID+'.txt');
    //$('#div_2').load('data/div_2.txt');
    }
    
     $('.edit').editable('jqedit/savePartPage', {
         indicator : 'Saving...',
         onblur: 'submit',
         tooltip   : 'Click to edit...'
     });
     
     
     $('.edit_area').editable('jqedit/savePartPage', { 
        type      : 'wysiwyg',
        onblur    : 'ignore',
        submit    : 'OK',
        cancel    : 'Cancel',
        data      : {csrf_SY_TEST: $.cookie('csrf_cookie_name')},
        wysiwyg   : { controls : { separator04         : { visible : true },
                                   insertOrderedList   : { visible : true },
                                   insertUnorderedList : { visible : true },
                                   increaseFontSize     : { visible : true }
                                }
                    }
        });




 });
  </script>
<!--  <script defer src="js/script.js"></script>-->
  <!-- end scripts-->

</body>
</html>
