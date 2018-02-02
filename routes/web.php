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

Route::get('login', 'UserController@login');
Route::post('login', 'UserController@doLogin');
Route::get('logout', 'UserController@logout');
Route::post('logout', 'UserController@doLogout');

Route::group(['middleware' => ['login']], function () {

    Route::get('/', 'QuotationController@list');
    /** 
     * QUOTATION
     */
    Route::get('quotation', 'QuotationController@list');
    Route::get('quotation/create', 'QuotationController@create');
    Route::post('quotation/create', 'QuotationController@doCreate');
    Route::post('quotation/{id}', 'QuotationController@update');
    Route::delete('quotation/{id}', 'QuotationController@delete');
    Route::get('quotation/basket/{id}', 'QuotationController@basket');
    Route::get('quotation/{id}', 'QuotationController@get');

    // Quotation Categories
    Route::get('quotation/categories', 'QuotationController@categories');
    Route::get('quotation/categories/create', 'QuotationController@createCategories');
    Route::post('quotation/categories/create', 'QuotationController@doCreateCategories');
    Route::get('quotation/categories/update/{id}', 'QuotationController@updateCategories');
    Route::post('quotation/categories/update/{id}', 'QuotationController@doUpdateCategories');
    Route::delete('quotation/categories/{id}', 'QuotationController@deleteCategories');
    Route::get('quotation/categories/{id}', 'QuotationController@getCategories');

    // Fixed Cost
    Route::get('quotation/fixedcost/create', 'QuotationController@createFixedCost');
    Route::post('quotation/fixedcost/create', 'QuotationController@doCreateFixedCost');
    Route::get('quotation/fixedcost/update/{id}', 'QuotationController@updateFixedCost');
    Route::post('quotation/fixedcost/update/{id}', 'QuotationController@doUpdateFixedCost');
    Route::delete('quotation/fixedcost/{id}', 'QuotationController@deleteFixedCost');
    Route::get('quotation/fixedcost/{id}', 'QuotationController@fixedCost');

    // Variable Cost
    Route::get('quotation/variablecost/create', 'QuotationController@createVariableCost');
    Route::post('quotation/variablecost/create', 'QuotationController@doCreateVariableCost');
    Route::get('quotation/variablecost/update/{id}', 'QuotationController@updateVariableCost');
    Route::post('quotation/variablecost/update/{id}', 'QuotationController@doUpdateVariableCost');
    Route::delete('quotation/variablecost/{id}', 'QuotationController@deleteVariableCost');
    Route::get('quotation/variablecost/{id}', 'QuotationController@variableCost');

    // Other Expenses
    Route::get('quotation/otherexpenses/create', 'QuotationController@createOtherExpenses');
    Route::post('quotation/otherexpenses/create', 'QuotationController@doCreateOtherExpenses');
    Route::get('quotation/otherexpenses/update/{id}', 'QuotationController@updateOtherExpenses');
    Route::post('quotation/otherexpenses/update/{id}', 'QuotationController@doUpdateOtherExpenses');
    Route::delete('quotation/otherexpenses/{id}', 'QuotationController@deleteOtherExpenses');
    Route::get('quotation/otherexpenses/{id}', 'QuotationController@otherExpenses');

    // Land Arrangement
    Route::get('quotation/landarrangement/create', 'QuotationController@createLandArrangement');
    Route::post('quotation/landarrangement/create', 'QuotationController@doCreateLandArrangement');
    Route::get('quotation/landarrangement/update/{id}', 'QuotationController@updateLandArrangement');
    Route::post('quotation/landarrangement/update/{id}', 'QuotationController@doUpdateLandArrangement');
    Route::delete('quotation/landarrangement/{id}', 'QuotationController@deleteLandArrangement');
    Route::get('quotation/landarrangement/{id}', 'QuotationController@landArrangement');

    // Quotation Items
    Route::get('quotation/items', 'QuotationController@index');
    Route::get('quotation/items/create', 'QuotationController@create');
    Route::post('quotation/items/create', 'QuotationController@doCreate');
    Route::get('quotation/items/update/{id}', 'QuotationController@update');
    Route::post('quotation/items/update/{id}', 'QuotationController@doUpdate');
    Route::delete('quotation/items/{id}', 'QuotationController@delete');
    Route::get('quotation/items/{id}', 'QuotationController@get');

    /**
     * CURRENCY
     */
    // Currency
    Route::get('currency', 'CurrencyController@index');
    Route::get('currency/create', 'CurrencyController@create');
    Route::post('currency/create', 'CurrencyController@doCreate');
    Route::get('currency/update/{id}', 'CurrencyController@update');
    Route::post('currency/update/{id}', 'CurrencyController@doUpdate');
    Route::delete('currency/{id}', 'CurrencyController@delete');
    // Route::get('currency/{id}', 'CurrencyController@get');

    // Exchange Rate
    Route::get('exchange-rate', 'CurrencyController@exchangeRate');
    Route::get('exchange-rate/create', 'CurrencyController@createExchangeRate');
    Route::post('exchange-rate/create', 'CurrencyController@doCreateExchangeRate');
    Route::get('exchange-rate/update/{id}', 'CurrencyController@updateExchangeRate');
    Route::post('exchange-rate/update/{id}', 'CurrencyController@doUpdateExchangeRate');
    Route::delete('exchange-rate/{id}', 'CurrencyController@deleteExchangeRate');
    Route::get('exchange-rate/{id}', 'CurrencyController@getExchangeRate');
    Route::get('exchange-rate/search', 'CurrencyController@searchExchangeRate');


    /**
     * HOTEL
     */
    Route::get('hotel', 'HotelController@index');
    Route::get('hotel/create', 'HotelController@create');
    Route::post('hotel/create', 'HotelController@doCreate');
    Route::get('hotel/update/{id}', 'HotelController@update');
    Route::delete('hotel/{id}', 'HotelController@delete');
    Route::post('hotel/update/{id}', 'HotelController@doUpdate');
    // Route::get('hotel/{id}', 'HotelController@get');
    // Route::get('hotel/search', 'HotelController@search');

    // Room Type
    Route::get('hotel/room-type', 'HotelController@roomType');
    Route::get('hotel/room-type/create', 'HotelController@createRoomType');
    Route::post('hotel/room-type/create', 'HotelController@doCreateRoomType');
    Route::get('hotel/room-type/update/{id}', 'HotelController@updateRoomType');
    Route::post('hotel/room-type/update/{id}', 'HotelController@doUpdateRoomType');
    Route::delete('hotel/room-type/{id}', 'HotelController@deleteRoomType');

    /**
     * VISA
     */
    Route::get('visa', 'VisaController@index');
    Route::get('visa/create', 'VisaController@create');
    Route::post('visa/create', 'VisaController@doCreate');
    Route::get('visa/update/{id}', 'VisaController@update');
    Route::delete('visa/{id}', 'VisaController@delete');
    Route::post('visa/update/{id}', 'VisaController@doUpdate');
    Route::get('visa/{id}', 'VisaController@get');
    Route::get('visa/search', 'VisaController@search');

    /**
     * ADMISSION TICKET
     */
    Route::get('admission-ticket', 'AdmissionTicketController@index');
    Route::get('admission-ticket/create', 'AdmissionTicketController@create');
    Route::post('admission-ticket/create', 'AdmissionTicketController@doCreate');
    Route::get('admission-ticket/update/{id}', 'AdmissionTicketController@update');
    Route::delete('admission-ticket/{id}', 'AdmissionTicketController@delete');
    Route::post('admission-ticket/update/{id}', 'AdmissionTicketController@doUpdate');
    Route::get('admission-ticket/{id}', 'AdmissionTicketController@get');
    Route::get('admission-ticket/search', 'AdmissionTicketController@search');


    /**
     * PROFIT
     */
    Route::get('profit', 'ProfitController@index');
    Route::get('profit/create', 'ProfitController@create');
    Route::post('profit/create', 'ProfitController@doCreate');
    Route::get('profit/update/{id}', 'ProfitController@update');
    Route::delete('profit/{id}', 'ProfitController@delete');
    Route::post('profit/update/{id}', 'ProfitController@doUpdate');
    Route::get('profit/{id}', 'ProfitController@get');


    /**
     * INCENTIVE STAFF
     */
    Route::get('incentive-staff', 'IncentiveStaffController@index');
    Route::get('incentive-staff/create', 'IncentiveStaffController@create');
    Route::post('incentive-staff/create', 'IncentiveStaffController@doCreate');
    Route::get('incentive-staff/update/{id}', 'IncentiveStaffController@update');
    Route::delete('incentive-staff/{id}', 'IncentiveStaffController@delete');
    Route::post('incentive-staff/update/{id}', 'IncentiveStaffController@doUpdate');
    Route::get('incentive-staff/{id}', 'IncentiveStaffController@get');


    /**
     * COMMISSION SALES
     */
    Route::get('commission-sales', 'CommissionSalesController@index');
    Route::get('commission-sales/create', 'CommissionSalesController@create');
    Route::post('commission-sales/create', 'CommissionSalesController@doCreate');
    Route::get('commission-sales/update/{id}', 'CommissionSalesController@update');
    Route::delete('commission-sales/{id}', 'CommissionSalesController@delete');
    Route::post('commission-sales/update/{id}', 'CommissionSalesController@doUpdate');
    Route::get('commission-sales/{id}', 'CommissionSalesController@get');

    /**
     * Settings
     */
    Route::get('settings', function(){
        $data['title'] = 'Settings';
        return view('settings', $data);
    });
});