<script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
{{-- <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-3.5.0.js" type="text/javascript"></script> --}}

<script>
  $("textarea").keydown(function (e) {
    if (e.keyCode == 13 && !e.shiftKey) {
      e.preventDefault();
    }
  });
</script>

<script>
  ko.bindingHandlers.nextFieldOnEnter = {
    init: function (element, valueAccessor, allBindingsAccessor) {
      $(element).on('keydown', 'input, textarea, select, button, a.btn, .btn', function (e) {
        var self = $(this),
          form = $(element),
          focusable, next;
        if (e.keyCode == 13 && !e.shiftKey) {
          focusable = form.find('input:not([ignore]), input:not([readonly]), select, textarea, button, a.btn, .btn').filter(':visible');
          var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
          next = focusable.eq(nextIndex);
          next.focus();
          return false;
        }
        if (e.keyCode == 9) {
          e.preventDefault();
        }
      });
    }
  };
  ko.applyBindings({});

</script>


{{-- <script>
  ko.bindingHandlers.nextFieldOnEnter = {
    init: function (element, valueAccessor, allBindingsAccessor) {
      $(element).on('keydown', 'button, input, textarea, select, a.btn', function (e) {
        var self = $(this),
          form = $(element),
          focusable, next;
        if (e.keyCode == 13 && !e.shiftKey) {
          focusable = form.find('input, a, select, textarea, button, .btn').filter(':visible');
          var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
          next = focusable.eq(nextIndex);
          next.focus();
          return false;
        }
        if (e.keyCode == 9) {
          e.preventDefault();
        }
      });
    }
  };
  ko.applyBindings({});
</script> --}}

