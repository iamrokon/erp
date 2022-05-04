<style>
  .c_hover {
    background: #2B66B1 !important;
    border: 1px solid #2B66B1 !important;
    cursor: pointer !important;
  }

  .custom-form .errorForSelect {
    border: 1px solid red !important;
    border-radius: 4px !important;
  }

  .custom-file-label {
    z-index: 0;
    cursor: pointer;
  }

  .custom-file button.btn {
    width: 100%;
    height: 80%;
  }

  .box-wrap {
    height: 30px;
  }

  .border_none_table td {
    border: 1px solid #29487d !important;
    padding: 4px;
  }

  a.b11 {
    padding: 7px !important;
    margin-left: -34px !important;
  }

  a.b22 {
    padding: 7px !important;
    margin-left: -3px !important;
  }

  a.b33 {
    padding: 7px !important;
    margin-left: -10px !important;
  }

  /* .pagi {
    margin-top: 19px;
  } */

  .page-link {
    border: 1px solid #29487d !important
  }

  .input-file-container1 {
    width: 153px !important;
    height: 27px !important;
    cursor: pointer;
  }

  .btn_space {
    margin-left: -11px;
  }

  .order_inquery_table {
    border: 1px solid black;
  }

  .margin_b {
    margin-bottom: 5px;
  }

  .ml_l {
    margin-left: 4px !important;
  }

  .margine_r {
    margin-left: -10px !important;
  }

  /* .pagination {
    display: inline-block;
  } */

  .raw_color {
    background-color: #c2d6d6;
  }


  /*=============royal pagination css===============*/

  .table_hover2 td {
    position: relative;
    padding-left: 6px !important;
    padding-right: 6px !important;
    font-size: 4mm !important;
    color: #405063 !important;
  }

  @media screen and (min-width:992px) and (max-width: 1024px) {
    .overflow-wrapper-100 {
      display: block !important;
      width: 100%;
      overflow-x: auto;
      position: relative;
    }

    .overflow-inner {
      display: block !important;
      width: 1500px;
      /* float:left;*/
    }
  }

  @media screen and (max-width: 1350px) {
    .overflow-wrapper-100 {
      display: block !important;
      width: 100%;
      overflow-x: auto;
      position: relative;
    }

    .overflow-inner {
      display: block !important;
      width: 1500px;
      /* float:left;*/
    }
  }


  /*=============media query===============*/

  @media only screen and (max-width: 767px) {
    .bordera {
      padding: 7px !important;
    }

    .padd-bottm {
      padding-bottom: 9px !important;
    }

    .overflow-wrapper-100 {
      display: block !important;
      width: 100%;
      overflow-x: auto;
      position: relative;
    }

    .overflow-inner {
      display: block !important;
      width: 1300px;
      /* float:left;*/
    }

    .table-radiobtn-controll .custom-control-label {
      margin-left: 5px !important;
    }
  }

  a.pagi-input-field {
    width: 38px;
    height: 37px;
  }

  .vertical-line {
    position: relative;
  }

  .vertical-line:after {
    position: absolute;
    left: -16px;
    top: -5px;
    width: 1px;
    height: 90px;
    content: '';
    background: #ddd;
  }

  .loading-icon {
    display: block;
    width: 40px;
    position: absolute;
    right: -40px;
    z-index: 9;
    top: 2px;
  }

  .data-box-content {
    height: 107px !important;
  }

  .orderentry-databox .data-box {
    background: #fff;
    min-height: 32px;
  }

  .gray-box .orderentry-databox .data-box {
    background: #EFEFEF;
  }

  .custom-file-label:hover:after {
    background: #398BF7;
  }

  .custom-select-file-upload .custom-file-input:lang(en)~.custom-file-label::after {
    content: "";
    background: transparent;
  }

  .custom-select-file-upload .custom-file-label::after {
    border-left: 0px;
  }

  .custom-select-file-upload .custom-file-label {
    color: #fff;
    position: relative;
    margin-bottom: 0px;
    height: 30px;
    border: 1px solid #2C66B0;
    background: #2C66B0;
  }

  .custom-select-file-upload .custom-file-label:hover {
    background: #398BF7;
    border: 1px solid #398BF7;
    cursor: pointer !important;
  }

  .c_hover:hover {
    background: #398BF7 !important;
    border: 1px solid #398BF7 !important;
    cursor: pointer !important;
  }

  .switch {
    position: relative;
    display: inline-block;
    width: 56px;
    height: 29px;
  }

  .switch-area label {
    margin-bottom: 0px !important;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #7F7F7F;
    border-radius: 4px;
    -webkit-transition: .4s;
    transition: .4s;
    border: 1px solid #0070C0;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 27px;
    width: 27px;
    left: 1px;
    bottom: 0px;
    right: 1px;
    background-color: #FFC000;
    border-radius: 4px;
    -webkit-transition: .4s;
    transition: .4s;
    /*border-left: 1px solid #0070C0;
        border-top: 1px solid #0070C0;
        border-bottom: 1px solid #0070C0;*/
  }

  .slider span.on {
    float: left;
    line-height: 30px;
    margin-left: 5px;
    color: #fff;
    display: none;
  }

  input:checked+.slider span.on {
    display: block;
  }

  .slider span.off {
    float: right;
    line-height: 30px;
    margin-right: 5px;
    color: #fff;
  }

  input:checked+.slider span.off {
    display: none;
  }

  input:checked+.slider {
    background-color: #0070C0;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    background: white;
  }

  .common-navbar .content-head-section {
    padding: 0px;
    min-height: 0px !important;
  }

  /* CSS Loader */
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

  .container {
    max-width: 1140px !important;
  }

  .content-bottom-bottom .input-group-append button.btn {
    background-color: #2c66b1 !important;
  }

  .content-bottom-bottom .input-group-append button.btn:hover {
    background-color: #134586 !important;
  }

  /*custom window  changes*/
  .inner-top-content {
    margin-top: 111px !important;
  }

  .success-msg-box {
    top: 59px !important;
  }

  .common_error {
    position: relative;
    top: 59px !important;
    width: 100%;
    font-size: 12px !important;
    color: red;
    margin-bottom: 10px;
  }

  .common_error > p {
    margin-bottom: 10px !important;
  }

  @media (max-width: 1800px) {
    .common-nav .inner-top-content {
      margin-top: 88px !important;
    }

    .success-msg-box,
    .common_error {
      top: 34px !important;
    }
  }
</style>