

<script src="<?php echo base_url(); ?>js/jquery-1.6.3.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.cookie.js"></script>
<script>
$(document).ready(function() {
   // put all your jQuery goodness in here.
 
   
//  http://sochinda.wordpress.com/2011/03/02/a-quick-code-igniter-and-jquery-ajax-tutorial/
      $.ajaxSetup ({  
          cache: false  
      });  
      var ajax_load = "<img src='<?php echo base_url(); ?>img/ajax-loader.gif' alt='loading...' />";
        var idupdate = this.id;
      var loadUrl = "<?php echo base_url(); ?>update_bp/";
   $('.jqupdate').click(function(){
   var cct = $.cookie('csrf_cookie_name');
    $("#formContainer").fadeIn(1000);
    
      //now do ajax to get the right update form, by calling controllers/update_bp, sending it the id of the record to diplay
      $.ajax({
        url: loadUrl,
        //data: id= idupdate,
        
        success: function(data){
            $("#formContainer").html(data);
        }
        });
      
      //load('<?php echo base_url(); ?>update_bp');
      
      return false;
      });
        
   });  // end document.ready




//  load() functions  
    //$(".jqupdate").click(function(){
    //  id= this.id;
    //   var loadUrl = "<?php echo base_url(); ?>ajax/update_bp/";
    //  $.post(loadUrl, id,
  //function(data){
  // //alert("Hello");
  //  $("#formContainer").fadeIn(1000).html(data).animate({height:300},1000);
  //}, "text");
  //  //alert(loadUrl);
  //     // $("#formContainer").fadeIn(1000).html(ajax_load).animate({height:300},1000).load(loadUrl);
  //     //arrID['id'] = id;
  //     //$.ajax({
  //     // url:loadUrl,
  //     // data:id,
  //     // success: function(data){
  //     //     $('#formContainer').html(data);
  //     //     alert('ok');
  //     // }
  //     //});
  //  });  
  // 

  /* call the update form*/
   
//   $('.jqupdate').click(function(){
//    //event.preventDefault();
//id= this.id;
//alert(id);
//    //$("#formContainer").load('<?php echo base_url().'update/index'; ?>');
//    $.ajax({
//  url: '<?php echo base_url().'update/index'; ?>',
//  success: function(data) {
//    $('#formContainer').html(data);
//    alert('Load was performed.');
//  }
//});
//   });
</script>

</body>
</html>