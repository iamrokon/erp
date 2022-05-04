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
  .custom-table-oh{
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

    .custom-table-1{
      position: relative;
    }
    .custom-table-1:after{
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

    .form-button{
      background: #fff;
      padding: 10px;
      text-align: center;
      border-radius: 5px;
    }
    .form-button .btn{
      width: 163px;
    }
    .form-button .btn-success{
      background: #009943;
    }
    .form-button .btn-primary{
      background: #2C66B0;
    }
    select:focus option{
      outline: none;
      -moz-appearance: none;
      -webkit-appearance: none;
    }
    .form-control:focus option{
      outline: none;
      -moz-appearance: none;
      -webkit-appearance: none;
    }
    /*select option:focus{
       outline: 0;
      -moz-appearance: none;
      -webkit-appearance: none;
    }*/
   .w-145{
    width: 145px;
   }
   .border-line-area{
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
  .custom-data-modal .bg-white {
    background: #fff !important;
}

  @media only screen and (max-width: 767px)  {
    .radio-rounded .custom-control{
        margin-left: 10px!important;
        margin-right: 14px!important;
    }
    .radio-rounded{
        margin-left: 17px!important;
    }
    .pagi{
      margin-top: 12px;
    }
    .right-pagi{
      padding-top: 9px;
    }
  }
  @media only screen and (max-width: 550px){
    .page-head ul li{
      font-size: 15px;
    }
  }

  .line-title:after{
    background: transparent !important;
  }

  .fullpage_width1 {
      margin-top: 123px !important;
    }

  @media (max-width: 1800px) and (min-width: 280px) {
    .fullpage_width1 {
      margin-top: 75px !important;
      min-width: 1140px;
    }
  }

/*Custom window design*/

  .flat_rate_data_creation {
    margin-top: 0px!important;
    position: relative;
    top: 99px;
  }

  .content-head-top{
    margin-top: 0px;
  }

  .success-msg-box {
    top: 49px;
  }

  .common_error {
    top: 49px;
    color: red;
    font-size: 12px !important;
    position: relative;
    width: 100%;
    z-index: 2;
  }

  .common_error>p {
    margin-bottom: 10px !important;
  }
  
@media (max-width: 1800px){

  .success-msg-box,
    .common_error {
      top: 98px;
    }
    .flat_rate_data_creation{
      margin-top: 75px !important;
      top: 72px !important;
    }
 
}
@media (max-width: 1024px){
 
  .flat_rate_data_creation {
    margin-top: 85px !important;
  }
}
.loading-icon {
		display: block;
		width: 40px;
		position: relative;
		right: 0px;
		z-index: 9;
		top: -6px;
		left: 5px;
		display: none;
	}
</style>