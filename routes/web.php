<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\master\employeeMaster\allTantousya;

Route::any('/', function () {
    return view('login');
})->name('loginPage');
Route::get('/click', function () {
    return view('dashboard');
});

Route::post('save-html-content','Controller@saveHtmlContent')->name('saveHtmlContent');

/*Route::post('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/
//V_Orderhenkan_hatsu data show for qc
Route::get('/V_Orderhenkan_hatsu', function () {
    $V_Orderhenkan_hatsu=(DB::select(DB::raw("SELECT * FROM V_Orderhenkan_hatsu ")));
    return view('purchase.qccheck.V_Orderhenkan_hatsu',compact('V_Orderhenkan_hatsu'));
//    dd(DB::select(DB::raw("SELECT * FROM V_Orderhenkan_hatsu "))[0]);
});
//V_Orderhenkan_hatsu data show for qc
Route::get('/v_orderhenkan_shiirei', function () {
    $v_orderhenkan_shiirei=(DB::select(DB::raw("SELECT * FROM v_orderhenkan_shiirei ")));
//    dd($v_orderhenkan_shiirei);
    return view('purchase.qccheck.v_orderhenkan_shiirei',compact('v_orderhenkan_shiirei'));
//    dd(DB::select(DB::raw("SELECT * FROM V_Orderhenkan_hatsu "))[0]);
});
// order(2)
Route::get('/orderdata_capture', function () {
    return view('order.orderdata_capture');
});

Route::get('/salesacceptanceprocessing', function () {
    return view('order.sales_acceptance_processing');
});

Route::get('/orderentry', function () {
    return view('order.order_entry');
});

Route::get('/orderinquery', function () {
    return view('order.order_inquiry');
});



///////////////login///////////////

Route::post('/dashboard', 'LoginController@doLogin')->name('login');
Route::post('/logout', 'LoginController@logout')->name('deru');

//////////////end login////////////

//supplier modal
Route::get('/getCompanyData/{id}', 'Controller@getCompanyData')->middleware('AjaxLogin');
Route::get('/getCompanyData_2/{id}', 'Controller@getCompanyData_2')->middleware('AjaxLogin');
Route::get('/getTorihikisakiData/{id}', 'Controller@getTorihikisakiData')->middleware('AjaxLogin');

// master(company)
Route::post('/company', 'master\CompanyMasterController@postCompanyMaster')->name('companyMaster');
Route::post('/company/postANDedit/{id}', 'master\CompanyMasterController@postEditCompanyMaster')->name('postEditCompanyMaster');
Route::get('/company/detail/{id}', 'master\CompanyMasterController@companyMasterDetail')->name('companyMasterDetail');
Route::get('/company/tableSetting/{id}/{default_id?}', 'master\CompanyMasterController@tableSetting')->name('companyMasterTableSetting');
Route::post('/company/tableSetting/{id}/{type?}', 'master\CompanyMasterController@tableSettingSave');
Route::get('/company/deleteOrReturnCompany/{id}/{type?}', 'master\CompanyMasterController@deleteOrReturnCompany')->name('deleteOrReturnCompany');
Route::get('/company/categoryWiseCategory/{id}', 'master\CompanyMasterController@categoryWiseCategory')->middleware('AjaxLogin');
Route::get('/company/getExtraShowingData/{id}', 'master\CompanyMasterController@getExtraShowingData')->middleware('AjaxLogin');
Route::get('/company/billingSearch/{id}', 'master\CompanyMasterController@billingSearch')->name('billingSearch');


// master(employee)
Route::get('/employee/clearTableSetting/{id}/{type?}', 'master\EmployeeMasterController@clearTableSetting')->name('clearEmployeeSetting')->middleware('AjaxLogin');
Route::get('/employee/tableSetting/{id}/{default_id?}', 'master\EmployeeMasterController@tableSetting')->name('employeeMasterTableSetting')->middleware('AjaxLogin');
Route::post('/employee/tableSetting/{id}', 'master\EmployeeMasterController@tableSettingSave')->middleware('AjaxLogin');
Route::post('/employee/postANDedit/{id}', 'master\EmployeeMasterController@postEditEmployeeMaster')->name('postEditEmployeeMaster')->middleware('AjaxLogin');
Route::post('/employee', 'master\EmployeeMasterController@postEmployeeMaster')->name('employeeMaster')->middleware('DashBoardLogin');
Route::get('/employee/detail/{id}/{type?}', 'master\EmployeeMasterController@masterDetail')->name('masterDetail')->middleware('AjaxLogin');
Route::get('/employee/categoryAsCategory/{id}', 'master\EmployeeMasterController@categoryWiseCategory')->middleware('AjaxLogin');

// master(dashboard comments)
Route::get('/dashboard_comments/clearTableSetting/{id}/{type?}', 'other\DashboardCommentController@clearTableSetting')->name('clearDashboardCommentSetting')->middleware('AjaxLogin');
Route::get('/dashboard_comments/tableSetting/{id}/{default_id?}', 'other\DashboardCommentController@tableSetting')->name('dashboardCommentTableSetting')->middleware('AjaxLogin');
Route::post('/dashboard_comments/tableSetting/{id}/{type?}', 'other\DashboardCommentController@tableSettingSave')->middleware('AjaxLogin');
Route::post('/dashboard_comments/postANDedit/{id}', 'other\DashboardCommentController@postEditDashboardComment')->name('postEditDashboardComment')->middleware('AjaxLogin');
Route::post('/dashboard_comments', 'other\DashboardCommentController@postDashboardComment')->name('dashboardComment')->middleware('DashBoardLogin');
Route::get('/dashboard_comments/detail/{id}', 'other\DashboardCommentController@dashboardCommentDetail')->name('dashboardCommentDetail')->middleware('AjaxLogin');
// Route::get('/employee/categoryAsCategory/{id}', 'master\EmployeeMasterController@categoryWiseCategory')->middleware('AjaxLogin');


// master(product)
Route::post('/product', 'master\ProductMasterController@postProductMaster')->name('productMaster')->middleware('DashBoardLogin');
Route::post('/product/postANDedit/{id}', 'master\ProductMasterController@postEditProductMaster')->name('postEditProductMaster')->middleware('AjaxLogin');
Route::get('/product/detail/{id}', 'master\ProductMasterController@productMasterDetail')->name('productMasterDetail')->middleware('AjaxLogin');
Route::get('/product/tableSetting/{id}/{default_id?}', 'master\ProductMasterController@tableSetting')->name('productMasterTableSetting')->middleware('AjaxLogin');
Route::post('/product/tableSetting/{id}/{type?}', 'master\ProductMasterController@tableSettingSave')->middleware('AjaxLogin');
Route::get('/product/deleteOrReturnProduct/{id}/{type?}', 'master\ProductMasterController@deleteOrReturnProduct')->name('deleteOrReturnProduct')->middleware('AjaxLogin');
Route::get('/product/categoryWiseCategory/{id}', 'master\ProductMasterController@categoryWiseCategory')->middleware('AjaxLogin');
Route::get('/product/getSyouhinName/{id}', 'master\ProductMasterController@getSyouhinName')->middleware('AjaxLogin');

// master(name)
Route::get('/name/clearTableSetting/{id}/{type?}', 'master\NameMasterController@clearTableSetting')->name('clearNameSetting')->middleware('AjaxLogin');
Route::get('/name/tableSetting/{id}/{default_id?}', 'master\NameMasterController@tableSetting')->name('nameMasterTableSetting')->middleware('AjaxLogin');
Route::post('/name/tableSetting/{id}/{type?}', 'master\NameMasterController@tableSettingSave')->middleware('AjaxLogin');
Route::post('/name', 'master\NameMasterController@postNameMaster')->name('nameMaster')->middleware('DashBoardLogin');
Route::post('/name/postANDedit/{id}', 'master\NameMasterController@postEditNameMaster')->name('postEditNameMaster')->middleware('AjaxLogin');
Route::get('/name/detail/{id}', 'master\NameMasterController@masterDetail')->name('nameDetail')->middleware('AjaxLogin');
Route::get('/name/Api/{id}', 'master\NameMasterController@nameApi')->name('nameApi');



// master(seq numbering)
Route::post('/seqNumbering', 'master\SeqNumberingMasterController@postSeqNumberingMaster')->name('seqNumberingMaster')->middleware('DashBoardLogin');
Route::post('/seqNumbering/postANDedit/{id}', 'master\SeqNumberingMasterController@postEditSeqNumberingMaster')->name('postEditSeqNumberingMaster')->middleware('AjaxLogin');
Route::get('/seqNumbering/detail/{id}', 'master\SeqNumberingMasterController@seqNumberingMasterDetail')->name('seqNumberingMasterDetail')->middleware('AjaxLogin');
Route::get('/seqNumbering/tableSetting/{id}/{default_id?}', 'master\SeqNumberingMasterController@tableSetting')->name('seqNumberingMasterTableSetting')->middleware('AjaxLogin');
Route::post('/seqNumbering/tableSetting/{id}/{type?}', 'master\SeqNumberingMasterController@tableSettingSave')->middleware('AjaxLogin');
Route::get('/seqNumbering/deleteOrReturnSeqNumbering/{id}/{type?}', 'master\SeqNumberingMasterController@deleteOrReturnSeqNumbering')->name('deleteOrReturnSeqNumbering')->middleware('AjaxLogin');


// master(credit)
Route::post('/credit', 'master\CreditMasterController@postCreditMaster')->name('creditMaster')->middleware('DashBoardLogin');
Route::get('/credit/detail/{id}', 'master\CreditMasterController@creditMasterDetail')->name('creditMasterDetail')->middleware('AjaxLogin');
Route::get('/credit/tableSetting/{id}/{default_id?}', 'master\CreditMasterController@tableSetting')->name('creditMasterTableSetting')->middleware('AjaxLogin');
Route::post('/credit/tableSetting/{id}/{type?}', 'master\CreditMasterController@tableSettingSave')->middleware('AjaxLogin');
Route::get('/credit/clearTableSetting/{id}', 'master\CreditMasterController@clearTableSetting')->name('clearCreditSetting')->middleware('AjaxLogin');


// master(office)
Route::get('/office/deleteOrReturnOffice/{id}/{type?}', 'master\OfficeMasterController@deleteOrReturnOffice')->name('deleteOrReturnOffice')->middleware('AjaxLogin');
Route::get('/office/tableSetting/{id}/{default_id?}', 'master\OfficeMasterController@tableSetting')->name('officeMasterTableSetting')->middleware('AjaxLogin');
Route::post('/office/tableSetting/{id}/{type?}', 'master\OfficeMasterController@tableSettingSave')->middleware('AjaxLogin');
//Route::get('/office', 'master\OfficeMasterController@postofficeMaster')->middleware('AjaxLogin');
Route::post('/office', 'master\OfficeMasterController@postOfficeMaster')->name('officeMaster')->middleware('DashBoardLogin');
Route::any('/office/postANDedit/{id}', 'master\OfficeMasterController@postEditEmployeeMaster')->name('postEditOfficeMaster')->middleware('AjaxLogin');
Route::get('/office/detail/{id}', 'master\OfficeMasterController@masterDetail')->name('officeMasterDetail')->middleware('AjaxLogin');
Route::get('/office/haisouApi/{id}/{num}', 'master\OfficeMasterController@ApiReadHaisou')->name('haisouApi')->middleware('AjaxLogin');
Route::get('/office/haisouApi_2/{id}/{num}', 'master\OfficeMasterController@ApiReadHaisou_2')->name('haisouApi_2')->middleware('AjaxLogin');
Route::get('/office/etsuransyaApi/{id}/{num}', 'master\OfficeMasterController@ApiReadEtsuransya')->name('etsuransyaApi')->middleware('AjaxLogin');
Route::get('/office/etsuransyaDetailApi/{id}/{num}', 'master\OfficeMasterController@ApiReadEtsuransyaDetail')->name('etsuransyaApiDetail')->middleware('AjaxLogin');
Route::get('/office/loadSelectedKokyaku/{id}', 'master\OfficeMasterController@loadSelectedKokyaku')->name('loadSelectedKokyaku')->middleware('AjaxLogin');

///master(customerProductManagement)
Route::post('/customerProductManagement', 'master\CustomerProductMasterController@postMethod')->name('customerProductManagement')->middleware('DashBoardLogin');
Route::get('/customerProductManagement/detail/{id}', 'master\CustomerProductMasterController@customerProductDetail')->name('customerProductManagementDetail')->middleware('AjaxLogin');
Route::get('/customerProductManagement/delete/{id}/{type?}', 'master\CustomerProductMasterController@deleteCustomerProductDetail')->name('clearCustomerProductManagementSetting')->middleware('AjaxLogin');
Route::get('/customerProductManagement/tableSetting/{id}/{default_id?}', 'master\CustomerProductMasterController@tableSetting')->name('customerProductManagementTableSetting')->middleware('AjaxLogin');
Route::post('/customerProductManagement/tableSetting/{id}/{type?}', 'master\CustomerProductMasterController@tableSettingSave')->middleware('AjaxLogin');
Route::any('/customerProductManagement/postANDedit/{id}', 'master\CustomerProductMasterController@postEditCustomerProduct')->name('postCustomerProductManagement')->middleware('AjaxLogin');

//master(personalMaster)
Route::post('/personal-master', 'master\PersonalController@postMethod')->name('personal')->middleware('DashBoardLogin');
Route::get('/personal-master/detail/{id}', 'master\PersonalController@personalDetail')->name('personalDetail')->middleware('AjaxLogin');
Route::get('/personal-master/change-office-serial/{id}', 'master\PersonalController@changeSerial')->middleware('AjaxLogin');
Route::any('/personal-master/postAndEdit/{id}', 'master\PersonalController@postEditPersonalDetail')->name('postPersonalMasterDetail')->middleware('AjaxLogin');
Route::get('/personal-master/tableSetting/{id}/{default_id?}', 'master\PersonalController@tableSetting')->name('personalMasterTableSetting')->middleware('AjaxLogin');
Route::post('/personal-master/tableSetting/{id}/{type?}', 'master\PersonalController@tableSettingSave')->name('tableSettingsSave')->middleware('AjaxLogin');
Route::get('/personal-master/delete/{id}/{type?}', 'master\PersonalController@deletePersonalDetail')->name('personalMasterDelete')->middleware('AjaxLogin');
Route::get('/personal-master/kokyaku1WiseHaisou/{id}', 'master\PersonalController@getKokyakuWiseHaisou')->middleware('AjaxLogin');
///////product sub master///////
Route::get('/product_sub/clearTableSetting/{id}/{type?}', 'master\ProductSubController@deleteData')->name('clearProductSubSetting')->middleware('AjaxLogin');
Route::get('/product_sub/tableSetting/{id}/{default_id?}', 'master\ProductSubController@tableSetting')->name('ProductSubMasterTableSetting')->middleware('AjaxLogin');
Route::post('/product_sub/tableSetting/{id}/{type?}', 'master\ProductSubController@tableSettingSave')->middleware('AjaxLogin');
Route::any('/product_sub/postANDedit/{id}', 'master\ProductSubController@postEditProductSubMaster')->name('postEditProductSubMaster')->middleware('AjaxLogin');
Route::post('/product_sub', 'master\ProductSubController@postProductSubMaster')->name('ProductSubMaster')->middleware('DashBoardLogin');
Route::get('/product_sub/detail/{id}', 'master\ProductSubController@masterDetail')->name('ProductSubMasterDetail')->middleware('AjaxLogin');

Route::get('/product_sub/Api/{id}/{bango}', 'master\ProductSubController@ProductSubApi')->name('ProductSubApi');
Route::get('/product_sub/getCatogoryData', 'master\ProductSubController@getCatogoryData')->name('getCatogoryData');

//////////////////menu setting/////////////
Route::post('/authority_setting', 'other\AuthoritySettingController@gotoPage')->name('authority_setting');
// Route::post('/authority_setting', 'other\AuthoritySettingController@saveSetting')->name('saveSetting');

//master(product description)
Route::post('/product-description', 'master\ProductDescriptionController@postMethod')->name('productDescription')->middleware('DashBoardLogin');
Route::get('/product-description/detail/{id}', 'master\ProductDescriptionController@productDesDetail')->name('productDescriptionDetail')->middleware('AjaxLogin');
Route::any('/product-description/postAndEdit/{id}', 'master\ProductDescriptionController@postEditPersonalDetail')->name('postProductDescriptionMasterDetail')->middleware('AjaxLogin');
Route::get('/product-description/tableSetting/{id}/{default_id?}', 'master\ProductDescriptionController@tableSetting')->name('productDescriptionTableSetting')->middleware('AjaxLogin');
Route::post('/product-description/tableSetting/{id}/{type?}', 'master\ProductDescriptionController@tableSettingSave')->name('tableSettingsSave')->middleware('AjaxLogin');
Route::get('/product-description/delete/{id}/{type?}', 'master\ProductDescriptionController@deleteProductDescriptionDetail')->name('productDescriptionMasterDelete')->middleware('AjaxLogin');
Route::get('/product-description/bango-wise-name/{id}/{type}', 'master\ProductDescriptionController@getBangoWiseName')->middleware('AjaxLogin');

Route::group(['namespace' => 'order', 'prefix' => 'order-entry'], function () {
    Route::post('/', 'OrderEntryController@index')->name('orderEntry')->middleware('DashBoardLogin');
    Route::post('/open-number-search-modal/{id}', 'OrderEntryController@numberSearchModalOpen')->middleware('AjaxLogin');
    Route::post('/handel-number-search/{id}', 'OrderEntryController@handleNumberSearch')->middleware('AjaxLogin');
    Route::post('/handel-category-kanri/{id}', 'OrderEntryController@handleCategoriKanries')->middleware('AjaxLogin');
    Route::post('/categorykanri-wise-table/{id}', 'OrderEntryController@generateCategoryWiseTable')->middleware('AjaxLogin');
    Route::post('/product-sub-wise-product-detail/{id}', 'OrderEntryController@generateProductSubData')->middleware('AjaxLogin');
    Route::post('/product-details/{id}', 'OrderEntryController@productDetails')->middleware('AjaxLogin');
    Route::post('/register/{id}', 'OrderEntryController@save')->middleware('AjaxLogin');
    Route::post('/order_detail_read/{id}', 'OrderEntryController@order_detail_read')->middleware('AjaxLogin');
    Route::post('/read_pj_data/{id}', 'OrderEntryController@read_pj_data')->middleware('AjaxLogin');
    Route::get('/product-modal-open/{id}', 'OrderEntryController@openProductModal')->middleware('AjaxLogin');
    Route::get('/product-sub-modal-open/{id}', 'OrderEntryController@openProductSubModal')->middleware('AjaxLogin');
    Route::get('/digit-to-string-conversion/{id}/{digits}', 'OrderEntryController@digitConversion')->middleware('AjaxLogin');
    Route::get('/contact-wise-trading-condition-value/{id}', 'OrderEntryController@contractWiseTradingCondition')->middleware('AjaxLogin');
    Route::get('/sold-wise-pj-value/{id}', 'OrderEntryController@soldWisePj')->middleware('AjaxLogin');
    Route::get('/sales-billing-date-wise-payment-date/{id}', 'OrderEntryController@billingWisePaymentDate')->middleware('AjaxLogin');
    Route::get('/check-yoteimeter-status/{id}/{orderId}', 'OrderEntryController@checkYoteimeterStatus')->middleware('AjaxLogin');
});


// project registration
Route::post('/project', 'order\ProjectRegistrationController@postProjectRegistration')->name('projectRegistration')->middleware('DashBoardLogin');
Route::post('/project/postANDedit/{id}', 'order\ProjectRegistrationController@postEditProjectRegistration')->name('postEditProjectRegistration')->middleware('AjaxLogin');
Route::get('/project/detail/{id}', 'order\ProjectRegistrationController@projectRegistrationDetail')->name('projectRegistrationDetail')->middleware('AjaxLogin');
Route::get('/project/tableSetting/{id}/{default_id?}', 'order\ProjectRegistrationController@tableSetting')->name('projectRegistrationTableSetting')->middleware('AjaxLogin');
Route::post('/project/tableSetting/{id}/{type?}', 'order\ProjectRegistrationController@tableSettingSave')->middleware('AjaxLogin');
Route::get('/project/deleteOrReturnProduct/{id}/{type?}', 'order\ProjectRegistrationController@deleteOrReturnProject')->name('deleteOrReturnProject')->middleware('AjaxLogin');
Route::get('/project/companyDetailApi/{id}/{num}', 'order\ProjectRegistrationController@ApiReadCompanyDetail')->name('companyDetailApi')->middleware('AjaxLogin');

// order history
Route::post('/orderHistory', 'order\OrderHistoryController@postOrderHistory')->name('orderHistory')->middleware('DashBoardLogin');
Route::get('/orderHistory/tableSetting/{id}/{default_id?}', 'order\OrderHistoryController@tableSetting')->name('orderHistoryTableSetting')->middleware('AjaxLogin');
Route::post('/orderHistory/tableSetting/{id}/{type?}', 'order\OrderHistoryController@tableSettingSave')->middleware('AjaxLogin');

// order history2
Route::post('/orderHistory2', 'order\OrderHistory2Controller@postOrderHistory2')->name('orderHistory2')->middleware('DashBoardLogin');
Route::post('/updateHikiatesyukkoData', 'order\OrderHistory2Controller@updateSelectedOrderBango')->name('updateSelectedOrderBango')->middleware('DashBoardLogin');
Route::get('/orderHistory2/tableSetting/{id}/{default_id?}', 'order\OrderHistory2Controller@tableSetting')->name('orderHistory2TableSetting')->middleware('AjaxLogin');
Route::post('/orderHistory2/tableSetting/{id}/{type?}', 'order\OrderHistory2Controller@tableSettingSave')->middleware('AjaxLogin');

// order inquiry
Route::post('/orderInquiry', 'order\OrderInquiryController@postOrderInquiry')->name('orderInquiry')->middleware('DashBoardLogin');

// back order (02-09)
Route::post('/backOrder', 'order\BackOrderController@postBackOrder')->name('backOrder')->middleware('DashBoardLogin');
Route::get('/backOrder/tableSetting/{id}/{default_id?}', 'order\BackOrderController@tableSetting')->name('backOrderTableSetting')->middleware('AjaxLogin');
Route::post('/backOrder/tableSetting/{id}/{type?}', 'order\BackOrderController@tableSettingSave')->middleware('AjaxLogin');


//back log2
Route::group(['namespace' => 'order', 'prefix' => 'backlog-list-2'], function () {
    Route::post('/', 'BacklogList2Controller@postBacklogList2')->name('backlogList2')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'BacklogList2Controller@tableSetting')->name('backlogList2TableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'BacklogList2Controller@tableSettingSave')->middleware('AjaxLogin');
});

//cancellation of pre-orders (02-12)
Route::group(['namespace' => 'order', 'prefix' => 'cancellation-of-pre-orders'], function () {
    Route::post('/', 'CancellationOfPreOrdersController@index')->name('cancellationOfPreOrders')->middleware('DashBoardLogin');
    Route::get('/cancellationOfPreOrdersInfo/{id}', 'CancellationOfPreOrdersController@cancellationOfPreOrdersInfo')->name('cancellationOfPreOrdersInfo')->middleware('AjaxLogin');
});

//////////<--- sales ------->////////////

// sales slip
Route::post('/salesSlip', 'sales\SalesSlipController@postSalesSlip')->name('salesSlip')->middleware('DashBoardLogin');
Route::get('/salesSlip/tableSetting/{id}/{default_id?}', 'sales\SalesSlipController@tableSetting')->name('salesSlipTableSetting')->middleware('AjaxLogin');
Route::post('/salesSlip/tableSetting/{id}/{type?}', 'sales\SalesSlipController@tableSettingSave')->middleware('AjaxLogin');
Route::get('/salesSlip/filterCategory', 'sales\SalesSlipController@filterCategory');
Route::post('/voucherCreation/{id}', 'sales\SalesSlipController@voucherCreation')->name('voucherCreation')->middleware('AjaxLogin');
Route::post('saleSlip/sendMail/{id}', 'sales\SalesSlipController@sendMail')->name('sendMail')->middleware('AjaxLogin');
Route::post('saleSlip/downloadPDF/{id}', 'sales\SalesSlipController@downloadPDF')->name('downloadPDF')->middleware('AjaxLogin');

// ===== Accounting Data Creation ====== //
Route::group(['namespace' => 'sales', 'prefix' => 'accounting-data-creation'], function () {
    Route::post('/', 'AccountingDataCreationController@index')->name('accountingDataCreation')->middleware('DashBoardLogin');
    Route::post('/register/{id}', 'AccountingDataCreationController@index')->middleware('AjaxLogin');
    Route::post('/deleteTempFile/{id}', 'AccountingDataCreationController@deleteTempFile')->middleware('AjaxLogin');
});

// ===== Sales Cancellation (04-17) ====== //
Route::group(['namespace' => 'sales', 'prefix' => 'sales-cancellation'], function () {
    Route::post('/', 'SalesCancellationController@index')->name('salesCancellation')->middleware('DashBoardLogin');
    Route::get('/loadSalesData/{id}', 'SalesCancellationController@loadSalesData')->middleware('AjaxLogin');
});

//////////<--- other ------->////////////

// sales history
Route::post('/salesHistory', 'sales\SalesHistoryController@postSalesHistory')->name('salesHistory')->middleware('DashBoardLogin');
Route::post('/updateSalesHistoryData', 'sales\SalesHistoryController@update')->name('updateSelectedSalesHistory')->middleware('DashBoardLogin');
Route::get('/salesHistory/tableSetting/{id}/{default_id?}', 'sales\SalesHistoryController@tableSetting')->name('salesHistoryTableSetting')->middleware('AjaxLogin');
Route::post('/salesHistory/tableSetting/{id}/{type?}', 'sales\SalesHistoryController@tableSettingSave')->middleware('AjaxLogin');
Route::post('/salesInquiry', 'sales\SalesHistoryController@postSalesInquiry')->name('salesInquiry')->middleware('DashBoardLogin');
Route::post('/updateSalesInquiryData', 'sales\SalesHistoryController@updateSalesInquiry')->name('updateSelectedSalesInquiry')->middleware('DashBoardLogin');

// deposit history
Route::post('/depositHistory', 'sales\DepositHistoryController@postDepositHistory')->name('depositHistory')->middleware('DashBoardLogin');
Route::get('/depositHistory/tableSetting/{id}/{default_id?}', 'sales\DepositHistoryController@tableSetting')->name('depositHistoryTableSetting')->middleware('AjaxLogin');
Route::post('/depositHistory/tableSetting/{id}/{type?}', 'sales\DepositHistoryController@tableSettingSave')->middleware('AjaxLogin');

// deposit history
Route::group(['namespace' => 'sales', 'prefix' => 'deposit-history-list'], function () {
    Route::post('/', 'DepositHistoryListController@index')->name('depositHistoryList')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'DepositHistoryListController@tableSetting')->name('depositHistoryListTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'DepositHistoryListController@tableSettingSave')->middleware('AjaxLogin');
});
// L-Book
Route::post('/lBook', 'other\LBookController@postLBook')->name('lBook')->middleware('DashBoardLogin');
Route::post('/lBook/postANDedit/{id}', 'other\LBookController@postEditLBookRegistration')->name('postEditLBookRegistration')->middleware('AjaxLogin');
Route::get('/lBook/detail/{id}', 'other\LBookController@lBookDetail')->name('lBookDetail')->middleware('AjaxLogin');
Route::get('/lBook/tableSetting/{id}/{default_id?}', 'other\LBookController@tableSetting')->name('lBookTableSetting')->middleware('AjaxLogin');
Route::post('/lBook/tableSetting/{id}/{type?}', 'other\LBookController@tableSettingSave')->middleware('AjaxLogin');
Route::get('/lBook/deleteOrReturnLBook/{id}/{type?}', 'other\LBookController@deleteOrReturnLBook')->name('deleteOrReturnLBook')->middleware('AjaxLogin');
Route::get('/lBook/lBookFileDownload', 'other\LBookController@lBookFileDownload')->name('lBookFileDownload');

//specifyOrderEntry 11-07
Route::post('/specifyOrderEntry', 'other\SpecifyOrderEntryController@postSpecifyOrderEntry')->name('specifyOrderEntry')->middleware('DashBoardLogin');

//all-accounting-data-creation 11-09
Route::group(['namespace' => 'other', 'prefix' => 'all-accounting-data-creation'], function () {
    Route::post('/', 'AllAccountingDataCreationController@index')->name('allAccountingDataCreation')->middleware('DashBoardLogin');
    Route::post('/register/{id}', 'AllAccountingDataCreationController@index')->middleware('AjaxLogin');
    Route::post('/deleteTempFile/{id}', 'AllAccountingDataCreationController@deleteTempFile')->middleware('AjaxLogin');
});

///////////////other end/////////////////

////sales acceptaning page
Route::any('/sales_acceptance_process', 'order\SaleAcceptanceController@index')->name('order.salesAcceptance');
Route::post('/sales_acceptance_process/searchOrder', 'order\SaleAcceptanceController@getAllOrders');
Route::get('/sales_acceptance_process/makePdfZip', 'order\SaleAcceptanceController@makePdfZip');
Route::get('/sales_acceptance_process/sendMail', 'order\SaleAcceptanceController@sendMail');
Route::get('/sales_acceptance_process/filterCategory', 'order\SaleAcceptanceController@filterCategory');
Route::get('/filter/tantousya', 'order\SaleAcceptanceController@filtertantousya');

// sales billing deadline
Route::post('/billingDeadline', 'sales\BillingDeadlineController@postBillingDeadline')->name('billingDeadline')->middleware('DashBoardLogin');
Route::post('billingDeadline/searchOrder/{id}', 'sales\BillingDeadlineController@makeBillingTransection');

// sales billing cancellation
Route::post('/billingCancellation', 'sales\BillingCancellationController@postBillingCancellation')->name('billingCancellation')->middleware('DashBoardLogin');
Route::get('/findBillingCancellationMaxDate/', 'sales\BillingCancellationController@findBillingCancellationMaxDate')->name('findBillingCancellationMaxDate');
Route::post('billingCancellation/searchOrder/{id}', 'sales\BillingCancellationController@makeBillingCancellation');
Route::post('billingCancellation/searchDate/{id}', 'sales\BillingCancellationController@searchDate');

//sales invoice deadline
Route::post('/sales/invoiceDeadline', 'sales\InvoiceDeadlineController@postInvoiceDeadline')->name('invoiceDeadline')->middleware('DashBoardLogin');
Route::get('/findInvoiceDeadlineMaxDate/', 'sales\InvoiceDeadlineController@findInvoiceDeadlineMaxDate')->name('findInvoiceDeadlineMaxDate');
Route::get('/invoiceDeadline/tableSetting/{id}/{default_id?}', 'sales\InvoiceDeadlineController@tableSetting')->name('invoiceDeadlineTableSetting')->middleware('AjaxLogin');
Route::post('/invoiceDeadline/tableSetting/{id}/{type?}', 'sales\InvoiceDeadlineController@tableSettingSave')->middleware('AjaxLogin');
Route::post('/invoiceVoucherCreation/{id}', 'sales\InvoiceDeadlineController@invoiceVoucherCreation')->name('invoiceVoucherCreation')->middleware('AjaxLogin');
Route::post('invoiceSendMail/{id}', 'sales\InvoiceDeadlineController@sendMail')->name('invoiceSendMail')->middleware('AjaxLogin');
Route::post('invoiceDownloadPDF/{id}', 'sales\InvoiceDeadlineController@downloadPDF')->name('invoiceDownloadPDF')->middleware('AjaxLogin');

// sales data creation
Route::post('/sales_data_creation', 'sales\SalesDataCreationController@index')->name('sales_data_creation')->middleware('DashBoardLogin');
Route::get('/sales_data_creation/crud', 'sales\SalesDataCreationController@crud');

//API for all
Route::get('/sales_acceptance_process/filterCategoryForAll', 'order\SaleAcceptanceController@filterCategoryForMultiRow');
// sales related deleted note route
Route::group(['namespace' => 'sales', 'prefix' => 'delivery-note'], function () {
    Route::post('/', 'DeliveryNoteController@index')->name('deliveryNote')->middleware('DashBoardLogin');
    Route::post('/create-csv/{id}', 'DeliveryNoteController@createCSV')->middleware('AjaxLogin');
    Route::post('/download-csv/{id}', 'DeliveryNoteController@downloadCSV')->name('deliveryNoteDownloadCsv')->middleware('AjaxLogin');
    Route::post('/delete-csv/{id}', 'DeliveryNoteController@deleteCSV')->name('deliveryNoteDeleteCsv')->middleware('AjaxLogin');
    Route::get('/filterCategoryForAll', 'DeliveryNoteController@filterCategoryForMultiRow');
});

Route::group(['namespace' => 'sales', 'prefix' => 'deposit-input'], function () {
    Route::post('/', 'DepositInputController@index')->name('depositInput')->middleware('DashBoardLogin');
    Route::post('/register/{id}', 'DepositInputController@save')->middleware('AjaxLogin');
    Route::post('/expected-deposit-amount/{id}', 'DepositInputController@getExpectedDepositAmount')->middleware('AjaxLogin');
    Route::post('/details/{id}', 'DepositInputController@getDetails')->middleware('AjaxLogin');
    Route::post('/delete-line/{id}', 'DepositInputController@deleteLine')->middleware('AjaxLogin');
    Route::get('/bill-wise-categories/{id}', 'DepositInputController@billingAddressWiseCategories')->middleware('AjaxLogin');
});

Route::group(['namespace' => 'sales', 'prefix' => 'deposit-application'], function () {
    Route::post('/', 'DepositApplicationController@index')->name('depositApplication')->middleware('DashBoardLogin');
    Route::post('/bill-wise-data/{id}', 'DepositApplicationController@getBillingWiseData')->middleware('AjaxLogin');
    Route::post('/search-data/{id}', 'DepositApplicationController@searchedData')->middleware('AjaxLogin');
    Route::post('/sales-subject/{id}', 'DepositApplicationController@salesSubject')->middleware('AjaxLogin');
    Route::post('/update', 'DepositApplicationController@update')->name('updateDepositApplication')->middleware('DashBoardLogin');
});

//accountList (04-20)
Route::group(['namespace' => 'sales', 'prefix' => 'account-list'], function () {
    Route::post('/', 'AccountListController@index')->name('accountList')->middleware('DashBoardLogin');
    Route::post('/downloadAccountList', 'AccountListController@downloadAccountList')->name('downloadAccountList')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'AccountListController@tableSetting')->name('accountListTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'AccountListController@tableSettingSave')->middleware('AjaxLogin');
});

//credit limit management (04-26)
Route::group(['namespace' => 'sales', 'prefix' => 'credit-limit-management'], function () {
    Route::post('/', 'CreditLimitManagementController@postCreditLimitManagement')->name('creditLimitManagement')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'CreditLimitManagementController@tableSetting')->name('creditLimitManagementTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'CreditLimitManagementController@tableSettingSave')->middleware('AjaxLogin');
});

//unpaid list
Route::group(['namespace' => 'sales', 'prefix' => 'unpaid-list'], function () {
    Route::post('/', 'UnPaidListController@index')->name('unpaidList')->middleware('DashBoardLogin');
    Route::post('/updateDepositeDate', 'UnPaidListController@updateSelectedDepositeDate')->name('updateSelectedDepositeDate')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'UnPaidListController@tableSetting')->name('unpaidListTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'UnPaidListController@tableSettingSave')->middleware('AjaxLogin');
});



// ===== Flat Rate Contract route ====== //
Route::group(['namespace' => 'flatRateContract', 'prefix' => 'flat-rate-entry'], function () {
    Route::post('/', 'FlatRateEntryController@index')->name('flatRateEntry')->middleware('DashBoardLogin');
    Route::post('/filterProductModalData/{id}', 'FlatRateEntryController@filterProductModalData')->middleware('AjaxLogin');
    Route::post('/getProductDeatils/{id}', 'FlatRateEntryController@getProductDeatils')->middleware('AjaxLogin');
    Route::post('/getSelectedProductDeatils/{id}', 'FlatRateEntryController@getSelectedProductDeatils')->middleware('AjaxLogin');
    Route::post('/validateBeforeSubmit/{id}', 'FlatRateEntryController@validateBeforeSubmit')->middleware('AjaxLogin');
    Route::post('/register/{id}', 'FlatRateEntryController@save')->middleware('AjaxLogin');
    Route::post('/validateOrderShipping/{id}', 'FlatRateEntryController@validateOrderShipping')->middleware('AjaxLogin');
    Route::post('/validateMaintenance/{id}', 'FlatRateEntryController@validateMaintenance')->middleware('AjaxLogin');
    Route::post('/searchDataFromOthers2/{id}', 'FlatRateEntryController@searchInitialValueFromOthers2')->middleware('AjaxLogin');
    Route::post('/calculateTaxRate/{id}', 'FlatRateEntryController@calculateTaxRate')->middleware('AjaxLogin');
    Route::post('/loadRegisteredData/{id}', 'FlatRateEntryController@loadRegisteredData')->middleware('AjaxLogin');
});

//create order
Route::group(['namespace' => 'flatRateContract', 'prefix' => 'create-order'], function () {
    Route::post('/', 'CreateOrderController@index')->name('createOrder')->middleware('DashBoardLogin');
    Route::post('/register/{id}', 'CreateOrderController@save')->middleware('AjaxLogin');
});

//create data juchu teiki and teiki to juchu
Route::get('/flatRate/createData/{id}/{orderEntry}/{company_code}', 'flatRateContract\CreateDataController@index')->middleware('AjaxLogin');

//create data2 juchu teiki and teiki to juchu (03-01)
Route::group(['namespace' => 'flatRateContract', 'prefix' => 'create-data2'], function () {
    Route::post('/', 'CreateData2Controller@index')->name('createData2')->middleware('DashBoardLogin');
    Route::post('/validate/{id}', 'CreateData2Controller@orderValidation')->middleware('AjaxLogin');
    Route::post('/register/{id}', 'CreateData2Controller@save')->middleware('AjaxLogin');
});

// billingDataCreation
Route::post('/billing_data_creation', 'sales\BillingDataCreationController@index')->name('billingDataCreate')->middleware('DashBoardLogin');

Route::post('/billing_data_validation/{id}', 'sales\BillingDataCreationController@validation')->name('billingDataCreateCSV')->middleware('AjaxLogin');

Route::get('/billing_data_csv_generation', 'sales\BillingDataCreationController@downloadCsv')->name('billingDataDownloadCSV');

//////end

// balance update
Route::post('/balance_update', 'sales\BalanceUpdateController@index')->name('balanceUpdate')->middleware('DashBoardLogin');

Route::post('/balance_update/{id}', 'sales\BalanceUpdateController@update')->name('balanceUpdateAction')->middleware('AjaxLogin');

//////end

// depositAccountingDataCreate
Route::post('/deposit_accounting_data_creation', 'sales\DepositAccountingDataCreationController@index')->name('depositAccountingDataCreate')->middleware('DashBoardLogin');

Route::post('/deposit_accounting_data_validation/{id}', 'sales\DepositAccountingDataCreationController@validation')->name('depositAccountingDataCreateCSV')->middleware('AjaxLogin');

Route::get('/deposit_accounting_data_csv_generation', 'sales\DepositAccountingDataCreationController@download')->name('depositAccountingDataDownloadCSV');

//////end

// billingDataUpload
Route::post('/billing_data_upload', 'sales\BillingDataUploadController@index')->name('billingDataUpload')->middleware('DashBoardLogin');
//end


//fixedRateContract started
Route::group(['namespace' => 'flatRateContract', 'prefix' => 'fixed-rate-contract'], function () {
    Route::post('/', 'FixedRateContractController@index')->name('fixedRateContract')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'FixedRateContractController@tableSetting')->name('fixedRateTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'FixedRateContractController@tableSettingSave')->middleware('AjaxLogin');
});
//fixedRateInquiry started
Route::group(['namespace' => 'flatRateContract', 'prefix' => 'fixed-rate-inquiry'], function () {
    Route::post('/', 'FixedRateInquiryController@index')->name('fixedRateInquiry')->middleware('DashBoardLogin');
});

//ChangeInchargeOfFixedRateContract (03-05)
Route::group(['namespace' => 'flatRateContract', 'prefix' => 'change-incharge-of-fixed-rate-contract'], function () {
    Route::post('/', 'ChangeInchargeOfFixedRateContractController@index')->name('changeInchargeOfFixedRateContract')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'ChangeInchargeOfFixedRateContractController@tableSetting')->name('changeInchargeOfFixedRateContractTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'ChangeInchargeOfFixedRateContractController@tableSettingSave')->middleware('AjaxLogin');
    Route::post('/updateChangeInchargeOfFixedRateContract', 'ChangeInchargeOfFixedRateContractController@updateChangeInchargeOfFixedRateContract')->name('updateChangeInchargeOfFixedRateContract')->middleware('DashBoardLogin');
    Route::get('/checkChangeInchargeOfFixedRateContractUpdateData/{id}', 'ChangeInchargeOfFixedRateContractController@checkChangeInchargeOfFixedRateContractUpdateData')->name('checkChangeInchargeOfFixedRateContractUpdateData')->middleware('AjaxLogin');
});

//ChangeInChargeOfInHouseWorkWithFixedRateContract (03-06)
Route::group(['namespace' => 'flatRateContract', 'prefix' => 'change-in-charge-of-in-house-work-with-fixed-rate-contract'], function () {
    Route::post('/', 'ChangeInChargeOfInHouseWorkWithFixedRateContractController@index')->name('changeInchargeOfInHouseWorkWithFixedRateContract')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'ChangeInChargeOfInHouseWorkWithFixedRateContractController@tableSetting')->name('changeInchargeOfInHouseWorkWithFixedRateContractTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'ChangeInChargeOfInHouseWorkWithFixedRateContractController@tableSettingSave')->middleware('AjaxLogin');
    Route::post('/updateChangeInchargeOfInHouseWorkWithFixedRateContract', 'ChangeInChargeOfInHouseWorkWithFixedRateContractController@updateChangeInchargeOfInHouseWorkWithFixedRateContract')->name('updateChangeInchargeOfInHouseWorkWithFixedRateContract')->middleware('DashBoardLogin');
    Route::get('/checkChangeInchargeOfInHouseWorkWithFixedRateContractUpdateData/{id}', 'ChangeInChargeOfInHouseWorkWithFixedRateContractController@checkChangeInchargeOfInHouseWorkWithFixedRateContractUpdateData')->name('checkChangeInchargeOfInHouseWorkWithFixedRateContractUpdateData')->middleware('AjaxLogin');   
});

//billingBalancetList(04-06)
Route::group(['namespace' => 'sales', 'prefix' => 'billingBalanceList'], function () {
    Route::post('/', 'BillingBalanceListController@postBillingBalanceList')->name('billingBalanceList')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'BillingBalanceListController@tableSetting')->name('billingBalanceListTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'BillingBalanceListController@tableSettingSave')->middleware('AjaxLogin');
});


// cancellation of unearned sales
Route::group(['namespace' => 'sales', 'prefix' => 'unearnedSalesCancellation'], function () {
    Route::post('/', 'UnearnedSalesCancellationController@index')->name('unearnedSalesCancellation')->middleware('DashBoardLogin');
    Route::post('/cancellationProcess', 'UnearnedSalesCancellationController@cancellationProcess')->name('unearnedSalesCancellationProcess')->middleware('DashBoardLogin');
    Route::post('/billing_data_order_data_retrive', 'UnearnedSalesCancellationController@billing_data_order_data_retrive')->name('unearnedSalesCancelBillingDataOrderDataRetrive')->middleware('DashBoardLogin');
});


//deposit application sys
Route::group(['namespace' => 'sales', 'prefix' => 'deposit-sys-application'], function () {
    Route::post('/', 'DepositSysApplicationController@index')->name('depositSysApplication')->middleware('DashBoardLogin');
    Route::post('/importCSV', 'DepositSysApplicationController@importCSV')->name('importCSV')->middleware('DashBoardLogin');
});
//customer ledger Started
Route::post('/customer_ledger', 'sales\CustomerLedgerController@index')->name('customer_ledger');
Route::get('/customerLedger/tableSetting/{id}/{default_id?}', 'sales\CustomerLedgerController@tableSetting')->name('customerLedgerTableSetting')->middleware('AjaxLogin');
Route::post('/customerLedger/tableSetting/{id}/{type?}', 'sales\CustomerLedgerController@tableSettingSave')->middleware('AjaxLogin');

//billing Ledger Started
Route::group(['namespace' => 'sales', 'prefix' => 'billing-ledger'], function () {
    Route::post('/', 'BillingLedgerController@index')->name('billingLedger')->middleware('DashBoardLogin');
    Route::post('/downloadBillingLedger', 'BillingLedgerController@downloadBillingLedger')->name('downloadBillingLedger')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'BillingLedgerController@tableSetting')->name('billingLedgerTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'BillingLedgerController@tableSettingSave')->middleware('AjaxLogin');
});


//New Dashboard Pages Starts Here

Route::get('/dashboard/notice_details/{id}/{notice_id}/{bango}', 'DashboardController@noticeDetail')->name('noticeDetail');
Route::get('/dashboard/notice/{notice_id}/{bango}', 'DashboardController@notice')->name('notice');
Route::get('/dashboard/other_notice', 'DashboardController@otherNotice')->name('otherNotice');

// Route::get('/system_notice', function () {
//   return view('dashboard page.system_notice');
// });
// Route::get('/notice_details', function () {
//   return view('dashboard page.notice_details');
// });
// Route::get('/other_notice', function () {
//   return view('dashboard page.other_notice');
// });
//New Dashboard Pages Ends Here

Route::get('/office', function () {
    return view('master.office');
});
Route::get('/product', function () {
    return view('master.product');
});
Route::get('/personal', function () {
    return view('master.personal');
});
Route::get('/company', function () {
    return view('master.company');
});
Route::get('/seq_numbering', function () {
    return view('master.seq_numbering');
});

Route::get('/test', function () {
    //dd(session()->all());
    /* $get=allTantousya::data('1313')->where('bango',1313)->first()->name;

      dd($get);*/


    $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));

    pg_query($conn, "BEGIN");

    $bango='8003';
    $update_array =
    [
        'mail' => 'sakal@de.pakal'
    ];
    $where_array=[
        'bango'=>$bango
    ];
    QueryHelper::updateData('tantousya',$update_array,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
    $boss=QueryHelper::fetchSingleResult("select * from tantousya where bango='$bango'");
    //dd($boss,\DB::table('tantousya')->where('bango',$bango)->first());
    pg_query($conn,"COMMIT");
    /*$filename = 'message.csv';
    $csvfile = 'message/' . $filename;


    if (file_exists($csvfile)) {
        $file = fopen($csvfile, "r");
        $datamsg = file($csvfile);
        fclose($file);
    }
    foreach ($datamsg as $key => $value) {
        $val = explode(',', $value);
        $msgArray[$val[0]] = $val[1];
    }
    dd($msgArray);*/
});
Route::get('/html', function () {
     $directory = "log/html_log/" . date("Ymd", strtotime("-1 days"));
     dd(file_exists($directory));
});

