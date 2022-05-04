<script>
  // hover message
  $(function() {
  
    $(".message_content").hover(function() {
      var mssg = $(this).attr("message");
      $('.hover_message').html(mssg);
    }, function() {
      $('.hover_message').html('');
    });
  });
  
  //message on hover on input in modal
  $(function() {
    $(".hover_message_content").hover(function() {
      var mssg = $(this).attr("message");
      $('.modal_hover_message').html(mssg);
    }, function() {
      $('.modal_hover_message').html('');
    });
  });
</script>