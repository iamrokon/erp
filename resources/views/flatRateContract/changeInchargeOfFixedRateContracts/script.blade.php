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

{{-- Chech/Uncheck Scripts Starts Here --}}
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
{{-- Chech/Uncheck Scripts Ends Here --}}


<script type="text/javascript">
  $(document).ready(function(){
    $("#closetopcontent").click(function(){
      $(".pay_history_list_top_content").toggle();
    });
  });
 function contentHideShow() {
  var hideShow = document.getElementById("closetopcontent");
  if (hideShow.innerHTML === "閉じる") {
    hideShow.innerHTML = "開く";
  } else {
    hideShow.innerHTML = "閉じる";
  }
}
</script>

<script type="text/javascript">
$("#modalarea").on('click', function(){
  $(".modal-backdrop").addClass("overflow_cls");
});

$("#modalarea").on("click", function(){
$('.modal-backdrop').remove();
$('#modalarea').on('show.bs.modal', function (e) {
$('body').addClass('overflow_cls');

})
$('#modalarea').on('hide.bs.modal', function (e) {
$('body').removeClass('overflow_cls');
})
$("#modalarea").modal("hide");
});
</script>
<script>
  // select table col js start.......
$(document).ready(function(){
$('th.signbtn-select').click(function() {
  $('th.signbtn').removeClass('highlight');
$(this).addClass('highlight_select');
  var th_index = $(this).index();
  $('#userTable tr').each(function() {
  
      $(this).find('td').eq(th_index).addClass('tdhighlight').siblings().removeClass('tdhighlight');
  });
 
});
$(".chk-highlight").click(function(event){
  event.stopImmediatePropagation();
});


});
// select table col js end.......

// select table col js start.......
// $(document).ready(function(){
//   $('th.signbtn').click(function() {

//   $(this).addClass('highlight').siblings().removeClass('highlight');
//     var th_index = $(this).index();
//     $('#userTable tr').each(function() {
//         $(this).find('td').eq(th_index).addClass('tdhighlight').siblings().removeClass('tdhighlight');
//     });
//   });
// });
// select table col js end.......
</script>
<script>
  // Modal first focus....
  $(document).on('shown.bs.modal', function(e) {
    $('[autofocus]', e.target).focus();
  });
</script>