//Database Management Like Dynamically Inserting, updating, deleting and Feathing
Route::get('show','dbManager\getqueryController@showTables')->name('query.show');
Route::post('show','dbManager\getqueryController@postTables');

//Purchase (hatchu-nyuryoku)(05-02)
Route::group(['namespace' => 'purchase', 'prefix' => 'hatchu-nyuryoku'], function () {
    Route::post('/', 'PurchaseController@index')->name('purchase')->middleware('DashBoardLogin');
    Route::post('/handel-category-kanri/{id}', 'PurchaseController@handleCategoriKanries')->middleware('AjaxLogin');
    Route::post('/categorykanri-wise-table/{id}', 'PurchaseController@generateCategoryWiseTable')->middleware('AjaxLogin');
    Route::post('/register/{id}', 'PurchaseController@save')->middleware('AjaxLogin');
    Route::post('/open-number-search-modal/{id}', 'PurchaseController@numberSearchModalOpen')->middleware('AjaxLogin');
    Route::post('/handel-number-search/{id}', 'PurchaseController@handleNumberSearch')->middleware('AjaxLogin');
    Route::post('/order-detail-read/{id}', 'PurchaseController@orderDetailRead')->middleware('AjaxLogin');
    // For support number search
    Route::post('/open-support-number-search-modal/{id}', 'PurchaseController@supportNumberSearchModalOpen')->middleware('AjaxLogin');
    Route::post('/handel-support-number-search/{id}', 'PurchaseController@handleSupportNumberSearch')->middleware('AjaxLogin');
    Route::post('/support-order-detail-read/{id}', 'PurchaseController@supportOrderDetailRead')->middleware('AjaxLogin');
    Route::get('/contact-wise-trading-condition-value/{id}', 'PurchaseController@contractWiseTradingCondition')->middleware('AjaxLogin');
    Route::post('/product-details/{id}', 'PurchaseController@productDetails')->middleware('AjaxLogin');
    Route::post('/juchusyukko-order-hantei-confirm/{id}', 'PurchaseController@orderHanteiConfirm')->middleware('AjaxLogin');
    Route::post('/support-order-number-validation/{id}', 'PurchaseController@supportOrderNumberValidation')->middleware('AjaxLogin');
    Route::get('/check-number-search-status/{id}/{orderId}', 'PurchaseController@checkNumberSearchStatus')->middleware('AjaxLogin');
});

