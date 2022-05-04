<head>
<style>
  table tr:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    outline: 0;
  }

  .bg-blue {
    background: #363A81 !important;
  }

  .table-nohover .page-link:hover {
    background: white !important;
  }

  .custom-table-oh {
    position: relative;
  }

  .custom-table-oh:after {
    content: '';
    position: absolute;
    background: #D0D0D0;
    width: 1px;
    height: 20px;
    right: -15px;
    top: 3px;
  }

  .custom-arrow {
    position: relative;
  }

  /* .content-head-top{
      border-bottom: 1px solid #E1E1E1;
    } */
  .custom-table-1 {
    position: relative;
  }

  .custom-table-1:after {
    content: '';
    position: absolute;
    background: #D0D0D0;
    width: 1px;
    height: 90px;
    right: -15px;
    top: 3px;
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
    /* background: #D0D0D0; */
    width: 1px;
    content: '';
  }

  .custom-data-modal .bg-white {
    background: #fff !important;
  }

.content-bottom-bottom .input-group-append button.input-group-text  {
  border: 1px solid #2c66b1!important;
    background: #2c66b1!important;

}
.content-bottom-bottom .input-group-append button:hover {
    background: #388af4!important;
    border: 1px solid #388af4 !important;
    cursor: pointer!important;
}
  @media only screen and (max-width: 767px) {
    .radio-rounded .custom-control {
      margin-left: 10px !important;
      margin-right: 14px !important;
    }

    .radio-rounded {
      margin-left: 17px !important;
    }

    .pagi {
      margin-top: 12px;
    }

    .right-pagi {
      padding-top: 9px;
    }
  }

  .line-title:after {
    background: transparent !important;
  }

  textarea:focus {
    color: #495057;
    background-color: #fff;
    border-color: #80bdff;
    outline: 0;
    -webkit-box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
  }

  /*Input file design start*/
  .custom-select-file-upload .custom-file-input:lang(ja)~.custom-file-label::after {
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
  /*Input file design end*/

 /*custom window  changes*/

 .content-bottom-section {
    margin-top: 110px;
  }

  .inner-top-content {
    margin-top: 0px !important ;
    position: relative;
    top: 110px !important;
  }

  .success-msg-box {
    top: 60px;
  }

  .common_error {
    top: 60px;
    color: red;
    font-size: 12px !important;
    margin-bottom: 10px;
    position: relative;
    width: 100%;
    margin-bottom: 10px !important;
    z-index: 2;
  }
  
  .common_error > div > p {
    margin-bottom: 10px !important;
    padding-left: 0px !important;
  }


  @media (max-width: 1800px) {
    .content-bottom-section {
      margin-top: 90px;
    }

    .common-nav .inner-top-content {
      margin-top: 0px !important ;
      top: 87px !important;
    }

    .success-msg-box,
    .common_error {
      top: 35px;
    }
  }

  .content-bottom-section,
  .fullpage_width1,
  .footer-wrapper {
    min-width: 1349px !important;
  }

  #exampleModal3 .modal-dialog{
    max-width: 1350px;
    height: 855px;
    width: 1350px;
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

  
</style>
</head>