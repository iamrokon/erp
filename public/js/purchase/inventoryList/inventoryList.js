$("#displayButton").click(function() {
    $('#error_msg_div').empty();
    // alert("searching");
    $("#Button").val("refresh");
    $("#sortField").val("");
    $("#sortType").val("");
    // alert(button);
    $('#mainForm').submit();
});