//purchase Input (06-03)
Route::group(['namespace' => 'purchase', 'prefix' => 'purchase-input'], function () {
    Route::post('/', 'PurchaseInputController@index')->name('purchaseInput')->middleware('DashBoardLogin');
    Route::post('/open-number-search-modal/{id}', 'PurchaseInputController@numberSearchModalOpen')->middleware('AjaxLogin');
    Route::post('/handel-number-search/{id}', 'PurchaseInputController@handleNumberSearch')->middleware('AjaxLogin');
    Route::post('/order-detail-read/{id}', 'PurchaseInputController@orderDetailRead')->middleware('AjaxLogin');
    Route::post('/get-backlog-data/{id}', 'PurchaseInputController@getOrderBacklogData')->middleware('AjaxLogin');
    Route::get('/purchase-date-wise-payment-date/{id}', 'PurchaseInputController@purchaseWisePaymentDate')->middleware('AjaxLogin');
    Route::post('/handel-category-kanri/{id}', 'PurchaseInputController@handleCategoriKanries')->middleware('AjaxLogin');
    Route::post('/categorykanri-wise-table/{id}', 'PurchaseInputController@generateCategoryWiseTable')->middleware('AjaxLogin');
    Route::post('/register/{id}', 'PurchaseInputController@save')->middleware('AjaxLogin');
    Route::post('/get-order-detail-table-data/{id}', 'PurchaseInputController@getOrderDetailTableData')->middleware('AjaxLogin');
    Route::post('/calculate-tax-rate/{id}', 'PurchaseInputController@calculateTaxRate')->middleware('AjaxLogin');
});

