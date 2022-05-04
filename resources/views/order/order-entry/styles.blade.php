<style>
  body {
    pointer-events: none;
  }

  .custom-modal.show,
  .custom-data-modal.show {
    padding-right: 0px !important;
  }

  .modal-table-white thead tr th:after,
  .modal-table-white1 thead tr th:after,
  .modal-table-blue thead tr th:after {
    content: '';
    position: absolute;
    background: #929da9;
    width: 1px;
    height: 24px;
    right: 0px;
    top: 9px;
  }

  .uskc-button {
    width: 150px !important;
    height: 30px;
    line-height: 30px;
  }

  .modaloverlay.bodyOverlay {
    position: relative;
  }

  .modaloverlay.bodyOverlay:before {
    position: absolute;
    width: 100%;
    height: 100%;
    background: black;
    content: '';
    z-index: 1000;
    opacity: 0.5;
    left: 0;
    right: 0;
    height: 100%;
  }

  .bg-teal3 {
    background: #0070C0;
  }


  /* #SI - Error Styles */
  .custom-form .error {
    border: 1px solid red !important;
    border-radius: 4px !important;
  }

  .content-head-top {
    border-bottom: 1px solid #E1E1E1;
  }

  .custom-table-1 {
    position: relative;
  }

  .custom-table-1:after {
    content: '';
    position: absolute;
    background: #D0D0D0;
    width: 1px;
    height: 100px;
    right: -15px;
    top: 2px;
  }

  .custom-form .input-group-sm .form-control {
    background: #EFEFEF;
    padding: 0px !important;
  }

  .tag-line {
    margin-bottom: 13px;
    font-size: 12px;
  }

  .form-button {
    background: #fff;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
  }

  .form-button .btn {
    width: 163px;
  }

  .form-button .btn-success {
    background: #009943;
  }

  .form-button .btn-primary {
    background: #2C66B0;
  }

  select:focus option {
    outline: none;
    -moz-appearance: none;
    -webkit-appearance: none;
  }

  .form-control:focus option {
    outline: none;
    -moz-appearance: none;
    -webkit-appearance: none;
  }

  /*select option:focus{
       outline: 0;
      -moz-appearance: none;
      -webkit-appearance: none;
    }*/
  .w-145 {
    width: 145px;
  }

  .border-line-area {
    position: relative;
  }

  .border-line-area:before {
    position: absolute;
    right: 9px;
    height: 26px;
    background: #D0D0D0;
    width: 1px;
    content: '';
  }

  .margin_t {
    margin-top: 7px !important;
  }

  .m_t {
    margin-top: 13px !important;
    font-size: 15px !important;
  }

  /* .outer {
      border-bottom: 1px solid #e1e1e1;
      padding: 15px 0px 14px;
    } */

  .modal-data-box .table td,
  .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 0;
    border-bottom: 1px solid #141855 !important;
    color: #fff;
  }

  .modal-data-box .modal-inner.table td,
  .modal-data-box .modal-inner.table th {
    position: relative;
  }

  .modal-data-box .modal-inner.table td:after,
  .modal-data-box .modal-inner.table th:after {
    content: '';
    position: absolute;
    background: #D7D7D7;
    width: 1px;
    height: 15px;
    right: 0px;
    top: 18px;
  }

  .modal-data-box .modal-inner.table td,
  .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 0;
    border-bottom: 1px solid #dee2e6;
  }

  .modal-data-box .form-control {
    height: 28px;
    padding: 0px;
    vertical-align: middle;
    line-height: 22px;
    margin: 0px;
  }

  .modal-data-box .line-icon-box {
    background: #bbbbbb;
  }

  .square-title .line-icon-box {
    background: #bbbbbb;
  }

  /*.line-icon-box {
        height: 14px;
        width: 14px;
        background: #363A81;
        border-radius: 3px;
        float: left;
        margin-right: 10px;
        margin-top: 2px;
    }*/

  .modal-data-box .form-control {
    border-radius: 3px !important;
  }

  .modal-data-box .modal-inner.table td:after,
  .modal-data-box .modal-inner.table th:after {
    content: '';
    position: absolute;
    background: #D7D7D7;
    width: 1px;
    height: 15px;
    right: 0px;
    top: 7px;
  }

  .bg-blue {
    background: #353A81 !important;
  }

  .order_entry_topcontent .input-group-append,
  .data-wrapper-content .input-group-append {
    cursor: pointer;
  }


  .custom-arrow select::-ms-expand {
    display: none;
  }

  .custom-arrow select {
    -webkit-appearance: none;
  }

  .td-border-line:after {
    content: '';
    position: absolute;
    background: #D0D0D0;
    width: 1px;
    height: 26px;
    left: 15px;
    top: 3px;
  }

  .orderentry-databox .data-box {
    background: #fff;
    font-size: 0.8em;
  }

  .vertical-line {
    position: relative;
  }

  .vertical-line:after {
    position: absolute;
    left: 0;
    top: 12px;
    width: 1px;
    height: 15px;
    content: '';
    background: #ddd;
  }

  .line-title:after {
    background: transparent !important;
  }

  .line-title2 {
    position: relative;
  }

  .line-title2:after {
    position: absolute;
    content: '';
    height: 20px;
    background: white;
    width: 1px;
    right: 0;
    z-index: 999;
  }

  .dataModal6 {
    display: none;
  }

  .tabledataModal6 {
    display: none;
  }

  .tabledataModal6.intro {
    display: block;
  }

  .dataModal6.intro {
    display: block;
  }

  .close:hover,
  .close:focus {
    outline: 0;
  }

  /* Scrollbar Custom Height & Width */
  /* .scrollbararea::-webkit-scrollbar {
    width: 5px;
    height: 5px;
  }

  .scrollbararea::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 60px rgba(203, 203, 203, 1);
    -webkit-border-radius: 0px;
    border-radius: 0px;
  }

  .scrollbararea::-webkit-scrollbar-thumb {
    -webkit-border-radius: 0px;
    border-radius: 0px;
    background: rgba(44, 102, 176, 1);
    -webkit-box-shadow: inset 0 0 0px rgba(0, 0, 0, 0.5);
  } */

  .custom-data-modal .bg-white {
    background: #fff !important;
  }

  .table-nohover .page-link:hover {
    background: white !important;
  }

  .table_hover2_pagi td {
    color: #fff !important;
  }

  /* .custom-input-field .form-control-sm,
  .input-group-sm>.form-control,
  .input-group-sm>.input-group-prepend>.input-group-text,
  .input-group-sm>.input-group-append>.input-group-text,
  .input-group-sm>.input-group-prepend>.btn,
  .input-group-sm>.input-group-append>.btn {
    padding: 0px 17px;
  } */

  .modal-div-row .separate {
    position: relative;
  }

  .modal-div-row .separate:before {
    content: '';
    position: absolute;
    background: #D7D7D7;
    width: 1px;
    height: 15px;
    left: 0;
    top: 1px;
  }

  .custom-modal .modal-body h4.b-color:before {
    background: #408dee;
  }

  .content-bottom-section .data-box-content {
    height: 59px !important;
  }

  .content-bottom-bottom .data-box-content {
    height: 76px !important;
  }

  .delete-area {
    position: relative;
  }

  .invoke-delete:before {
    background: #868484;
    content: "";
    height: 100%;
    left: 0;
    opacity: .9;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 9;
  }

  .border-red {
    border: 1px solid red !important;
  }

  table tr:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    outline: 0;
  }

  /* CSS Loader starts */
  .preloader {
    position: absolute;
    left: 0;
    right: 0;
    text-align: center;
    margin: 0 auto;
    z-index: 9999;
  }

  .loading {
    position: fixed;
    z-index: 999;
    height: 2em;
    width: 2em;
    overflow: show;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-color: #fff;
  }

  .loading:before {
    content: '';
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #000;
    opacity: .5;

  }

  .disable {
    pointer-events: none;
    cursor: default;
  }

  .loading:not(:required) {

    font: 0/0 a;
    color: transparent;
    text-shadow: none;
    background-color: transparent;
    border: 0;
  }

  .loading:not(:required):after {
    content: '';
    display: block;
    font-size: 10px;
    width: 5.0em;
    height: 5.0em;
    margin-top: -0.5em;
    -webkit-animation: spinner 1500ms infinite linear;
    -moz-animation: spinner 1500ms infinite linear;
    -ms-animation: spinner 1500ms infinite linear;
    -o-animation: spinner 1500ms infinite linear;
    animation: spinner 1500ms infinite linear;
    border-left: 4px solid rgba(237, 237, 237, 0.7);
    border-right: 4px solid rgba(237, 237, 237, 0.7);
    border-bottom: 4px solid rgba(237, 237, 237, 0.7);
    border-top: 4px solid #408eee;
    border-radius: 100%;
  }


  @-webkit-keyframes spinner {
    0% {
      -webkit-transform: rotate(0deg);
      -moz-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
      -moz-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }

  @-moz-keyframes spinner {
    0% {
      -webkit-transform: rotate(0deg);
      -moz-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
      -moz-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }

  @-o-keyframes spinner {
    0% {
      -webkit-transform: rotate(0deg);
      -moz-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
      -moz-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }

  @keyframes spinner {
    0% {
      -webkit-transform: rotate(0deg);
      -moz-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
      -moz-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }

  .loading.show {
    display: block !important;
  }

  .content-head-section {
    margin-bottom: 14px;
  }

  /* CSS Loader ends */



  /*Common style start*/

  /* Small Windows Break Issue Solving */
  .fullpage_width1 {
    min-width: 1349px !important;
  }

  /* Wrong Width Showing Issue fixing */
  .input-group-append {
    margin-left: 0px !important;
  }

  /*custom window  changes*/
  .inner-top-content {
    position: relative;
    top: 25px;
  }

  .success-msg-box,
  #error_data {
    top: 60px !important;
  }

  #error_data > div > p {
    margin-bottom: 10px !important;
    padding-left: 0px !important;
  }

  @media (max-width: 1800px) {
    .common-nav .inner-top-content {
      top: 12px;
    }
    .success-msg-box,
    #error_data {
      top: 35px !important;
    }
  }
</style>