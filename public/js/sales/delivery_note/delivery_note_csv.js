
function fileDownload(res, filename) {
    fetch(res)
        .then(resp => resp.blob())
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            // the filename you want
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        });
}
function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
}

function createMsg(err_msg, type) {
    var typeMessage = type ? 'blue' : 'red';
    var html = '<div>';
    if (typeof (err_msg) != 'string') {
        var errmsg = err_msg.filter(onlyUnique)
        for (var count = 0; count < errmsg.length; count++) {
            html += '<p style="color:' + typeMessage + ';font-size: 12px;margin-bottom: 8px;">' + errmsg[count] + '</p>';
        }
    } else {
        html += '<p style="color:' + typeMessage + ';font-size: 12px;margin-bottom: 8px;">' + err_msg + '</p>';
    }

    html += '</div>';
    return html;
}

function createSuccessMessage(message) {
    if ($(document).find("#successMsg")) {
        $(document).find("#successMsg").remove();
    }
    var success_html = `
    <div class="row success-msg-box" id="successMsg" style="position: relative; width: 100%; max-width: 1452px; z-index: 1; display: block;">
        <div class="col-12 pl-0 pr-0 ml-3">
            <div class="alert alert-primary alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" autofocus>&times;</button>
                    <strong id="success_data">${message}</strong>
            </div>
        </div>
    </div>
    `;
    $("#error_data").before(success_html)
}

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '.create_csv', function (e) {
        e.preventDefault()
        $(this).prop('disabled', true)
        var bango = $("input[id=userId]").val()
        var page = $(document).find("#delivery_note")
        var input_field = page.find('input')
        var select_field = page.find('select')
        input_field.hasClass('error') ? input_field.removeClass('error') : '';
        select_field.hasClass('error') ? select_field.removeClass('error') : '';
        var error_data = page.find('#error_data');
        error_data.empty();
        $(".loading").addClass('show');
        $.ajax({
            url: '/delivery-note/create-csv/' + bango,
            type: 'POST',
            data: $("#delivery_note_data").serialize(),
            success: function (res) {
                if (res.status == 'ok') {
                    var csv_has = res.csv_has;
                    var message = res.message;
                    var return_status = ''
                    if (csv_has) {
                        createSuccessMessage(message)
                        $(".download_csv").prop("disabled", false)
                        $(".delete_csv").prop("disabled", false)
                    } else {
                        return_status = createMsg(message)
                        error_data.html(return_status);
                        error_data.show()
                    }

                    $("#confirmation_message").empty();
                } else if (res.status == 'error') {
                    var input_error = Object.keys(res.errors);
                    var err_msg = Object.values(res.errors).flat(1);
                    if (err_msg) {
                        var html = createMsg(err_msg)
                        error_data.html(html);
                        error_data.show()
                        input_error.forEach(function (inputName) {
                            var names = ['division_datachar05_start', 'department_datachar05_start', 'order_date_start', 'order_date_end', 'sales_slip_number_start', 'sales_slip_number_end'];
                            if (names.indexOf(inputName) !== -1) {
                                var input_type = $('.' + inputName).prop('localName')
                                $(document).find(input_type + "[name=" + inputName + "]").addClass("error")
                            }
                        })
                    }
                    $("#confirmation_message").empty();
                } else if (res.status == 'confirm') {
                    var confirmMessage = "作成はまだ完了していません。内容を確認後、もう一度 「作 成」 をお願いします"
                    $("#confirmation_message").html(createMsg(confirmMessage));
                    $("#confirm_status").val(1)
                }
                $('.create_csv').prop('disabled', false)
                $(".loading-icon").hide();
                $(".loading").removeClass('show');
            },
            error: function (res) {
                console.log({ res })
                $(".loading").removeClass('show')
                $('.create_csv').prop('disabled', false)
                $(".loading-icon").hide();
            },
            beforeSend: function () {
                $(".loading").addClass('show');
            }
        })
    })
    $(document).on("click", ".download_csv", function (e) {
        e.preventDefault()
        $(this).prop('disabled', true)
        var bango = $("input[id=userId]").val()
        var page = $("#delivery_note")
        var error_data, html
        $.ajax({
            url: '/delivery-note/download-csv/' + bango,
            type: 'POST',
            data: bango,
            success: function (res) {
                if (res.status == 'ok') {
                    error_data = page.find('#error_data');
                    error_data.empty();
                    // html = createMsg(res.msg, true)
                    createSuccessMessage(res.msg)
                    var file_name = res.file_name;
                    var url = location.origin + '/uploads/delivery_notes/' + file_name;
                    console.log({ 'url': url, 'file': file_name })
                    fileDownload(url, file_name)
                    // error_data.html(html);
                    // error_data.show()
                } else if (res.status == 'ng') {
                    error_data = page.find('#error_data');
                    error_data.empty();
                    html = createMsg(res.msg)
                    error_data.html(html);
                    error_data.show()
                }
                $(".download_csv").prop("disabled", false)
                $(".loading").removeClass('show')
            },
            error: function () {
                $(".download_csv").prop("disabled", false)
                $(".loading").removeClass('show')
            },
            beforeSend: function () {
                $(".loading").addClass('show');
            }
        });

    })
    $(document).on("click", ".delete_csv", function (e) {
        e.preventDefault()
        $(this).prop('disabled', true)
        var bango = $("input[id=userId]").val()
        var page = $("#delivery_note")
        var error_data, html;
        $.ajax({
            url: '/delivery-note/delete-csv/' + bango,
            type: 'POST',
            data: bango,
            success: function (res) {
                if (res.status == 'ok') {
                    error_data = page.find('#error_data');
                    error_data.empty();
                    // html = createMsg(res.msg, true)
                    // error_data.html(html);
                    // error_data.show()
                    createSuccessMessage(res.msg)
                } else if (res.status == 'ng') {
                    error_data = page.find('#error_data');
                    error_data.empty();
                    html = createMsg(res.msg)
                    error_data.html(html);
                    error_data.show()
                }
                $(".delete_csv").prop("disabled", false)
                $(".loading").removeClass('show')
            },
            error: function () {
                $(".loading").removeClass('show');
                $(".delete_csv").prop("disabled", false)
            },
            beforeSend: function () {
                $(".loading").addClass('show');
            }
        });

    })
})
