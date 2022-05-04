// Enter next tab focus start............
ko.bindingHandlers.nextFieldOnEnter = {
    init: function(element, valueAccessor, allBindingsAccessor) {
        $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function(e) {
            var self = $(this),
                form = $(element),
                focusable, next;
            if (e.keyCode == 13 && !e.shiftKey) {
                focusable = form.find('input:not([ignore]), select:not([ignore]), textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
                // focusable = form.find('input:not([ignore]), select, textarea, button:not([ignore]), a.btn').filter(':visible');
                var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                next = focusable.eq(nextIndex);
                next.find('.trfocus').addClass('rowSelect').focus();
                return false;
            }
            if (e.keyCode == 9) {
                e.preventDefault();
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
// Enter next tab focus end............


// Modal first focus....
$(document).on('shown.bs.modal', function(e) {
    $('[autofocus]', e.target).focus();
});

// select table col js start.......
$(document).ready(function() {
    $('th.signbtn').click(function() {
        $('th.signbtn-select').removeClass('highlight_select')
        $(this).addClass('highlight').siblings().removeClass('highlight');
        var th_index = $(this).index();
        $('#userTable tr').each(function() {
            $(this).find('td').eq(th_index).addClass('tdhighlight').siblings().removeClass('tdhighlight');
        });
    });
});
// select table col js end.......

//Enter + Shift key press cursor new line..
$("textarea").keydown(function(e) {
    if (e.keyCode == 13 && !e.shiftKey) {
        e.preventDefault();
    } else {}
});

// Check & uncheck All chackbox js start.....
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
// Check & uncheck All chackbox js end.....
$(function() {
    $(".message_content").hover(
        function() {
            var mssg = $(this).attr("message");
            $(".hover_message").html(mssg);
        },
        function() {
            //var mssg = $(this).attr("class");
            $(".hover_message").html("");
        });
});
//message on hover on input in modal
$(function() {
    $(".hover_message_content").hover(
        function() {
            var mssg = $(this).attr("message");
            $(".modal_hover_message").html(mssg);
        },
        function() {
            $(".modal_hover_message").html("");
        });
});
$(".modal").on("shown.bs.modal", function() {
    if ($(".modal-backdrop").length > 1) {
        $(".modal-backdrop").not(':first').remove();
    }
});

// datepicker function


$(function() {
    $("#datepicker1_com").datepicker({
        language: "ja-JP",
        format: "yyyy-mm-dd",
        autoHide: true,
        zIndex: 2048,
        offset: -24,
        trigger: "#cal_icon1_c",
    });
    // #SI - code starts here
    $("#datepicker1_comShow").on("change", function() {
        let datevalue = document.getElementById("datepicker1_comShow").value;
        //getting date value from calendar
        let current_datetime = new Date(datevalue);
        // console.log(datevalue);
        let yearValue = current_datetime.getFullYear();
        let monthValue = current_datetime.getMonth() + 1;
        let dayValue = current_datetime.getDate();
        if (dayValue < 10) {
            dayValue = "0" + dayValue;
        }
        if (monthValue < 10) {
            monthValue = "0" + monthValue;
        }
        let formatted_date = yearValue + "" + monthValue + "" + dayValue;
        // console.log(formatted_date);
        document.getElementById("datepicker1_com").value = formatted_date;
        $("#datepicker1_com").focus();
        //focusing current input on select
    });
    $("#datepicker1_com").on("change", function() {
        let inputDateValue = document.getElementById("datepicker1_com").value;
        //getting date value from input
        // console.log(inputDateValue);
        let slicedYear = inputDateValue.slice(0, 4);
        // console.log(slicedYear);
        let slicedMonth = inputDateValue.slice(4, 6) - 1;
        // console.log(slicedMonth);
        let slicedDay = inputDateValue.slice(6, 8);
        // console.log(slicedDay);
        $("#datepicker1_comShow").datepicker("setDate", new Date(slicedYear, slicedMonth, slicedDay));
    });
});


$(function() {
    $("#datepicker2_com").datepicker({
        language: "ja-JP",
        format: "yyyy-mm-dd",
        autoHide: true,
        zIndex: 2048,
        trigger: "#cal_icon2_c",
    });
    $("#datepicker2_com").on("change", function() {
        $(this).focus();
    });
});


$(document).on("click", "#cal_icon2_c", function() {
    $("#datepicker2_com").datepicker("show");
});


$(function() {
    $("#datepicker3_com").datepicker({
        language: "ja-JP",
        format: "yyyy-mm-dd",
        autoHide: true,
        zIndex: 2048,
        trigger: "#cal_icon3_c",
    });
    $("#datepicker3_com").on("change", function() {
        $(this).focus();
    });
});


$(document).on("click", "#cal_icon3_c", function() {
    $("#datepicker3_com").datepicker("show");
});


$(function() {
    $("#datepicker4_com").datepicker({
        language: "ja-JP",
        format: "yyyy-mm-dd",
        autoHide: true,
        zIndex: 2048,
        trigger: "#cal_icon4_c",
    });
    $("#datepicker4_com").on("change", function() {
        $(this).focus();
    });
});


$(document).on("click", "#cal_icon4_c", function() {
    $("#datepicker4_com").datepicker("show");
});


$(function() {
    $("#datepicker5_com").datepicker({
        language: "ja-JP",
        format: "yyyy-mm-dd",
        autoHide: true,
        zIndex: 2048,
        trigger: "#cal_icon5_c",
    });
    $("#datepicker5_com").on("change", function() {
        $(this).focus();
    });
});


$(document).on("click", "#cal_icon5_c", function() {
    $("#datepicker5_com").datepicker("show");
});


$(function() {
    $("#datepicker6_com").datepicker({
        language: "ja-JP",
        format: "yyyy-mm-dd",
        autoHide: true,
        zIndex: 2048,
        trigger: "#cal_icon6_c",
    });
    $("#datepicker6_com").on("change", function() {
        let datevalue = document.getElementById("datepicker6_com").value;
        //getting date value from calendar
        let current_datetime = new Date(datevalue);
        // console.log(datevalue);
        let yearValue = current_datetime.getFullYear();
        let monthValue = current_datetime.getMonth() + 1;
        let dayValue = current_datetime.getDate();
        if (dayValue < 10) {
            dayValue = "0" + dayValue;
        }
        if (monthValue < 10) {
            monthValue = "0" + monthValue;
        }
        let formatted_date = yearValue + "" + monthValue + "" + dayValue;
        // console.log(formatted_date);
        document.getElementById("datepicker6_com").value = formatted_date;
        $(this).focus();
        //focusing current input on select
    });
});


$(document).on("click", "#cal_icon6_c", function() {
    $("#datepicker6_com").datepicker("show");
});


$(function() {
    $("#datepicker7_com").datepicker({
        language: "ja-JP",
        format: "yyyy-mm-dd",
        autoHide: true,
        zIndex: 2048,
        trigger: "#cal_icon7_c",
    });
    $("#datepicker7_com").on("change", function() {
        $(this).focus();
    });
});


$(document).on("click", "#cal_icon7_c", function() {
    $("#datepicker7_com").datepicker("show");
});


$(function() {
    $("#datepicker8_com").datepicker({
        language: "ja-JP",
        format: "yyyy-mm-dd",
        autoHide: true,
        zIndex: 2048,
        trigger: "#cal_icon8_c",
    });
    $("#datepicker8_com").on("change", function() {
        $(this).focus();
    });
});


$(document).on("click", "#cal_icon8_c", function() {
    $("#datepicker8_com").datepicker("show");
});


$(function() {
    $("#datepicker9_com").datepicker({
        language: "ja-JP",
        format: "yyyy-mm-dd",
        autoHide: true,
        zIndex: 2048,
        trigger: "#cal_icon9_c",
    });
    $("#datepicker9_com").on("change", function() {
        $(this).focus();
    });
});


$(document).on("click", "#cal_icon9_c", function() {
    $("#datepicker9_com").datepicker("show");
});


$(function() {
    $("#datepicker10_com").datepicker({
        language: "ja-JP",
        format: "yyyy-mm-dd",
        autoHide: true,
        zIndex: 2048,
        trigger: "#cal_icon10_c",
    });
    $("#datepicker10_com").on("change", function() {
        $(this).focus();
    });
});


$(document).on("click", "#cal_icon10_c", function() {
    $("#datepicker10_com").datepicker("show");
});








$('#datepicker1_pr').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 2048,
    trigger: '#cal_icon1_p',
});
$('#datepicker1_pr').on('change', function() {
    let datevalue = document.getElementById("datepicker1_pr").value;
    //getting date value from calendar
    let current_datetime = new Date(datevalue);
    // console.log(datevalue);
    let yearValue = current_datetime.getFullYear();
    let monthValue = (current_datetime.getMonth() + 1);
    let dayValue = current_datetime.getDate();
    if (dayValue < 10) {
        dayValue = "0" + dayValue;
    }
    if (monthValue < 10) {
        monthValue = "0" + monthValue;
    }
    let formatted_date = yearValue + "" + monthValue + "" + dayValue;
    document.getElementById("datepicker1_pr").value = formatted_date;
    $(this).focus();
    //focusing current input on select
});

$('#datepicker2_pr').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 2048,
    trigger: '#cal_icon2_p',
});
$('#datepicker2_pr').on('change', function() {
    let datevalue = document.getElementById("datepicker2_pr").value;
    //getting date value from calendar
    let current_datetime = new Date(datevalue);
    // console.log(datevalue);
    let yearValue = current_datetime.getFullYear();
    let monthValue = (current_datetime.getMonth() + 1);
    let dayValue = current_datetime.getDate();
    if (dayValue < 10) {
        dayValue = "0" + dayValue;
    }
    if (monthValue < 10) {
        monthValue = "0" + monthValue;
    }
    let formatted_date = yearValue + "" + monthValue + "" + dayValue;
    // console.log(formatted_date);
    document.getElementById("datepicker2_pr").value = formatted_date;
    $(this).focus();
    //focusing current input on select
});


$('#datepicker3_pr').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 2048,
    trigger: '#cal_icon3_p',
});
$('#datepicker3_pr').on('change', function() {
    let datevalue = document.getElementById("datepicker3_pr").value;
    //getting date value from calendar
    let current_datetime = new Date(datevalue);
    // console.log(datevalue);
    let yearValue = current_datetime.getFullYear();
    let monthValue = (current_datetime.getMonth() + 1);
    let dayValue = current_datetime.getDate();
    if (dayValue < 10) {
        dayValue = "0" + dayValue;
    }
    if (monthValue < 10) {
        monthValue = "0" + monthValue;
    }
    let formatted_date = yearValue + "" + monthValue + "" + dayValue;
    // console.log(formatted_date);
    document.getElementById("datepicker3_pr").value = formatted_date;
    $(this).focus();
    //focusing current input on select
});


$('#datepicker4_pr').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 2048,
    trigger: '#cal_icon4_p',
});
$('#datepicker4_pr').on('change', function() {
    let datevalue = document.getElementById("datepicker4_pr").value;
    //getting date value from calendar
    let current_datetime = new Date(datevalue);
    // console.log(datevalue);
    let yearValue = current_datetime.getFullYear();
    let monthValue = (current_datetime.getMonth() + 1);
    let dayValue = current_datetime.getDate();
    if (dayValue < 10) {
        dayValue = "0" + dayValue;
    }
    if (monthValue < 10) {
        monthValue = "0" + monthValue;
    }
    let formatted_date = yearValue + "" + monthValue + "" + dayValue;
    // console.log(formatted_date);
    document.getElementById("datepicker4_pr").value = formatted_date;
    $(this).focus();
    //focusing current input on select
});