//Supplier Leger (06-07)
Route::group(['namespace' => 'purchase', 'prefix' => 'supplier-ledger'], function () {
    Route::post('/', 'SupplierLedgerController@postSupplierLedger')->name('supplierLedger')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'SupplierLedgerController@tableSetting')->name('supplierLedgerTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'SupplierLedgerController@tableSettingSave')->middleware('AjaxLogin');
    // Route::get('/inventoryListUpdate/{id}', 'InventoryListController@inventoryListUpdate')->name('inventoryListUpdate')->middleware('AjaxLogin');
});

//inventory list (06-08)
Route::group(['namespace' => 'purchase', 'prefix' => 'inventory-list'], function () {
    Route::post('/', 'InventoryListController@postInventoryList')->name('inventoryList')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'InventoryListController@tableSetting')->name('inventoryListTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'InventoryListController@tableSettingSave')->middleware('AjaxLogin');
    // Route::get('/inventoryListUpdate/{id}', 'InventoryListController@inventoryListUpdate')->name('inventoryListUpdate')->middleware('AjaxLogin');
});


//06-10 => Payment Schedule Registration
Route::group(['namespace' => 'purchase', 'prefix' => 'pay-schedule-reg'], function () {
    Route::post('/', 'PaymentScheduleRegistrationController@index')->name('paymentScheduleRegistration')->middleware('DashBoardLogin');
    Route::post('/handle-payment-schedule-registration-pagination', 'PaymentScheduleRegistrationController@handlePaymentScheduleRegistrationPagination')->name('handlePaymentScheduleRegistrationPagination')->middleware('DashBoardLogin');
    Route::post('/handle-payment-schedule-registration-pagination_3_1', 'PaymentScheduleRegistrationController@handlePaymentScheduleRegistrationPagination_3_1')->name('handlePaymentScheduleRegistrationPagination_3_1')->middleware('DashBoardLogin');
    Route::get('/process_2_202_display_data/{id}', 'PaymentScheduleRegistrationController@process_2_202_display_data')->name('process_2_202_display_data')->middleware('AjaxLogin');
    Route::post('/register/{id}', 'PaymentScheduleRegistrationController@save')->middleware('AjaxLogin');
});



