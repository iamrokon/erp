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

//Database Management Like Dynamically Inserting, updating, deleting and Feathing

Route::get('show','dbManager\getqueryController@showTables')->name('query.show');
Route::post('show','dbManager\getqueryController@postTables');
