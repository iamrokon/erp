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
    });
  }
};
ko.applyBindings({});


$('.show_personal_master_info').on('click', function (e) {
  $(".tabledataModal6").addClass('intro');
  $("#product_sub_content2").show();
});

// Ignoring Disbale Button Function
// $(function () {
function ignoreDisabledButton(event) {
  if (event.keyCode == 13) {
    $("#pj").focus();
    event.preventDefault();
  }
}

// Focus number search
// function focusNumberSearch(event) {
//   // if (event.keyCode == 13) {
//   $("#number_search").focus();
//     event.preventDefault();
//   // }
// }

// });

// Show selected Data on Modal View
//$("#SoldToModal").on('shown.bs.modal', function () {
//  $('.add_border').scrollIntoView();
//});



// #SI - modified date function starts here
$(function () {
  // 受注日
  $('#datepicker1_oen').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 10,
    offset: 6,
  });

  $(document).on('change focus', '#datepicker1_oen', function () {
    if ($(this).is('[readonly]')) {
      $(this).datepicker('hide');
      $(this).css("pointer-events", "none");
    }
    else if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('#datepicker1_comShow').val($(this).val());
        let datevalue = $(this).siblings('#datepicker1_comShow').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '');
        $(this).val(formatted_date);
        $(this).focus();
        $(this).datepicker('hide');
      }
  });

  $(document).on('click', '#datepicker1_oen', function () {
    $(this).datepicker('show');
  });

  $(document).on('keyup', '#datepicker1_oen', function (e) {
    let inputDateValue = $(this).val();  //getting date value from input
    if (inputDateValue.length == 8) {
      let slicedYear = inputDateValue.slice(0, 4);
      let slicedMonth = inputDateValue.slice(4, 6);
      let slicedDay = inputDateValue.slice(6, 8);
      let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
      $(this).siblings('#datepicker1_comShow').val(formatted_sliced_date);
      $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
    }
  });
  // Update date value with slash on blur
  $(document).on('blur', '#datepicker1_oen', function () {
    if ($(this).val() != '') {
      $(this).val($(this).siblings('#datepicker1_comShow').val());
    } else if ($(this).val() == '') {
      $(this).val('');
      $(this).siblings('#datepicker1_comShow').val('');
    }
  });


  // 納期

  $('#datepicker2_oen').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 10,
    offset: 6,
  });

  $(document).on('change focus', '#datepicker2_oen', function () {
    if ($(this).is('[readonly]')) {
      $(this).datepicker('hide');
      $(this).css("pointer-events", "none");
    }
    else if ($(this).val().length == 10) {
      $(this).datepicker('update');
      $(this).siblings('#datepicker2_comShow').val($(this).val());
      let datevalue = $(this).siblings('#datepicker2_comShow').val();  //getting date value from calendar
      let formatted_date = datevalue.replaceAll('/', '');
      $(this).val(formatted_date);
      $(this).focus();
      $(this).datepicker('hide');
    }
  });

  $(document).on('click', '#datepicker2_oen', function () {
    $(this).datepicker('show');
  });

  $(document).on('keyup', '#datepicker2_oen', function (e) {
    let inputDateValue = $(this).val();  //getting date value from input
    if (inputDateValue.length == 8) {
      let slicedYear = inputDateValue.slice(0, 4);
      let slicedMonth = inputDateValue.slice(4, 6);
      let slicedDay = inputDateValue.slice(6, 8);
      let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
      $(this).siblings('#datepicker2_comShow').val(formatted_sliced_date);
      $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
    }
  });
  // Update date value with slash on blur
  $(document).on('blur', '#datepicker2_oen', function () {
    if ($(this).val() != '') {
      $(this).val($(this).siblings('#datepicker2_comShow').val());
    } else if ($(this).val() == '') {
      $(this).val('');
      $(this).siblings('#datepicker2_comShow').val('');
    }
  });


  // 検収日

  $('#datepicker3_oen').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 10,
    offset: 6,
  });

  $(document).on('change focus', '#datepicker3_oen', function () {
    if ($(this).is('[readonly]')) {
      $(this).datepicker('hide');
      $(this).css("pointer-events", "none");
    }
    else if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('#datepicker3_comShow').val($(this).val());
        let datevalue = $(this).siblings('#datepicker3_comShow').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '');
        $(this).val(formatted_date);
        $(this).focus();
        $(this).datepicker('hide');
      }
  });

  $(document).on('click', '#datepicker3_oen', function () {
    $(this).datepicker('show');
  });

  $(document).on('keyup', '#datepicker3_oen', function (e) {
    let inputDateValue = $(this).val();  //getting date value from input
    if (inputDateValue.length == 8) {
      let slicedYear = inputDateValue.slice(0, 4);
      let slicedMonth = inputDateValue.slice(4, 6);
      let slicedDay = inputDateValue.slice(6, 8);
      let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
      $(this).siblings('#datepicker3_comShow').val(formatted_sliced_date);
      $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
    }
  });
  // Update date value with slash on blur
  $(document).on('blur', '#datepicker3_oen', function () {
    if ($(this).val() != '') {
      $(this).val($(this).siblings('#datepicker3_comShow').val());
    } else if ($(this).val() == '') {
      $(this).val('');
      $(this).siblings('#datepicker3_comShow').val('');
    }
  });


  // 売上日
  $('#datepicker4_oen').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 10,
    offset: 6,
  });

  $(document).on('change focus', '#datepicker4_oen', function () {
    if ($(this).is('[readonly]')) {
      $(this).datepicker('hide');
      $(this).css("pointer-events", "none");
    }
    else if ($(this).val().length == 8) {
      $(this).datepicker('update');
      let datevalue = $(this).siblings('#datepicker4_comShow').val();
      let formatted_date = datevalue; 
      $(this).val(formatted_date);
      $(this).focus();
      $(this).datepicker('hide');
    }
    // else if ($(this).val().length == 10) {
    //     $(this).datepicker('update');
    //     $(this).siblings('#datepicker4_comShow').val($(this).val());
    //     let datevalue = $(this).siblings('#datepicker4_comShow').val();  //getting date value from calendar
    //     let formatted_date = datevalue.replaceAll('/', '');
    //     $(this).val(formatted_date);
    //     $(this).focus();
    //     $(this).datepicker('hide');
    //   }
  });

  $(document).on('click', '#datepicker4_oen', function () {
    $(this).addClass('focusInput');
    $(this).datepicker('show');
  });

  $(document).on('keyup', '#datepicker4_oen', function (e) {
    let inputDateValue = $(this).val();  //getting date value from input
    if (inputDateValue.length == 8) {
      let slicedYear = inputDateValue.slice(0, 4);
      let slicedMonth = inputDateValue.slice(4, 6);
      let slicedDay = inputDateValue.slice(6, 8);
      let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
      $(this).siblings('#datepicker4_comShow').val(formatted_sliced_date);
      $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
      $(this).addClass('focusInput');
    }
  });
  // Update date value with slash on blur
  $(document).on('blur', '#datepicker4_oen', function () {
    if ($(this).val() != '') {
      $(this).val($(this).siblings('#datepicker4_comShow').val());
    } else if ($(this).val() == '') {
      $(this).val('');
      $(this).siblings('#datepicker4_comShow').val('');
    }
  });



  // 入金日

  $('#datepicker5_oen').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 10,
    offset: 6,
  });

  $(document).on('change focus', '#datepicker5_oen', function () {
    if ($(this).is('[readonly]')) {
      $(this).datepicker('hide');
      $(this).css("pointer-events", "none");
    }
    else if ($(this).val().length == 10) {
      $(this).datepicker('update');
      $(this).siblings('#datepicker5_comShow').val($(this).val());
      let datevalue = $(this).siblings('#datepicker5_comShow').val();  //getting date value from calendar
      let formatted_date = datevalue.replaceAll('/', '');
      $(this).val(formatted_date);
      // $(this).focus();
      // $(this).datepicker('hide');
      // if ($('#datepicker4_oen').hasClass('focusInput')) {
      //   $('#datepicker5_oen').val($('#datepicker5_comShow').val()); //focusing current input on select
      //   $('#datepicker4_oen').focus();
      //   $('#datepicker4_oen').removeClass('focusInput');
      // }
      // else if ($('#reg_sales_billing_destination').hasClass('focusInput')) {
      //   $('#reg_sales_billing_destination').focus();
      //   $('#reg_sales_billing_destination').removeClass('focusInput');
      // }
      // else if ($('#reg_sold_to').hasClass('focusInput')) {
      //   $('#reg_sold_to').focus();
      //   $('#reg_sold_to').removeClass('focusInput');
      // }
      // else if ($('#datepicker5_oen').hasClass('focusInput')) {
      //   $(this).focus(); //focusing current input on select
      //   $(this).datepicker('hide');
      // }
      // else {
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
        // if ($('#number_search').val().length == 10) {
        //   $('.input_field').datepicker('hide');
        //   $('#number_search').focus();
        // }
      // }
    }
  });

  $(document).on('keyup', '#datepicker5_oen', function (e) {
    let inputDateValue = $(this).val();  //getting date value from input
    if (inputDateValue.length == 8) {
      let slicedYear = inputDateValue.slice(0, 4);
      let slicedMonth = inputDateValue.slice(4, 6);
      let slicedDay = inputDateValue.slice(6, 8);
      let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
      $(this).siblings('#datepicker5_comShow').val(formatted_sliced_date);
      $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
    }
  });

  $(document).on('click', '#datepicker5_oen', function () {
    $('#reg_sold_to').removeClass('focusInput');
    $('#datepicker4_oen').removeClass('focusInput');
    $('#datepicker5_oen').addClass('focusInput');
    $(this).datepicker('show');
  });

  // Update date value with slash on blur
  $(document).on('blur', '#datepicker5_oen', function () {
    if ($(this).val() != '') {
      $(this).val($(this).siblings('#datepicker5_comShow').val());
    } else if ($(this).val() == '') {
      $(this).val('');
      $(this).siblings('#datepicker5_comShow').val('');
    }
  });

  // /******************* Common Date Picker *******************/ //
  $('.datePicker').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 10,
    offset: 6,
  });

  $(document).on('change focus', '.datePicker', function () {
    if ($(this).val().length == 10) {
      $(this).datepicker('update');
      $(this).siblings('.datePickerHidden').val($(this).val());
      let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
      let formatted_date = datevalue.replaceAll('/', '');
      $(this).val(formatted_date);
      $(this).focus();
      $(this).datepicker('hide');
    }
  });

  $(document).on('click', '.datePicker', function () {
    $(this).datepicker('show');
  });

  $(document).on('keyup', '.datePicker', function (e) {
    let inputDateValue = $(this).val();  //getting date value from input
    if (inputDateValue.length == 8) {
      let slicedYear = inputDateValue.slice(0, 4);
      let slicedMonth = inputDateValue.slice(4, 6);
      let slicedDay = inputDateValue.slice(6, 8);
      let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
      $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
      $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
    }
  });
  // Update date value with slash on blur
  $(document).on('blur', '.datePicker', function () {
    if ($(this).val() != '') {
      $(this).val($(this).siblings('.datePickerHidden').val());
    } else if ($(this).val() == '') {
      $(this).val('');
      $(this).siblings('.datePickerHidden').val('');
    }
  });


  //Enter press hide dropdown
  $("#datepicker1_oen").keydown(function (e) {
    if (e.keyCode == 13) {
      $(this).datepicker('hide');
    }
  });

  $("#datepicker2_oen").keydown(function (e) {
    if (e.keyCode == 13) {
      $(this).datepicker('hide');
    }
  });

  $("#datepicker3_oen").keydown(function (e) {
    if (e.keyCode == 13) {
      $(this).datepicker('hide');
    }
  });

  $("#datepicker4_oen").keydown(function (e) {
    if (e.keyCode == 13) {
      $(this).datepicker('hide');
    }
  });

  $("#datepicker5_oen").keydown(function (e) {
    if (e.keyCode == 13) {
      $(this).datepicker('hide');
    }
  });

  $(".datePicker").keydown(function (e) {
    if (e.keyCode == 13) {
      $(".datePicker").datepicker('hide');
    }
  });

  $(".orderDate").keydown(function (e) {
    if (e.keyCode == 13) {
      $(".orderDate").datepicker('hide');
    }
  });

  $(".individualDeliveryDate").keydown(function (e) {
    if (e.keyCode == 13) {
      $(".individualDeliveryDate").datepicker('hide');
    }
  });

});
// #SI - modified date function ends here

$(document).on('shown.bs.modal', function (e) {
  $('[autofocus]', e.target).focus();
});
$(document).ready(function () {
  $("#closetopcontent").on('click', function () {
    $(".order_entry_topcontent").toggle();
    $('.content-bottom-section').css('margin-top', 38);
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


//Click to hide calendar
$("#add_icon").click(function () {
  $("#datepicker1_oen").datepicker('hide');
  $("#datepicker2_oen").datepicker('hide');
  $("#datepicker3_oen").datepicker('hide');
  $("#datepicker4_oen").datepicker('hide');
  $("#datepicker5_oen").datepicker('hide');
  $(".datepicker").datepicker('hide');
});
  
$(".institute,.se,.ship,.purchase").keyup(function () {
  let inputDateValue = $(this).val();  
  if(inputDateValue.length < 9)
  {
    $(this).removeClass('error');
  }
  });