//payment-input (06-13)
Route::group(['namespace' => 'purchase', 'prefix' => 'payment-input'], function () {
    Route::post('/', 'PaymentInputController@index')->name('paymentInput')->middleware('DashBoardLogin');
    Route::post('/register/{id}', 'PaymentInputController@save')->middleware('AjaxLogin');
    Route::post('/get-balance-amount/{id}', 'PaymentInputController@getExpectedPayAbleAmount')->middleware('AjaxLogin');
});

//payment-data-creation
Route::group(['namespace' => 'purchase', 'prefix' => 'payment-data-creation'], function () {
    Route::post('/', 'PaymentDataCreationController@index')->name('paymentDataCreation')->middleware('DashBoardLogin');
    Route::post('/register/{id}', 'PaymentDataCreationController@save')->middleware('AjaxLogin');
    // Route::post('/get-balance-amount/{id}', 'PaymentInputController@getExpectedPayAbleAmount')->middleware('AjaxLogin');
});

//purchase history (06-04)
Route::group(['namespace' => 'purchase', 'prefix' => 'purchase-history'], function () {
    Route::post('/', 'PurchaseHistoryController@postPurchaseHistory')->name('purchaseHistory')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'PurchaseHistoryController@tableSetting')->name('purchaseHistoryTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'PurchaseHistoryController@tableSettingSave')->middleware('AjaxLogin');
    Route::get('/purchaseHistoryUpdateValidation/{id}', 'PurchaseHistoryController@purchaseHistoryValidation')->name('purchaseHistoryUpdateValidation')->middleware('AjaxLogin');
    Route::get('/purchaseHistoryUpdate/{id}', 'PurchaseHistoryController@purchaseHistoryUpdate')->name('purchaseHistoryUpdate')->middleware('AjaxLogin');
});
Route::post('/purchaseHistoryInquiry', 'purchase\PurchaseHistoryController@purchaseHistoryInquiry')->name('purchaseHistoryInquiry')->middleware('DashBoardLogin');

