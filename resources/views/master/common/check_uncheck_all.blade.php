<script type="text/javascript">

  var state = false; // desecelted
  
  $('.checkall').click(function() {
    $('.customCheckBox').each(function() {
      if (!state) {
        this.checked = true;
      }
    });
  });
  
  //Unchecked....
  $('.uncheck').click(function() {
    $('.customCheckBox').each(function() {
      if (!state) {
        this.checked = false;
        $("input[type='tel']").val("");
      }
    });
  });
</script>