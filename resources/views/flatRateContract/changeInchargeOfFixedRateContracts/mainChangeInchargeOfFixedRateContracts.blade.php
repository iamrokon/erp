
@section('title', '定期定額契約担当変更')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '定期定額契約 >')
@section('menu-test5', '定期定額契約担当変更')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('flatRateContract.changeInchargeOfFixedRateContracts.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
            @php
                if(isset($allChangeInchargeOfFixedRateContract)){
                    $skip = 0;
                    $old = array();
                    if(session()->has('oldInput'.$bango)){
                      $old = session()->get('oldInput'.$bango);
                    }
                    $current_page =$allChangeInchargeOfFixedRateContract->currentPage();
                    $per_page = $allChangeInchargeOfFixedRateContract->perPage();
                    $first_data = ($current_page - 1)*$per_page+1;
                    $last_data = ($current_page - 1)*$per_page+ sizeof($allChangeInchargeOfFixedRateContract->items());
                    $total = $allChangeInchargeOfFixedRateContract->total();
                    $lastPage = $allChangeInchargeOfFixedRateContract->lastPage() ;
                }else{
                    $current_page = 1;
                    $per_page = 20;
                    $first_data = 1;
                    $last_data = 0;
                    $total = 0;
                    $lastPage = 1;
                }
            @endphp
      {{-- First Part starts here --}}
      @include('flatRateContract.changeInchargeOfFixedRateContracts.changeInchargeOfFixedRateContractsTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('flatRateContract.changeInchargeOfFixedRateContracts.changeInchargeOfFixedRateContractsMainContent')
     {{-- Second Part Ends here --}}
   

    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>
 <!-- Table Header Settings Modal Starts Here -->
@include('master.common.table_settings_modal')
<!-- Table Header Settings Modal Ends Here -->

<!-- Supplier Modal start here -->
@include('common.supplierModal_3')
<!-- Supplier Modal end here -->

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
  {{-- Including Scripts Starts Here --}}
  @include('flatRateContract.changeInchargeOfFixedRateContracts.script')
 {{-- Including Scripts Ends Here --}}

 <script type="text/javascript">
    var fileord1 = document.createElement("script");
      fileord1.type = "text/javascript";
     fileord1.src = "{{ asset('js/flatRateContract/change_inCharge_of_fixedRate_contracts/changeInChargeOfFixedRateContract.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(fileord1);
  </script>
   <script>
      $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSetting('{{route('changeInchargeOfFixedRateContractTableSetting',$bango)}}')");
      });
  </script>
</body>

</html>