//purchase record transfer (06-05)
Route::group(['namespace' => 'purchase', 'prefix' => 'purchase-record-transfer'], function () {
    Route::post('/', 'PurchaseRecordTransferController@postPurchaseRecordTransfer')->name('purchaseRecordTransfer')->middleware('DashBoardLogin');
    Route::post('/sourceOrderData', 'PurchaseRecordTransferController@sourceOrderData')->name('sourceOrderData')->middleware('DashBoardLogin');
    Route::post('/destinationOrderData', 'PurchaseRecordTransferController@destinationOrderData')->name('destinationOrderData')->middleware('DashBoardLogin');
    Route::post('/register/{id}', 'PurchaseRecordTransferController@save')->middleware('AjaxLogin');
    Route::post('/source_order_details/{id}', 'PurchaseRecordTransferController@sourceOrderDetails')->middleware('AjaxLogin');
    Route::post('/destination_order_details/{id}', 'PurchaseRecordTransferController@destinationOrderDetails')->middleware('AjaxLogin');
     
});
//purchase payment Schedule (06-11)
Route::group(['namespace' => 'purchase', 'prefix' => 'payment-schedule'], function () {
    Route::post('/', 'PaymentScheduleController@postPaymentSchedule')->name('paymentSchedule')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'PaymentScheduleController@tableSetting')->name('paymentScheduleTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'PaymentScheduleController@tableSettingSave')->middleware('AjaxLogin');
    Route::get('/downloadPaymentScheduleZip/{id}', 'PaymentScheduleController@downloadPaymentScheduleZip')->name('downloadPaymentScheduleZip')->middleware('AjaxLogin');
});

