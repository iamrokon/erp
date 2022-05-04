<script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
  
<script>
  // Knockout
  ko.bindingHandlers.nextFieldOnEnter = {
      init: function (element, valueAccessor, allBindingsAccessor) {
          $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function (e) {
              var self = $(this),
                  form = $(element),
                  focusable, next;
              if (e.keyCode == 13 && !e.shiftKey) {
                  focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
                  // focusable = form.find('input:not([ignore]), select, textarea, button:not([ignore]), a.btn').filter(':visible');
                  var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                  next = focusable.eq(nextIndex);
                  next.focus();
                  return false;
              }
              if (e.keyCode == 9) {
                  e.preventDefault();
              }

              // Shift+Enter to select table row
              if (e.keyCode == 13 && e.shiftKey) {
                var rowSelect2 = $('.rowSelect');
                $(this).trigger('click');
              }
          });
      }
  };
  ko.applyBindings({});

</script>


 <!-- Check uncheck for table settings -->
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

<!-- table col select js start -->
<script type="text/javascript">
  $(document).ready(function(){
      $('th.signbtn').click(function() {
      $(this).addClass('highlight').siblings().removeClass('highlight');
        var th_index = $(this).index();
        $('#userTable tr').each(function() {
            $(this).find('td').eq(th_index).addClass('tdhighlight').siblings().removeClass('tdhighlight');
        });
      });
    });
</script>
<!-- table col select js end -->

<script type="text/javascript">
  //Tab first field focus....
    $(document).on('shown.bs.modal', function(e) {
      if ('button[data-toggle="modal"]') {
        $('[autofocus]', e.target).focus();
      }
    });
</script>
<!-- modal overlay -->
<script type="text/javascript">
  $(".modal").on("shown.bs.modal", function () {
      if ($(".modal-backdrop").length > 1) {
          $(".modal-backdrop").not(':first').remove();
      }
    });
</script>
<!-- modal overlay -->
<script>
  // Modal first focus....
  $(document).on('shown.bs.modal', function(e) {
    $('[autofocus]', e.target).focus();
  });
</script>