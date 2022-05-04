<style>
    table tr:focus {
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
      outline: 0;
    }

    .content-head-top {
      border-bottom: 1px solid #E1E1E1;
    }

    .form-button {
      padding: 10px;
      text-align: right;
      border-radius: 5px;
      background-color: #fff;
    }

    .bg-blue {
      background: #363A81 !important;
    }

    .modal-data-box .table td,
    .table th {
      padding: .75rem;
      vertical-align: top;
      border-top: 0;
      border-bottom: 1px solid #141855 !important;
      color: #fff;
    }

    .square-title .line-icon-box {
      background: #bbbbbb;
    }

    .search-scroll::-webkit-scrollbar {
      width: 10px;
      height: 10px;
    }


    .search-scroll::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 60px #cbcbcb;
      box-shadow: inset 0 0 60px #cbcbcb;
      border-radius: 100px;
    }


    .search-scroll::-webkit-scrollbar-thumb {
      border-radius: 100px;
      background: #2c66b0;
      -webkit-box-shadow: inset 0 0 0px rgba(0, 0, 0, 0.5);
      box-shadow: inset 0 0 0px rgba(0, 0, 0, 0.5);
    }

    .bg-teal3 {
      background: #0070C0;
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

    .custom-input-field .form-control-sm,
    .input-group-sm>.form-control,
    .input-group-sm>.input-group-prepend>.input-group-text,
    .input-group-sm>.input-group-append>.input-group-text,
    .input-group-sm>.input-group-prepend>.btn,
    .input-group-sm>.input-group-append>.btn {
      padding: 0px 8px !important;
      height: 30px !important;
      width: 30px !important;
    }

    .custom_modal_input {
      width: 537px;
    }

    @media screen and (max-width: 991px) {
      .res-w-76 {
        width: 60px !important;
      }
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

    .inner-top-content {
      margin-top: 112px !important;
    }

    .success-msg-box {
      top: 101px !important;
    }

    .common_error {
      position: relative;
      top: 101px;
      width: 100%;
      font-size: 12px !important;
      color: red;
      z-index: 2;
      word-break: break-all;
      white-space: normal;
      margin-bottom: 10px !important;
    }

    @media (max-width: 1800px) {
      .common-nav .inner-top-content {
        margin-top: 88px !important;
      }

      .success-msg-box,
      .common_error {
        top: 80px !important;
      }

      .container {
        padding-left: 15px;
        padding-right: 15px;
      }

      .inner-top-content {
        margin-top: 75px !important;
      }

      .footer-wrapper {
        padding: 40px 0px 0px !important;
      }

      .footer-wrapper p {
        padding-bottom: 30px !important;
      }
    }

    .content-bottom-section,
    .footer-wrapper {
      min-width: 1349px !important;
    }

    #userTable tbody tr td {
      height: 30px !important;
    }
  </style>