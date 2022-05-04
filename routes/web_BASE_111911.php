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
/*Route::post('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/

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

// back order
Route::post('/backOrder', 'order\BackOrderController@postBackOrder')->name('backOrder')->middleware('DashBoardLogin');
Route::get('/backOrder/tableSetting/{id}/{default_id?}', 'order\BackOrderController@tableSetting')->name('backOrderTableSetting')->middleware('AjaxLogin');
Route::post('/backOrder/tableSetting/{id}/{type?}', 'order\BackOrderController@tableSettingSave')->middleware('AjaxLogin');

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

Route::group(['namespace' => 'sales', 'prefix' => 'account-list'], function () {
    Route::post('/', 'AccountListController@index')->name('accountList')->middleware('DashBoardLogin');
    Route::get('/tableSetting/{id}/{default_id?}', 'AccountListController@tableSetting')->name('accountListTableSetting')->middleware('AjaxLogin');
    Route::post('/tableSetting/{id}/{type?}', 'AccountListController@tableSettingSave')->middleware('AjaxLogin');
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


    $filename = 'message.csv';
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
    dd($msgArray);
});
Route::get('/etsuransya', function () {
    dd(mb_convert_encoding('1⃣', 'utf-8', 'utf-8'), mb_convert_encoding('①', 'utf-8', 'utf-8'));
});


Route::get('/session', function () {
    /*$version = phpversion();
    dd($version,app()->version());*/
   
