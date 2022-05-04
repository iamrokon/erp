<style>
  table tr:focus {
    box-shadow: 0 0 0 0.2rem rgb(0 123 255 / 25%);
    outline: 0;
  }

  .custom-modal .modal-body h4.b-color:before {
    background: #408dee;
  }

  .uskc-button {
    width: 150px;
    height: 30px;
    line-height: 30px;
  }

  .custom-arrow {
    position: relative;
  }

  .bg-blue {
    background: #353A81 !important;
  }

  .modal-data-box .table td,
  .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 0;
    /* border-bottom: 1px solid #141855 !important; */
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

  }

  .custom-data-modal .modal-title {
    font-weight: 600;
    letter-spacing: 1px;
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
    height: 90px;
    right: -15px;
    top: 3px;
  }

  .custom-form .input-group-sm .form-control {
    background: #EFEFEF;
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

  .loading-icon {
    display: inline-block;
    width: 40px;
   
}

  .line-title:after {
    background: transparent !important;
  }

  .content-head-section {
    padding: 0px 0;
    min-height: 0;
  }

  .content-head-section1 {
    padding: 0 0 13px;
  }

  @media only screen and (min-width:768px) and (max-width:992px) {

    #tbl_border_none {
      width: 100%;
      margin-bottom: 10px;
      float: right;
    }
  }

  #tbl_border_none {
    float: right;
  }

  @media only screen and (max-width:767px) {
    #tbl_border_none {
      margin-left: 0px;
      float: none !important;
    }

    .radio-rounded {
      margin-left: 17px !important;
    }

    .content-head-section {
      padding: 0;
      min-height: 0;
    }

    .tag-line {
      font-size: 0 !important;
    }

    .btn-m-view {
      width: 150px !important;
      margin-bottom: 10px;
    }
  }

  ul.pagination li a {
    color: #fff !important;
  }

  ul.pagination li a:hover {
    color: #333 !important;
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

  .container {
    min-width: 1231px !important;
    max-width: 1231px !important;
  }

  .fullpage_width1 {
    min-width: 1231px !important;
  }

  /* CSS Loader ends */
  /*custom window  changes*/
  /* .inner-top-content {
    margin-top: 231px !important;
  } */

  /* .inner-top-content {
    position: relative;
    top: 95px !important; 
  } */

  #firstSearch {
    position: relative;
    top: 119px !important;
  }

  .content-bottom-top{
    margin-top: 134px;
  }

  .success-msg-box {
    top: 73px !important;
  }

  .common_error {
    position: relative;
    top: 73px;
    width: 100%;
    font-size: 12px !important;
    color: red; 
  }

  .common_error > p {
    padding-top: 0px !important;
  }

  p {
    margin-bottom: 10px !important;
  }
  .common-nav .inner-top-content {
    position: relative;;
    margin-top: 0px!important;
  }
  @media (max-width: 1800px) {
    #firstSearch {
      top: 96px !important;
    }

    .content-bottom-top{
      margin-top: 111px;
    }

    .success-msg-box,
    .common_error {
      top: 49px !important;
    }
    .common-nav .inner-top-content {
    position: relative;;
    margin-top: 0px!important;
  }
  }
  @media (max-width: 1800px) and (min-width: 280px) {
	
  .footer-wrapper {
    min-width: 1349px;
  }
}
</style>