//purchase order (05-03)
Route::group(['namespace' => 'purchase', 'prefix' => 'purchase-order'], function () {
    Route::post('/', 'PurchaseOrderController@postPurchaseOrder')->name('purchaseOrder')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'PurchaseOrderController@tableSetting')->name('purchaseOrderTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'PurchaseOrderController@tableSettingSave')->middleware('AjaxLogin');
    Route::get('/purchaseStampUpdate/{id}', 'PurchaseOrderController@purchaseStampUpdate')->name('purchaseStampUpdate')->middleware('AjaxLogin');
    Route::get('/purchasePdfCreate/{id}', 'PurchaseOrderController@purchasePdfCreate')->name('purchasePdfCreate')->middleware('AjaxLogin');
    Route::get('/purchaseSendEmail/{id}', 'PurchaseOrderController@purchaseSendEmail')->name('purchaseSendEmail')->middleware('AjaxLogin');
    Route::get('/downloadPurchaseOrderPdfConfirm/{id}', 'PurchaseOrderController@downloadPurchaseOrderPdfConfirm')->name('downloadPurchaseOrderPdfConfirm')->middleware('AjaxLogin');
});
Route::post('/downloadPurchaseOrderPdf', 'purchase\PurchaseOrderController@downloadPurchaseOrderPdf')->name('downloadPurchaseOrderPdf')->middleware('DashBoardLogin');


//payment history (06-14)
Route::group(['namespace' => 'purchase', 'prefix' => 'payment-history'], function () {
    Route::post('/', 'PaymentHistoryController@postPaymentHistory')->name('paymentHistory')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'PaymentHistoryController@tableSetting')->name('paymentHistoryTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'PaymentHistoryController@tableSettingSave')->middleware('AjaxLogin');
});

//purchaseRecordList (06-18)
Route::post('/purchaseRecordList', 'purchase\PurchaseRecordListController@postPurchaseRecordList')->name('purchaseRecordList')->middleware('DashBoardLogin');
Route::get('/purchaseRecordList/tableSetting/{id}/{default_id?}', 'purchase\PurchaseRecordListController@tableSetting')->name('purchaseRecordListTableSetting')->middleware('AjaxLogin');
Route::post('/purchaseRecordList/tableSetting/{id}/{type?}', 'purchase\PurchaseRecordListController@tableSettingSave')->middleware('AjaxLogin');
Route::post('/purchaseRecordList/updatePurchaseRecordList', 'purchase\PurchaseRecordListController@updatePurchaseRecordList')->name('updatePurchaseRecordList')->middleware('DashBoardLogin');
Route::get('/purchaseRecordList/checkPurchaseRecordListUpdateData/{id}', 'purchase\PurchaseRecordListController@checkPurchaseRecordListUpdateData')->name('checkPurchaseRecordListUpdateData')->middleware('AjaxLogin');

//support list,support request,confirmation
Route::group(['namespace' => 'purchase', 'prefix' => 'supportReqConfirmation'], function () {
    Route::post('/', 'SupportReqConfirmationController@postSupportReqConfirmation')->name('supportReqConfirmation')->middleware('DashBoardLogin');
    Route::post('/updateSelectedSupportReqCon/{id}', 'SupportReqConfirmationController@updateSelectedSupportReqCon')->name('support.updateSelectedSupportReqCon')->middleware('DashBoardLogin');
    Route::post('/pdfCreation/{id}', 'SupportReqConfirmationController@pdfCreation')->name('support.pdfCreation')->middleware('DashBoardLogin');
    Route::post('/support/downloadPDF/{id}', 'SupportReqConfirmationController@downloadPDF')->name('support.downloadPDF')->middleware('AjaxLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'SupportReqConfirmationController@tableSetting')->name('supportReqConfirmationTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'SupportReqConfirmationController@tableSettingSave')->middleware('AjaxLogin');
});

//support inquiry
Route::group(['namespace' => 'purchase', 'prefix' => 'supportInquiry'], function () {
    Route::post('/', 'SupportInquiryController@postSupportInquiry')->name('supportInquiry')->middleware('DashBoardLogin');
});


//purchaseBalanceList(06-06)
Route::group(['namespace' => 'purchase', 'prefix' => 'purchaseBalanceList'], function () {
    Route::post('/', 'PurchaseBalanceListController@postPurchaseBalanceList')->name('purchaseBalanceList')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'PurchaseBalanceListController@tableSetting')->name('purchaseBalanceListTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'PurchaseBalanceListController@tableSettingSave')->middleware('AjaxLogin');
});

//paymentSchedule(06-09)
Route::group(['namespace' => 'purchase', 'prefix' => 'paymentScheduleCal'], function () {
    Route::post('/', 'PaymentScheduleCalController@postPaymentScheduleCal')->name('paymentScheduleCal')->middleware('DashBoardLogin');
    Route::post('/registerPaymentScheduleCal/{id}', 'PaymentScheduleCalController@registerPaymentScheduleCal')->middleware('AjaxLogin');
});


//purchaseLedger(06-15)
Route::group(['namespace' => 'purchase', 'prefix' => 'purchaseLedger'], function () {
    Route::post('/', 'PurchaseLedgerController@postPurchaseLedger')->name('purchaseLedger')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'PurchaseLedgerController@tableSetting')->name('purchaseLedgerTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'PurchaseLedgerController@tableSettingSave')->middleware('AjaxLogin');
});

//purchaseConfirmation(06-20)
Route::group(['namespace' => 'purchase', 'prefix' => 'purchaseConfirmation'], function () {
    Route::post('/', 'PurchaseConfirmationController@postPurchaseConfirmation')->name('purchaseConfirmation')->middleware('DashBoardLogin');
    Route::post('/purchaseData', 'PurchaseConfirmationController@purchaseData')->name('purchaseData')->middleware('DashBoardLogin');
    Route::post('/backlogDataSearch', 'PurchaseConfirmationController@backlogData')->name('backlogDataSearch')->middleware('DashBoardLogin');
    Route::post('/registerPurchaseConfirmation/{id}', 'PurchaseConfirmationController@registerPurchaseConfirmation')->middleware('AjaxLogin');
    Route::get('/getPurchaseCategoryData/{id}', 'PurchaseConfirmationController@getPurchaseCategoryData')->middleware('AjaxLogin');
});