$request=[     "userId" => "8003",
  "_token" => "jJHco5qdRjnH6yvYzCZUJmIuwBIvkFv1Vtm7osLu",
  "billing_address" => "00009801",
  "shinkurokokyakuname" =>  [
    0 => "1851000191",
    1 => "1851000183",
    2 => "1851000184",
    3 => "1851000185",
    4 => "1851000186",
    5 => "1851000187",
    6 => "1851000188",
    7 => "1851000189",
    8 => "1851000190",
    9 => "1851000192",
    10 => "1851000193",
    11 => "1851000194",
    12 => "1851000195",
  ],
  "torikomidate_val" =>  [
    0 => "20200916",
    1 => "20210902",
    2 => "20210904",
    3 => "20210907",
    4 => "20210908",
    5 => "20210912",
    6 => "20210913",
    7 => "20210914",
    8 => "20210915",
    9 => "20210917",
    10 => "20210918",
    11 => "20210919",
    12 => "20210920",
  ],
  "shinkurokokyakugroup" =>  [
    0 => "1",
    1 => "1",
    2 => "1",
    3 => "1",
    4 => "1",
    5 => "1",
    6 => "1",
    7 => "1",
    8 => "1",
    9 => "1",
    10 => "1",
    11 => "1",
    12 => "1",
  ],
  "deposit_amount" =>  [
    0 => "100000",
    1 => "100000",
    2 => "100000",
    3 => "100000",
    4 => "100000",
    5 => "100000",
    6 => "100000",
    7 => "100000",
    8 => "100000",
    9 => "100000",
    10 => "200000",
    11 => "100000",
    12 => "100000",
  ],
  "applicable_amount" =>  [
    0 => "100000",
    1 => "100000",
    2 => "100000",
    3 => "100000",
    4 => "100000",
    5 => "100000",
    6 => "100000",
    7 => "100000",
    8 => "100000",
    9 => "100000",
    10 => "200000",
    11 => "100000",
    12 => "100000",
  ],
  "count" => "13",
  "complete_status" => "2",
  "sales_date_start" => "2018/08/30",
  "sales_date_end" => "2023/08/30",
  "payment_number" =>  [
    0 => "1851000195",
    1 => "1851000195",
    2 => "1851000195",
    3 => "1851000195",
    4 => "1851000195",
    5 => "1851000195",
    6 => "1851000195",
    7 => "1851000195",
    8 => "1851000195",
    9 => "1851000195",
    10 => "1851000195",
    11 => "1851000195",
    12 => "1851000195"
  ],
  "serial" =>  [
    0 => "1",
    1 => "1",
    2 => "1",
    3 => "1",
    4 => "1",
    5 => "1",
    6 => "1",
    7 => "1",
    8 => "1",
    9 => "1",
    10 => "1",
    11 => "1",
    12 => "1",
  ],
  "kingaku" =>  [
    0 => null,
    1 => "1",
    2 => "1",
    3 => "1",
    4 => "1",
    5 => "1",
    6 => "1",
    7 => "1",
    8 => "1",
    9 => "1",
    10 => "1",
    11 => "1",
    12 => "1",
  ],
  "hanbaibukacd" =>  [
    0 => null,
    1 => "0651000842",
    2 => "0651000842",
    3 => "0651000842",
    4 => "0651000842",
    5 => "0651000842",
    6 => "0651000842",
    7 => "0651000842",
    8 => "0651000842",
    9 => "0651000842",
    10 => "0651000842",
    11 => "0651000842",
    12 => "0651000842",
  ],
  "dataint18" =>  [
    0 => null,
    1 => "1",
    2 => "1",
    3 => "1",
    4 => "1",
    5 => "1",
    6 => "1",
    7 => "1",
    8 => "1",
    9 => "1",
    10 => "1",
    11 => "1",
    12 => "1",
  ],
  "dataint19" =>  [
    0 => null,
    1 => "1",
    2 => "2",
    3 => "3",
    4 => "4",
    5 => "5",
    6 => "6",
    7 => "7",
    8 => "8",
    9 => "9",
    10 => "10",
    11 => "11",
    12 => "12",
  ],
  "dataint20" =>  [
    0 => null,
    1 => "1",
    2 => "1",
    3 => "1",
    4 => "1",
    5 => "1",
    6 => "1",
    7 => "1",
    8 => "1",
    9 => "1",
    10 => "1",
    11 => "1",
    12 => "1",
  ],
  "dataint01" =>  [
    0 => "2",
    1 => "2",
    2 => "2",
    3 => "2",
    4 => "2",
    5 => "2",
    6 => "2",
    7 => "2",
    8 => "2",
    9 => "2",
    10 => "2",
    11 => "2",
    12 => "2",
  ],
  "intorder03" =>  [
    0 => "20210830",
    1 => "20210901",
    2 => "20211001",
    3 => "20211101",
    4 => "20211201",
    5 => "20220101",
    6 => "20220201",
    7 => "20220301",
    8 => "20220401",
    9 => "20220501",
    10 => "20220601",
    11 => "20220701",
    12 => "20220801",
  ],
  "numeric3_val" =>  [
    0 => "2",
    1 => "2",
    2 => "2",
    3 => "2",
    4 => "2",
    5 => "2",
    6 => "2",
    7 => "2",
    8 => "2",
    9 => "2",
    10 => "2",
    11 => "2",
    12 => "2",
  ],
  "applied_amount" =>  [
    0 => "336600",
    1 => "26950",
    2 => "26950",
    3 => "26950",
    4 => "26950",
    5 => "26950",
    6 => "26950",
    7 => "26950",
    8 => "26950",
    9 => "26950",
    10 => "26950",
    11 => "26950",
    12 => "26950",
  ],
  "datachar10" =>  [
    0 => "0951004695",
    1 => "0951004696",
    2 => "0951004697",
    3 => "0951004698",
    4 => "0951004699",
    5 => "0951004700",
    6 => "0951004701",
    7 => "0951004702",
    8 => "0951004703",
    9 => "0951004704",
    10 => "0951004705",
    11 => "0951004706",
    12 => "0951004707",
  ],
  "depositAmount" =>  [
    0 => "200,000",
    1 => "2,000",
    2 => "0",
    3 => "0",
    4 => "0",
    5 => "0",
    6 => "0",
    7 => "0",
    8 => "0",
    9 => "0",
    10 => "0",
    11 => "0",
    12 => "0",
  ],
  "juchukubun2" =>  [
    0 => "0951004695",
    1 => "0951004696",
    2 => "0951004697",
    3 => "0951004698",
    4 => "0951004699",
    5 => "0951004700",
    6 => "0951004701",
    7 => "0951004702",
    8 => "0951004703",
    9 => "0951004704",
    10 => "0951004705",
    11 => "0951004706",
    12 => "0951004707",
  ],
  "torikomidate" =>  [
    0 => "20210920",
    1 => "20210920",
    2 => "20210920",
    3 => "20210920",
    4 => "20210920",
    5 => "20210920",
    6 => "20210920",
    7 => "20210920",
    8 => "20210920",
    9 => "20210920",
    10 => "20210920",
    11 => "20210920",
    12 => "20210920",
  ],
  "orderbango" =>  [
    0 => "18684",
    1 => "18685",
    2 => "18686",
    3 => "18687",
    4 => "18688",
    5 => "18689",
    6 => "18690",
    7 => "18691",
    8 => "18692",
    9 => "18693",
    10 => "18694",
    11 => "18695",
    12 => "18696",
  ],
  "not_payment" =>  [
    0 => "336600",
    1 => "26950",
    2 => "26950",
    3 => "26950",
    4 => "26950",
    5 => "26950",
    6 => "26950",
    7 => "26950",
    8 => "26950",
    9 => "26950",
    10 => "26950",
    11 => "26950",
    12 => "26950",
  ],
  "unsoutesuryou" =>  [
    0 => "1",
    1 => "2",
    2 => "2",
    3 => "2",
    4 => "2",
    5 => "2",
    6 => "2",
    7 => "2",
    8 => "2",
    9 => "2",
    10 => "2",
    11 => "2",
    12 => "2",
  ],
  "unsoudaibikitesuryou" =>  [
    0 => "1",
    1 => "2",
    2 => "2",
    3 => "2",
    4 => "2",
    5 => "2",
    6 => "2",
    7 => "2",
    8 => "2",
    9 => "2",
    10 => "2",
    11 => "2",
    12 => "2"
  ],
  "sales_number" => "13"];
  $shinkurokokyakuorderbango='0551000000022';
  $moneymax=1;
  $applicable_amount=[
  0 => "100000",
  1 => "100000",
  2 => "100000",
  3 => "100000",
  4 => "100000",
  5 => "100000",
  6 => "100000",
  7 => "100000",
  8 => "100000",
  9 => "100000",
  10 => "200000",
  11 => "100000",
  12 => "100000",
];
 
  foreach ($request['depositAmount'] as $key => $value) {
          $pay_amount= str_replace(',', '', $value);
        
          $i=0;
          if ($pay_amount>0) {
           
            
          
            for($j=0;$j<count($applicable_amount);$j++){
                if ((int) $applicable_amount[$j] > 0) {
                    $i=$j;
                    break;
                }
            }
            $cut_from= (int) $applicable_amount[$i];
            while ($cut_from>0) {
            var_dump($pay_amount,$cut_from,$i);
              //review data
            
              if($cut_from=='0'){
                $i++;
                break;
              }
              else {
                
                $cut_from_check=$cut_from;
                $pay_amount_check=$pay_amount;

              if ($cut_from>=$pay_amount) {
                $depositAmount =(int)$pay_amount;  
                $applicable_amount[$i]=(int)$cut_from-(int)$pay_amount;
                $difference=(int)$cut_from-(int)$pay_amount;
                $cut_from=(int)$cut_from-(int)$pay_amount;

                if ((int)$request['not_payment'][$key] == $depositAmount) {
                  //$pay_amount=0;
                }
                $pay_amount=0;
                
              }else if($cut_from<$pay_amount){
                
                $difference=abs((int)$pay_amount-(int)$cut_from);
                $pay_amount=abs((int)$pay_amount-(int)$cut_from);
                $depositAmount =(int)$cut_from;
                $applicable_amount[$i]=0;
                $cut_from=0;
               
              }
   
              $shinkurokokyakuname=$request['shinkurokokyakuname'][$i];
              $shinkurokokyakugroup=$request['shinkurokokyakugroup'][$i];
              $otodoketime=$request['juchukubun2'][$key];
             // $moneymax=$request['shinkurokokyakugroup'][$i];

              //$depositAmount = str_replace(',', '', $value);
             
              } 

                $daikinseisanold = [
                      'shinkurokokyakuname' => $shinkurokokyakuname,
                      'shinkurokokyakuorderbango' => $shinkurokokyakuorderbango,
                      'moneymax' => $moneymax,
                      'shinkurokokyakugroup' => $shinkurokokyakugroup,
                      'otodoketime' => $otodoketime,
                      'soufusakiname' => '2',
                      'soufusakiyubinbango' => '2',
                      'unsoumei' => null,
                      'nyukingaku' => $depositAmount,
                      //'nyukingaku' => $applied_amount,
                      'toiawasebango' => null,
                      'seisanunsoumei' => null,
                      'seisankokyakucode' => null,
                      'seisankokyakucode2' => null,
                      'seisanbi' => null,
                      'hassoubi' => null,
                      'nyukinbi' => now()->format('Y-m-d H:i:s'),
                      'shiharaikubun' => '8003',
                      'henpinbi' => null,
                      'unsoudaibikitesuryou'=>'0'
                  ];
                  $moneymax++;
                

              $unsoutesuryou = $request['unsoutesuryou'][$key];
              $unsoudaibikitesuryou = $request['unsoudaibikitesuryou'][$key];
              $intorder03 = $request['intorder03'][$key];
              $torikomidate = $request['torikomidate_val'][$i];
              $dataint01 = $request['dataint01'][$key];

              $where_array = ['datachar10'=>$otodoketime];
            

              if($pay_amount==0 AND $request['juchukubun2'][0]!='0000000000'){
     
                if($unsoutesuryou == '2' && $unsoudaibikitesuryou == '2'){
                  $update_array_orderhenkan =
                      [
                          'intorder05' => $intorder03,
                      ];
                 // QueryHelper::updateData('orderhenkan',$update_array_orderhenkan,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
                }else {
                  $update_array_orderhenkan =
                      [
                          'intorder05' => $torikomidate,
                      ];
                 // QueryHelper::updateData('orderhenkan',$update_array_orderhenkan,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
                }
              }else if ($pay_amount==0 AND $request['juchukubun2'][0]!='0000000000' AND $check_parent_child[0]=='parent_order') {
                  $update_array_orderhenkan =
                      [
                          'intorder05' => $torikomidate,
                      ];
                 // QueryHelper::updateData('orderhenkan',$update_array_orderhenkan,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
              }
              //// update review table
              
              
              $orderbango = $request['orderbango'][$key];
              $numeric3_val = $request['numeric3_val'][$key];
              $where_array = ['orderbango'=>$orderbango];
              $update_array =
                  [
                      'dataint01' => 1,
                  ];
              
              
              $update_array =
                  [
                      'rendoumail' => 1,
                  ];
              if ($applicable_amount[$i]==0) {
                //QueryHelper::updateData('eczaikorendou', $update_array, ['sitename' => $shinkurokokyakuname, 'yukouflag' => $shinkurokokyakugroup], $bango, __CLASS__, __FUNCTION__, __LINE__);
              }
              
              
              $kingaku = $request['kingaku'][$key];
              $hanbaibukacd = $request['hanbaibukacd'][$key];
              $dataint18 = $request['dataint18'][$key];
              $dataint19 = $request['dataint19'][$key];
              $dataint20 = $request['dataint20'][$key];
              //if($kingaku AND $request['juchukubun2'][0]!='0000000000'){
              if($pay_amount==0 AND $request['juchukubun2'][0]!='0000000000'){
                $where_array = ['hanbaibukacd'=>$hanbaibukacd,'dataint18'=>$dataint18,'dataint19'=>$dataint19,'dataint20'=>$dataint20];
                $update_array =
                    [
                        'datachar26' => 1,
                    ];

               // QueryHelper::updateData('juchusyukko',$update_array,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
              }
              //success message///
              
              $msg='入金消込番号'.$shinkurokokyakuorderbango.'で登録しました。';
              session()->put('success_msg', $msg);
              $test=0;
              if ((int)$cut_from_check>= (int)$pay_amount_check) {
            
                /*if ($key < array_key_last($request['depositAmount'])) {
                   $key++;
                 } */
                break;
              }
    
                  $i++; //// next payable amount 
           
                if (isset($applicable_amount[$i])) {
                  $cut_from= (int) $applicable_amount[$i];
                }else{
                  $cut_from= 0;
                  $i++;
                }
      
         
             
              
            }
          }
          
        }
        dd('hose');
});
