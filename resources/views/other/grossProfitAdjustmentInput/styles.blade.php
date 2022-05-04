<style>

table tr:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    outline: 0;
  }

  .content-head-top {
    /*border-bottom: 1px solid #E1E1E1;*/
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

  /*Input file design end*/
  
  /*Navbar, footer & button css*/

  .gross_profit_adjustment_input{
    min-width: 1349px !important;
  }

  .gross_profit_adjustment_input {
    margin-top: 0px!important;
    position: relative;
    top: 111px;
  }


  .success-msg-box {
    top: 73px;
  }

  .common_error {
    top: 56px;
    color: red;
    font-size: 12px !important;
    position: relative;
    width: 100%;
    z-index: 2;
  }

  .common_error> div> p {
    margin-bottom: 10px !important;
  }
  .custom-mb{
      margin-bottom: 124px!important;
    }
@media (max-width: 1800px){
  
  .success-msg-box,
    .common_error {
      top: 35px;
    }
    .custom-mb{
      margin-bottom: 95px!important;
    }
    .gross_profit_adjustment_input{
      margin-top: 0px !important;
      top: 88px !important;
    }
}
@media (max-width: 1024px){
 
  .gross_profit_adjustment_input{
    margin-top: 85px !important;
  }
}

@media screen and (max-width: 991px) {
    .res-w-76 {
      width: 60px !important;
    }
  }

  .content-bottom-section,
  .footer-wrapper {
    min-width: 1349px !important;
  }
  .table-fill.table tbody tr td input.error{
      border: 1px solid red!important;
    }
</style>