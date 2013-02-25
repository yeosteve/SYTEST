$(document).ready(function() {

baseURL = 'http://sy.yoobee.net.nz/';
 
/* ********  BIND EVENTS TO DOCUMENT TO ENABLE NEWLY INTRODUCED ELEMENTS  ***   */
// make an update form in lightbox
$(document).on('click', '.jqupdate', function(){
    makeUpdateForm(this);
});

// update a Best Practice
$(document).on('click','#BPUpdate', function(event){
    
    //alert($(this).parent().attr('class'));
    event.preventDefault();
    updateBP(this);
});

// make a new BP form in lightbox
$(document).on('click','#linkNewBP', function(event){
   // event.preventDefault();
    makeNewBPForm();
});

//newBP
// make a new Best Practice
$(document).on('click','#newBP', function(event){
    event.preventDefault();
    insertBP(this);
});
/*  Functions called by the above events  */

function makeNewBPForm(){    
    //event.preventDefault();
    var loadUrl = baseURL+"bestpractices/admin/newBPForm";
    fadeInLightbox(loadUrl);
} // end makeNewBP


// update a Best Practice
// requires the this array from the on click event.
function insertBP(self){
    event.preventDefault();

    $.ajax({
    url: "http://sy.yoobee.net.nz/bestpractices/admin/handleNewBP",
    data: $(self).parent().parent().serialize(), // gets all the data from the form
    type: 'POST',
    success: function(data){
        // close the form and background
        $("#formContainer").fadeOut(300);
        $("#cover").fadeOut(300)
        // get the list & replace the old one
                $.ajax({
               url:'http://sy.yoobee.net.nz/bestpractices/makeList',
               success: function(response){
                   $('#container').html(response);
               }
               });
        
        } // end of success
    });

} // end insertBP

// requires the this array from the on click event.
// the clicked element must contain data-uid="xx"

function makeUpdateForm(self){
    // load the update form
        var updateId= $(self).data('uid');
        var loadUrl = "http://sy.yoobee.net.nz/bestpractices/admin/updateBP/"+updateId;
        fadeInLightbox(loadUrl);
} // end makeUpdateForm
   
// update a Best Practice
// requires the this array from the on click event.

function updateBP(self){
console.log($(self).parent().parent().serialize());
    $.ajax({
    url: "http://sy.yoobee.net.nz/bestpractices/admin/handleUpdateBP",
    data: $(self).parent().parent().serialize(), // gets all the data from the form
    type: 'POST',
    success: function(data){
        // close the form and background
        $("#formContainer").fadeOut(300);
        $("#cover").fadeOut(300)
        // get the list & replace the old one
                $.ajax({
               url:'http://sy.yoobee.net.nz/bestpractices/makeList',
               success: function(response){
                   $('#container').html(response);
               }
               });
        
        } // end of success
    });

} // end updateBP

function fadeInLightbox(loadUrl){
    $('#cover').fadeIn(300, function(){
        $("#formContainer").fadeIn(300, function(){
           $.ajax({
              url:loadUrl,
              success: function(data){
                  $('#formContainer').html(data);
                }
           }); // end ajax
        });  // end $("#formContainer").fadeIn(
    }); // end $('#cover').show(
}
// close the lightbox
$('#cover').click(function(){
    $("#formContainer").fadeOut(300, function(){
        $('#cover').fadeOut(300);
    });
});

/*******  sorting  *********************/

 //$('.sortable').sortable({
 //       containment: 'document',
 //       opacity: '0.5',
 //       //connectWith: '.sortable',
 //       cursor: 'move',
 //       revert: 'true',
 //       update: function(event, ui){
 //          // alert($(this).attr('class'));
 //           newOrder = $(this).sortable("serialize");
 //          // var Vis = $(this).attr("id");
 //           console.log(newOrder);
 //           //alert(newOrder);
 //   //Send data to controller------------------------
 //           $.ajax({
 //               url: "http://sy.yoobee.net.nz/bestpractices/changeorder",
 //               type: "POST",
 //               data: newOrder,
 //               // complete: function(){},
 //               success: function(feedback){
 //                    $("#test").html(feedback);
 //                    //$.jGrowl(feedback, { theme: 'success' });
 //               }
 //           });
 //   //------------------------------------------------   
 //           
 //       }
 //       
 //   });
 /*.bind('sortupdate', function() {
    var id = $(this).find(".jqupdate").data('uid');
//    var info;
   var stuff = $(this).find('li').map(function() {
        // $(this) is used more than once; cache it for performance.
        var $item = $(this);
 
        return { 
              // Note: using .data() to read HTML5 data- attributes 
              //  requires jQuery 1.4.3+. Use attr() in older versions.
              uid: $item.data('uid'), 
              text: $item.text()
            };
    }).get();
    
    
    var myJSONText = JSON.stringify(stuff);
  console.log(myJSONText);
  console.log(stuff);
   $.ajax({
              url: 'http://sy.yoobee.net.nz/bestpractices/changeorder',
              data: $(this).sortable("serialize"),
              //data: stuff,
             type:'POST',
              success: function(data){
                  $('#test').html(data);
                }
           }); // end ajax
//    //Triggered when the user stopped sorting and the DOM position has changed.
});*/


//$('.sortable').sortable({
//    connectWith: '.sortable',
//    bind(sortupdate : function () { 
//     alert('sorted') 
//    )} 
//});
// http://encosia.com/use-jquery-to-extract-data-from-html-lists-and-tables/
$('.sortable').sortable({connectWith: '.sortable'}).bind('sortupdate', function() {
    var id = $(this).find(".jqupdate").data('uid');
    var info;
    var order = $(this).sortable("serialize");
    var stuff = $(this).find('li').map(function() {
        // $(this) is used more than once; cache it for performance.
        var $item = $(this);
        return { 
   
              // Note: using .data() to read HTML5 data- attributes 
              //  requires jQuery 1.4.3+. Use attr() in older versions.
              //uid: $item.data('uid'),
              //text: $item.text(),
              //classs:$item.parent().parent().find('h3').attr('class'),
              categ: $item.parent().parent().find('h3').attr('data-catid'),
              course: $item.parent().parent().find('h2').attr('data-courseid'),
              bpid: id,
              sortorder: order
              
              
            };
    }).get();
    
    
    var myJSONText = JSON.stringify(stuff);
   console.log(myJSONText);
   $.ajax({
              url: 'http://sy.yoobee.net.nz/bestpractices/changeorder',
              //data: $(this).sortable("serialize"),
              data: {mine:myJSONText},
             type:'POST',
              success: function(data){
                  $('#test').html(data);
                }
           }); // end ajax
    //Triggered when the user stopped sorting and the DOM position has changed.
});


});  // end document.ready

