<script type="text/javascript">
  var state = false; // desecelted
  $('.checkall').click(function () {
    $('.customCheckBox').each(function () {
      if (!state) {
        this.checked = true;
      }
    });
  });
  //Unchecked....
  $('.uncheck').click(function () {
    $('.customCheckBox').each(function () {
      if (!state) {
        this.checked = false;
        $("input[type='tel']").val("");
      }
    });
  });
</script>
<script>
  // Modal first focus....
  $(document).on('shown.bs.modal', function(e) {
    $('[autofocus]', e.target).focus();
  });
</script>
<script>
    document.querySelector(".num-input").addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });
</script>
