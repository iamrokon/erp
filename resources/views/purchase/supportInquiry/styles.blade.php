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

  .support-inquiry-top {
    min-width: 1349px !important;
  }
  .content-bottom-section,
    .footer-wrapper {
        min-width: 1349px !important;
    }
    .fullpage_width1{
  min-width: 1349px !important;
}
  /*Navbar, footer & button css*/
 
  .support-inquiry-top{
    margin-top: 118px !important;
    min-width: 1349px!important;
    
    /* max-width: 1349px!important; */
  }

.support-inquiry-top {
    margin-top: 0px !important;
    position: relative;
    top: 111px !important;
  }

  .success-msg-box {
    top: 73px;
  }

  .common_error {
    top: 73px;
    color: red;
    font-size: 12px !important;
    position: relative;
    width: 100%;
    z-index: 2;
  }

  .common_error>p {
    margin-bottom: 10px !important;
  }
  .bottom-top-100{
      margin-top:127px !important;
    }
@media (max-width: 1800px){

  .support-inquiry-top {
      margin-top: 0px !important;
      top: 89px !important;
    }
    .bottom-top-100{
      margin-top:100px !important;
    }
    .success-msg-box,
    .common_error {
      top: 48px;
    }

}
@media (max-width: 1024px){
 
  /* .support-inquiry-top {
    margin-top: 85px !important;
  } */
}
</style>