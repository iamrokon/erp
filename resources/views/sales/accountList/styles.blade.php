<style>
  ul.pagination li a {
    color: #fff!important;
  }
  ul.pagination li a:hover {
    color: #333!important;
  }
  .tbl_long_height {
    max-height: 580px;
    padding-bottom: 20px;
    overflow-x: auto;
  }

  .box-wrap {
    height: 30px;
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
    .m-p-10 {
      padding: 0px 10px;
    }
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
    }
    .margin_l_custom {
      margin-left: 28px !important;
    }
  }

  @media only screen and (min-width:768px) and (max-width:992px) 
  {
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
      float: none!important;
    }

    .content-head-section {
      padding: 0;
      min-height: 0;
    }

    .tag-line{
      font-size: 0 !important;
    }
  }

  .w-145 {
    width: 145px !important;
  }

  .content-head-section {
    padding: 0;
    min-height: 0;
  }

  .close:hover,
  .close:focus {
    outline: 0;
  }

  .show_office_master_info,
  .show_personal_master_info,
  .show_content_last {
    cursor: pointer;
  }

  .custom-control-label::after {
    cursor: pointer !important;
  }
  .table_hover2_pagi .nav_mview {
    margin-bottom: 0px !important;
  }
  
  /*custom window  changes*/

  .content-bottom-section {
    margin-top: 110px;
  }

  .inner-top-content {
    margin-top: 0px !important ;
    position: relative;
    top: 124px !important;
  }

  .success-msg-box {
    top: 73px;
  }

  .common_error {
    top: 73px;
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
  }


  @media (max-width: 1800px) {
    .content-bottom-section {
      margin-top: 90px;
    }

    .common-nav .inner-top-content {
      margin-top: 0px !important ;
      top: 101px !important;
    }

    .success-msg-box,
    .common_error {
      top: 48px;
    }
  }

</style>