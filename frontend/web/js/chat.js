// Attach a submit handler to the form
$( "#postForm" ).submit(function( event ) {
 
    // Stop form from submitting normally
    event.preventDefault();
    // Get some values from elements on the page:
    var $form = $( this );
    var term = $form.find( "textarea[name='content']" ).val();
    var url = $form.attr( "action" );
    var posting = $.post( url, { data: term } );
  
    posting.done(function( data ) {
      document.getElementById("content").value = "";
      location.reload(); 
    });
  
  });