//purchase details (06-23)
Route::group(['namespace' => 'purchase', 'prefix' => 'purchase-details'], function () {
    Route::post('/', 'PurchaseDetailsController@postPurchaseDetails')->name('purchaseDetails')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'PurchaseDetailsController@tableSetting')->name('purchaseDetailsTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'PurchaseDetailsController@tableSettingSave')->middleware('AjaxLogin');
    Route::get('/tableSetting2/{id}/{default_id?}', 'PurchaseDetailsController@tableSetting2')->name('purchaseDetailsTableSetting2')->middleware('AjaxLogin');
    Route::post('/tableSetting2/{id}/{type?}', 'PurchaseDetailsController@tableSetting2Save')->middleware('AjaxLogin');
    Route::get('/validationCheck/{id}', 'PurchaseDetailsController@validationCheck')->name('validationCheck')->middleware('AjaxLogin');
    Route::get('/updatePd/{id}', 'PurchaseDetailsController@updatePurchaseDetails')->name('updatePd')->middleware('AjaxLogin');
});

// ===== import purchase data (06-24) ====== //
Route::group(['namespace' => 'purchase', 'prefix' => 'import-purchase-data'], function () {
    Route::post('/', 'ImportPurchaseDataController@index')->name('importPurchaseData')->middleware('DashBoardLogin');
    Route::post('/importCSV', 'ImportPurchaseDataController@importCSV')->name('importCSV')->middleware('DashBoardLogin');
});

//accountBalanceUpdate(06-26)
Route::group(['namespace' => 'purchase', 'prefix' => 'accountBalanceUpdate'], function () {
    Route::post('/', 'AccountBalanceUpdateController@postAccountBalanceUpdate')->name('accountBalanceUpdate')->middleware('DashBoardLogin');
});

//purchase end calculation (06-16)
Route::group(['namespace' => 'purchase', 'prefix' => 'purchase-end-calculation'], function () {
    Route::post('/', 'PurchaseEndCalculationController@index')->name('purchaseEndCalculation')->middleware('DashBoardLogin');
    Route::post('/validate/{id}', 'PurchaseEndCalculationController@orderValidation')->middleware('AjaxLogin');
    Route::post('/register/{id}', 'PurchaseEndCalculationController@save')->middleware('AjaxLogin');
});

//purchase slip (06-29)
Route::group(['namespace' => 'purchase', 'prefix' => 'purchase-slip'], function () {
    Route::post('/', 'PurchaseSlipController@postPurchaseSlip')->name('purchaseSlip')->middleware('DashBoardLogin');
    Route::post('/register/{id}', 'PurchaseSlipController@save')->middleware('AjaxLogin');
    Route::post('/data-create/{id}', 'PurchaseSlipController@dataCreate')->middleware('AjaxLogin');
    Route::post('/handel-category-kanri/{id}', 'PurchaseSlipController@handleCategoriKanries')->middleware('AjaxLogin');
    Route::post('/categorykanri-wise-table/{id}', 'PurchaseSlipController@generateCategoryWiseTable')->middleware('AjaxLogin');
    Route::post('/product-details/{id}', 'PurchaseSlipController@productDetails')->middleware('AjaxLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'PurchaseSlipController@tableSetting')->name('purchaseSlipTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'PurchaseSlipController@tableSettingSave')->middleware('AjaxLogin');
});

//purchase completion cancellation (06-30)
Route::group(['namespace' => 'purchase', 'prefix' => 'purchase-completion-cancellation'], function () {
    Route::post('/', 'PurchaseCompletionCancellationController@postPurchaseCompletionCancellation')->name('purchaseCompletionCancellation')->middleware('DashBoardLogin');
    Route::post('/order_details/{id}', 'PurchaseCompletionCancellationController@orderDetails')->middleware('AjaxLogin');
    Route::post('/register/{id}', 'PurchaseCompletionCancellationController@save')->middleware('AjaxLogin');
});


// ===== Support route starts ====== //

//inhouse entry
Route::group(['namespace' => 'support', 'prefix' => 'inhouseEntry'], function () {
    Route::post('/', 'InhouseEntryController@postInhouseEntry')->name('inhouseEntry')->middleware('DashBoardLogin');
    Route::post('/number-search-modal-data/{id}', 'InhouseEntryController@numberSearchModalData')->middleware('AjaxLogin');
    Route::post('/handle-number-search/{id}', 'InhouseEntryController@handleNumberSearch')->middleware('AjaxLogin');
    Route::post('/registerInhouseEntry/{id}', 'InhouseEntryController@registerInhouseEntry')->middleware('AjaxLogin');
    Route::GET('/order_detail_read/{id}', 'InhouseEntryController@orderDetailRead')->middleware('AjaxLogin');
});

//purchaseResultList(10-02)
Route::group(['namespace' => 'support', 'prefix' => 'purchaseResultList'], function () {
    Route::post('/', 'PurchaseResultListController@postPurchaseResultList')->name('purchaseResultList')->middleware('DashBoardLogin');
    Route::post('/updatePurchaseResultList', 'PurchaseResultListController@updatePurchaseResultList')->name('updatePurchaseResultList')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'PurchaseResultListController@tableSetting')->name('purchaseResultListTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'PurchaseResultListController@tableSettingSave')->middleware('AjaxLogin');
});

// purchase inquiry result
// Route::post('/purchaseInquiryResult', 'support\PurchaseInquiryResultController@postPurchaseInquiryResult')->name('purchaseInquiryResult')->middleware('DashBoardLogin');
Route::group(['namespace' => 'support', 'prefix' => 'purchaseInquiryResult'], function () {
    Route::post('/', 'PurchaseInquiryResultController@postPurchaseInquiryResult')->name('purchaseInquiryResult')->middleware('DashBoardLogin');
    Route::post('/updatePurchaseInquiryResult', 'PurchaseInquiryResultController@updatePurchaseInquiryResult')->name('updatePurchaseInquiryResult')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'PurchaseInquiryResultController@tableSetting')->name('purchaseInquiryResultTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'PurchaseInquiryResultController@tableSettingSave')->middleware('AjaxLogin');
});

Route::group(['namespace' => 'support', 'prefix' => 'man-power-management-data-creation'], function () {
    Route::post('/', 'ManPowerManagementDataCreationController@index')->name('manPowerManagementDataCreation')->middleware('DashBoardLogin');
    Route::post('/csvProcess', 'ManPowerManagementDataCreationController@csvProcess')->name('manPowerManagementDataCreationCSVProcess')->middleware('DashBoardLogin');
});
// ===== Support route ends ====== //


//05-06 => Support Entry
Route::group(['namespace' => 'purchase', 'prefix' => 'support-entry'], function () {
    Route::post('/', 'SupportEntryController@index')->name('supportEntry')->middleware('DashBoardLogin');
    Route::post('/open-number-search-modal/{id}', 'SupportEntryController@numberSearchModalOpen')->middleware('AjaxLogin');
    Route::post('/handel-number-search/{id}', 'SupportEntryController@handleNumberSearch')->middleware('AjaxLogin');
    Route::post('/order_detail_read/{id}', 'SupportEntryController@order_detail_read')->middleware('AjaxLogin');
    Route::post('/register/{id}', 'SupportEntryController@save')->middleware('AjaxLogin');
    Route::get('/check-order-number-exist/{id}/{orderId}', 'SupportEntryController@checkOrderNumberExist')->middleware('AjaxLogin');
});

//Gross profit adjustment input (11-10)
Route::group(['namespace' => 'other', 'prefix' => 'gross_profit_adjustment_input'], function () {
    Route::post('/', 'GrossProfitAdjustmentInputController@index')->name('grossProfitAdjustmentInput')->middleware('DashBoardLogin');
    Route::post('/register/{id}', 'GrossProfitAdjustmentInputController@save')->middleware('AjaxLogin');
    Route::post('/handel-category-kanri/{id}', 'GrossProfitAdjustmentInputController@handleCategoriKanries')->middleware('AjaxLogin');
    Route::post('/categorykanri-wise-table/{id}', 'GrossProfitAdjustmentInputController@generateCategoryWiseTable')->middleware('AjaxLogin');
    Route::post('/product-details/{id}', 'GrossProfitAdjustmentInputController@productDetails')->middleware('AjaxLogin');
    Route::post('/order_details/{id}', 'GrossProfitAdjustmentInputController@orderDetails')->middleware('AjaxLogin');
    Route::post('/employee_cd/{id}', 'GrossProfitAdjustmentInputController@getEmployeeCD')->middleware('AjaxLogin');
});

///backloglist2 table creation////
Route::get('/from_scratch', 'order\BackListSqlController@button_make_table_from_scratch');
Route::get('/make_table', 'order\BackListSqlController@make_table_from_scratch');
Route::get('/update_button', 'order\BackListSqlController@update_button');
Route::get('/update_table', 'order\BackListSqlController@update_table');

Route::get("/test_sql",function(){
    $hikiatesyukko2 = [
                        'orderbango' => NULL,
                        'syouhinid' => "231321",
                        'syouhinsyu' => 3
                    ];
                    QueryHelper::insertData('hikiatesyukko2', $hikiatesyukko2, 'syouhinid', false, "8003", __CLASS__, __FUNCTION__, __LINE__);
});
///End backloglist2 table creation////
