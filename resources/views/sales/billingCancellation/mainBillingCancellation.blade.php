@section('title', '請求締日取消')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求 >')
@section('menu-test5', ' 請求締日取消')
@section('tag-test', 'ここにはガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
	
	{{-- Including Common Header Starts Here --}}
	@include('layouts.header')
	{{-- Including Common Header Ends Here--}}
	
	{{-- Common Style Starts Here --}}
	@include('sales.billingCancellation.styles')
	{{-- Common Style Ends Here --}}

</head>

<body id="body" class="common-nav" style="overflow-x:visible;">
	<section>
		@include('layout.nav_fixed')
		<div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
			@include('sales.billingCancellation.billingCancellationTopSearch')
		</div>
	</section>
	<!-- office modal 4 -->
	@include('common.supplierModal_2')
	{{-- Footer Starts Here --}}
	@include('layout.footer_new')

	@include('layouts.footer')
	{{-- Footer Ends Here --}}

	<script type="text/javascript">
		// Date Picker Initialization
    $('#datepicker1_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 6,
        trigger: '#datepicker1_oen'
    });

    $('#datepicker1_oen').on('change focus', function () {
        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus(); //focusing current input on select
            $(this).datepicker('hide');

        }
    });

    $('#datepicker1_oen').on('keyup', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
        if (inputDateValue.length == 8) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let slicedDay = inputDateValue.slice(6, 8);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
            $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
            $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
            $('#datepicker2_oen').datepicker('update');
        }
    });
    // Update date value with slash on blur
    $('#datepicker1_oen').on('blur', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        }
        else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    
    //Enter press hide dropdown...
    $("#datepicker1_oen").keydown(function (e) {
        if (e.keyCode == 13) {
            $("#datepicker1_oen").datepicker('hide');
        }
    });
	</script>

	<!--  loading icon -->
	<script>
		$(document).ready(function(){
        $(".customalert, .loading-icon").hide();
        $("#contenthide").click(function(){
            $(".customalert,.loading-icon").toggle();
        });

    });
	</script>
	<script>
		$(document).ready(function () {
        $(".second-table").hide();
        $(".first-table").click(function () {
            $(".second-table").show();
        });
    });
    $(document).ready(function () {
        $(".third-table").hide();
        $(".second-table").click(function () {
            $(".third-table").show();
        });
    });
	</script>
  <script>
    //Click to hide calendar
    $("#add_icon").click(function () {
      $("#datepicker1_oen").datepicker('hide');
    });
  </script>

    <script>
        // Modal first focus....
        $(document).on('shown.bs.modal', function(e) {
            $('[autofocus]', e.target).focus();
        });
    </script>

	<!-- Hard reload js link starts here -->
	<script type="text/javascript">
		var billingCancellationLink = document.createElement("script");
		billingCancellationLink.type = "text/javascript";
		billingCancellationLink.src = "{{ asset('js/sales/billingCancellation/billingCancellation.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
		document.getElementsByTagName("head")[0].appendChild(billingCancellationLink);
	</script>
	<!-- Hard reload js link ends here -->
  {{-- Knockout - Enter to New Input Starts Here --}}
  {{-- @include('master.common.knockout') --}}
  <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
  <script>
    // Enter key press auto focus next input......
    ko.bindingHandlers.nextFieldOnEnter = {
      init: function (element, valueAccessor, allBindingsAccessor) {
        $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function (e) {
          var self = $(this),
            form = $(element),
            focusable, next;
          if (e.keyCode == 13 && !e.shiftKey) {
            focusable = form.find('input:not([disabled]), select, textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
            // focusable = form.find('input:not([ignore]), select, textarea, button:not([ignore]), a.btn').filter(':visible');
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

<script>
  ko.bindingHandlers.nextFieldOnEnter = {
       init: function(element, valueAccessor, allBindingsAccessor) {
           $(element).on('keydown', '.trfocus', function(e) {
               var self = $(this),
                   form = $(element),
                   focusable, next;

               if (e.keyCode == 13 && !e.shiftKey) {
                   focusable = form.find('.trfocus').filter(':visible');
                   var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                   next = focusable.eq(nextIndex);
                   next.find('.trfocus').addClass('rowSelect').focus();
                   // $(this).click();
                   return false;
               }
               if (e.keyCode == 13 && e.shiftKey) {
                   // alert('hello');
                   var rowSelect2 = $('.rowSelect');
                   $(this).trigger('click');

               }
           });
       }
   };
   ko.applyBindings({});
</script>          
  {{-- Knockout - Enter to New Input Ends Here --}}
</body>

</html>