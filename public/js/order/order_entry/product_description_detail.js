$(document).ready(function () {
    $(document).on("click", ".viewProductDes", function (e) {
        e.preventDefault();
        var className = $(this).parents(".custom-form").find(".productSubOrCdTarget").prop("class");
        var productCd = $(this).parents('.line-form').find(".productCd").val();
        var productSubCd = $(this).parents('.line-form').find(".productSubCd").val();

        if (className.includes("productCd ")) {
            var kokyakusouhinBango = productCd
        } else if (className.includes("productSubCd")) {
            var kokyakusouhinBango = productSubCd.split(' ')[0]
        }

        var bango = $("input[id='userId']").val();
        if (kokyakusouhinBango) {
            $.ajax({
                type: 'GET',
                url: '/product-description/detail/' + bango,
                data: {id: kokyakusouhinBango},
                success: function (result) {
                    var gazou = result.gazou;
                    if (gazou == undefined || gazou.length < 1) {
                        $('#messageModal').find(".modal-message").text('')
                        var errorMsg = "対象のデータがありませんでした。";
                        $('#messageModal').find(".modal-message").text(errorMsg)
                        $('#messageModal').show()
                    } else {
                        var view_modal = $("#product_description_detail_page");
                        view_modal.find("#url").text(gazou.url);
                        view_modal.find('#urlsm').text(gazou.urlsm + ' ' + gazou.shohin1_name);
                        view_modal.find('#mbcatch').text(gazou.mbcatch);
                        view_modal.find('#setumei').html(gazou.setumei);
                        view_modal.find('#catch').html(gazou.catch);
                        view_modal.find('#caption').html(gazou.caption);
                        view_modal.find('#catchsm').html(gazou.catchsm);
                        view_modal.find('#mbcatchsm').html(gazou.mbcatchsm);
                        if (gazou.mbcaption) {
                            var pdfPath = "/uploads/product_des_master/" + gazou.mbcaption;
                            var anchorElement = "<a target='_blank' href=" + pdfPath + ">" + gazou.mbcaption + "</a>"
                            view_modal.find('#mbcaption').html(anchorElement);
                        } else {
                            view_modal.find('#mbcaption').text("");
                        }
                        view_modal.find('#supplementary_explanation').text(gazou.supplementary_explanation);
                        view_modal.find('#datatxt0096').text(gazou.datatxt0096);
                        // $('#productDesBango').val(gazou.urlsm);
                        // $('#detailsModal').modal('show');
                        var writeableHtml = document.getElementById("product_description_detail_page");
                        var newWin = window.open("", "_blank");
                        var favIco = $("input[id='image_url']").val()
                        var html = "<html lang='jp'>" +
                            "<head>" +
                            "<title>商品説明マスタ(詳細)</title>" +
                            "<link rel='icon' href='" +favIco +"' type='image/png' id='faviconInage'/>" +
                            "</head>" +
                            "<body>" +
                            writeableHtml.innerHTML
                            + "</body>" +
                            "</html>"
                        newWin.document.write(html);
                        newWin.stop()
                    }

                }
            });
        } else {
            $('#messageModal').find(".modal-message").text('')
            var errorMsg = "対象のデータがありませんでした。";
            $('#messageModal').find(".modal-message").text(errorMsg)
            $('#messageModal').show()
        }


    })
})
