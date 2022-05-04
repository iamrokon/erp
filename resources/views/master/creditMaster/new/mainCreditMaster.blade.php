@section('menu', '売上請求先別与信管理マスタ')
    <!DOCTYPE html>
<html lang="ja" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title>売上請求先別与信管理マスタ</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" >
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar_styles.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/modal_styles.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/product_styles.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pagination_styles.css') }}" >
    <script type="text/javascript">



    </script>


    <style>
.largeTable{
max-height: 455px;
padding-bottom: 20px;

}
  @media only screen and (min-width: 1400px) {
.largeTable{
max-height: 688px;
padding-bottom: 20px;

}

.left_right_margin {
margin-bottom: : 0px;

}
}

        .modal-open {
            overflow: hidden;
        }
        .modal {
            overflow: auto !important;

        }
        .tbl_credit tr td{
            border: 1px solid #29487d!important;
            padding: 6px;line-height: 1.42857143;
            font-size: 0.8em;

        }
        @media only screen and (max-width: 767px)  {
            .modal {
                /*  overflow: auto !important;*/
                padding: 0!important;
            }
            .modal-open .modal {
                overflow-x: hidden;
                overflow-y: auto;
            }

            .rounded_table_wrap{
                width: 50%;
                padding-left: 15px!important;
            }
            .nav_mview{
                margin-bottom: 15px!important;
            }
            .pagi-input-field{
                height: 36px!important;
            }

        }
        .border_none_table td{
            border: 1px solid #29487d!important;
            padding: 4px;
        }
    </style>



</head>


<body style="">
@include('layout.nav_test')
<div class="container left_right_margin">

    <div class="row">
        <div class="col-lg-12">


            <div  class = "bgcolr_order_inq" style=" ">

                <div class="wrap-100"  style="background-color: #fff;padding: 10px;box-sizing: border-box; overflow: hidden;height: auto;">

                    @include('master.creditMaster.creditMainContent')

                </div>
            </div>



            <!-- product content col-12 ends here -->

        </div>
        <!-- product content row ends here -->
    </div>




    <!-- wrap-100 div end -->
</div>
<!-- bgcolor div end -->


@include('master.creditMaster.creditDetailViewModal')
@include('master.creditMaster.creditEditModal')
@include('master.common.table_settings_modal')
@include('master.creditMaster.printModal')


<!-- ============================moda1 2 start here ======================= -->
<!-- ============================moda1 2 end here ======================= -->

<!-- col-12 div end -->

<!-- row div end -->


<!-- container-fluid div end -->

@include('layout.footer')

<link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css">
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<!--Bootstrap 4.x-->
<script src="  {{ asset('js/bootstrap.min.js') }}"></script>

<!--Jquery Map for mac operating system-->
<script src=" {{ asset('js/select2.min.js') }}"></script>
<script src=" {{ asset('js/master/creditMaster.js') }}"></script>
<script src=" {{ asset('js/common.js') }}"></script>
<script type="text/javascript">
    $("#creditButton3").on("click", function(){
        $("#credit_modal1").modal("hide");
        $('body').removeClass('modal-open');
        $('body').css('overflow-y', 'hidden');
        $('.modal-backdrop').remove();
        $("#editCreditForm").find('input').removeClass("error");
        $("#error_dataEdit").html('');
    });

    $(document).ready(function(){
        $('#openSettingModal').attr('onclick', "showTableSetting('{{route('creditMasterTableSetting',$bango)}}')");
    });
</script>
</body>
</html>
