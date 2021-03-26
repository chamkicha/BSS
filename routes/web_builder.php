<?php

/* custom routes generated by CRUD */


Route::group(array('prefix' => 'admin/customer/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.customer.'), function () {

Route::get('customers', ['as'=> 'customers.index', 'uses' => 'Customer\CustomerController@index']);
Route::post('customers', ['as'=> 'customers.store', 'uses' => 'Customer\CustomerController@store']);
Route::get('customers/create', ['as'=> 'customers.create', 'uses' => 'Customer\CustomerController@create']);
Route::put('customers/{customers}', ['as'=> 'customers.update', 'uses' => 'Customer\CustomerController@update']);
Route::patch('customers/{customers}', ['as'=> 'customers.update', 'uses' => 'Customer\CustomerController@update']);
Route::get('customers/{id}/delete', ['as' => 'customers.delete', 'uses' => 'Customer\CustomerController@getDelete']);
Route::get('customers/{id}/confirm-delete', ['as' => 'customers.confirm-delete', 'uses' => 'Customer\CustomerController@getModalDelete']);
Route::get('customers/{customers}', ['as'=> 'customers.show', 'uses' => 'Customer\CustomerController@show']);
Route::get('customers/{customers}/edit', ['as'=> 'customers.edit', 'uses' => 'Customer\CustomerController@edit']);

});


Route::group(array('prefix' => 'admin/cusromerType/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.cusromerType.'), function () {

Route::get('customertypes', ['as'=> 'customertypes.index', 'uses' => 'Cusromer_Type\CustomertypeController@index']);
Route::post('customertypes', ['as'=> 'customertypes.store', 'uses' => 'Cusromer_Type\CustomertypeController@store']);
Route::get('customertypes/create', ['as'=> 'customertypes.create', 'uses' => 'Cusromer_Type\CustomertypeController@create']);
Route::put('customertypes/{customertypes}', ['as'=> 'customertypes.update', 'uses' => 'Cusromer_Type\CustomertypeController@update']);
Route::patch('customertypes/{customertypes}', ['as'=> 'customertypes.update', 'uses' => 'Cusromer_Type\CustomertypeController@update']);
Route::get('customertypes/{id}/delete', ['as' => 'customertypes.delete', 'uses' => 'Cusromer_Type\CustomertypeController@getDelete']);
Route::get('customertypes/{id}/confirm-delete', ['as' => 'customertypes.confirm-delete', 'uses' => 'Cusromer_Type\CustomertypeController@getModalDelete']);
Route::get('customertypes/{customertypes}', ['as'=> 'customertypes.show', 'uses' => 'Cusromer_Type\CustomertypeController@show']);
Route::get('customertypes/{customertypes}/edit', ['as'=> 'customertypes.edit', 'uses' => 'Cusromer_Type\CustomertypeController@edit']);

});


Route::group(array('prefix' => 'admin/customer/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.customer.'), function () {

Route::get('customers', ['as'=> 'customers.index', 'uses' => 'Customer\CustomerController@index']);
Route::post('customers', ['as'=> 'customers.store', 'uses' => 'Customer\CustomerController@store']);
Route::get('customers/create', ['as'=> 'customers.create', 'uses' => 'Customer\CustomerController@create']);
Route::put('customers/{customers}', ['as'=> 'customers.update', 'uses' => 'Customer\CustomerController@update']);
Route::patch('customers/{customers}', ['as'=> 'customers.update', 'uses' => 'Customer\CustomerController@update']);
Route::get('customers/{id}/delete', ['as' => 'customers.delete', 'uses' => 'Customer\CustomerController@getDelete']);
Route::get('customers/{id}/confirm-delete', ['as' => 'customers.confirm-delete', 'uses' => 'Customer\CustomerController@getModalDelete']);
Route::get('customers/{customers}', ['as'=> 'customers.show', 'uses' => 'Customer\CustomerController@show']);
Route::get('customers/{customers}/edit', ['as'=> 'customers.edit', 'uses' => 'Customer\CustomerController@edit']);

});


Route::group(array('prefix' => 'admin/product/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.product.'), function () {

Route::get('products', ['as'=> 'products.index', 'uses' => 'Product\ProductController@index']);
Route::post('products', ['as'=> 'products.store', 'uses' => 'Product\ProductController@store']);
Route::get('products/create', ['as'=> 'products.create', 'uses' => 'Product\ProductController@create']);
Route::put('products/{products}', ['as'=> 'products.update', 'uses' => 'Product\ProductController@update']);
Route::patch('products/{products}', ['as'=> 'products.update', 'uses' => 'Product\ProductController@update']);
Route::get('products/{id}/delete', ['as' => 'products.delete', 'uses' => 'Product\ProductController@getDelete']);
Route::get('products/{id}/confirm-delete', ['as' => 'products.confirm-delete', 'uses' => 'Product\ProductController@getModalDelete']);
Route::get('products/{products}', ['as'=> 'products.show', 'uses' => 'Product\ProductController@show']);
Route::get('products/{products}/edit', ['as'=> 'products.edit', 'uses' => 'Product\ProductController@edit']);

});


Route::group(array('prefix' => 'admin/productType/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.productType.'), function () {

Route::get('productTypes', ['as'=> 'productTypes.index', 'uses' => 'Product Type\ProductTypeController@index']);
Route::post('productTypes', ['as'=> 'productTypes.store', 'uses' => 'Product Type\ProductTypeController@store']);
Route::get('productTypes/create', ['as'=> 'productTypes.create', 'uses' => 'Product Type\ProductTypeController@create']);
Route::put('productTypes/{productTypes}', ['as'=> 'productTypes.update', 'uses' => 'Product Type\ProductTypeController@update']);
Route::patch('productTypes/{productTypes}', ['as'=> 'productTypes.update', 'uses' => 'Product Type\ProductTypeController@update']);
Route::get('productTypes/{id}/delete', ['as' => 'productTypes.delete', 'uses' => 'Product Type\ProductTypeController@getDelete']);
Route::get('productTypes/{id}/confirm-delete', ['as' => 'productTypes.confirm-delete', 'uses' => 'Product Type\ProductTypeController@getModalDelete']);
Route::get('productTypes/{productTypes}', ['as'=> 'productTypes.show', 'uses' => 'Product Type\ProductTypeController@show']);
Route::get('productTypes/{productTypes}/edit', ['as'=> 'productTypes.edit', 'uses' => 'Product Type\ProductTypeController@edit']);

});


Route::group(array('prefix' => 'admin/productType/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.productType.'), function () {

Route::get('productTypes', ['as'=> 'productTypes.index', 'uses' => 'Product Type\Product TypeController@index']);
Route::post('productTypes', ['as'=> 'productTypes.store', 'uses' => 'Product Type\Product TypeController@store']);
Route::get('productTypes/create', ['as'=> 'productTypes.create', 'uses' => 'Product Type\Product TypeController@create']);
Route::put('productTypes/{productTypes}', ['as'=> 'productTypes.update', 'uses' => 'Product Type\Product TypeController@update']);
Route::patch('productTypes/{productTypes}', ['as'=> 'productTypes.update', 'uses' => 'Product Type\Product TypeController@update']);
Route::get('productTypes/{id}/delete', ['as' => 'productTypes.delete', 'uses' => 'Product Type\Product TypeController@getDelete']);
Route::get('productTypes/{id}/confirm-delete', ['as' => 'productTypes.confirm-delete', 'uses' => 'Product Type\Product TypeController@getModalDelete']);
Route::get('productTypes/{productTypes}', ['as'=> 'productTypes.show', 'uses' => 'Product Type\Product TypeController@show']);
Route::get('productTypes/{productTypes}/edit', ['as'=> 'productTypes.edit', 'uses' => 'Product Type\Product TypeController@edit']);

});


Route::group(array('prefix' => 'admin/productType/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.productType.'), function () {

Route::get('productTypes', ['as'=> 'productTypes.index', 'uses' => 'Product Type\Product TypeController@index']);
Route::post('productTypes', ['as'=> 'productTypes.store', 'uses' => 'Product Type\Product TypeController@store']);
Route::get('productTypes/create', ['as'=> 'productTypes.create', 'uses' => 'Product Type\Product TypeController@create']);
Route::put('productTypes/{productTypes}', ['as'=> 'productTypes.update', 'uses' => 'Product Type\Product TypeController@update']);
Route::patch('productTypes/{productTypes}', ['as'=> 'productTypes.update', 'uses' => 'Product Type\Product TypeController@update']);
Route::get('productTypes/{id}/delete', ['as' => 'productTypes.delete', 'uses' => 'Product Type\Product TypeController@getDelete']);
Route::get('productTypes/{id}/confirm-delete', ['as' => 'productTypes.confirm-delete', 'uses' => 'Product Type\Product TypeController@getModalDelete']);
Route::get('productTypes/{productTypes}', ['as'=> 'productTypes.show', 'uses' => 'Product Type\Product TypeController@show']);
Route::get('productTypes/{productTypes}/edit', ['as'=> 'productTypes.edit', 'uses' => 'Product Type\Product TypeController@edit']);

});


Route::group(array('prefix' => 'admin/productType/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.productType.'), function () {

Route::get('productTypes', ['as'=> 'productTypes.index', 'uses' => 'Product Type\Product TypeController@index']);
Route::post('productTypes', ['as'=> 'productTypes.store', 'uses' => 'Product Type\Product TypeController@store']);
Route::get('productTypes/create', ['as'=> 'productTypes.create', 'uses' => 'Product Type\Product TypeController@create']);
Route::put('productTypes/{productTypes}', ['as'=> 'productTypes.update', 'uses' => 'Product Type\Product TypeController@update']);
Route::patch('productTypes/{productTypes}', ['as'=> 'productTypes.update', 'uses' => 'Product Type\Product TypeController@update']);
Route::get('productTypes/{id}/delete', ['as' => 'productTypes.delete', 'uses' => 'Product Type\Product TypeController@getDelete']);
Route::get('productTypes/{id}/confirm-delete', ['as' => 'productTypes.confirm-delete', 'uses' => 'Product Type\Product TypeController@getModalDelete']);
Route::get('productTypes/{productTypes}', ['as'=> 'productTypes.show', 'uses' => 'Product Type\Product TypeController@show']);
Route::get('productTypes/{productTypes}/edit', ['as'=> 'productTypes.edit', 'uses' => 'Product Type\Product TypeController@edit']);

});


Route::group(array('prefix' => 'admin/productTypeName/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.productTypeName.'), function () {

Route::get('productTypes', ['as'=> 'productTypes.index', 'uses' => 'Product Type Name\Product TypesController@index']);
Route::post('productTypes', ['as'=> 'productTypes.store', 'uses' => 'Product Type Name\Product TypesController@store']);
Route::get('productTypes/create', ['as'=> 'productTypes.create', 'uses' => 'Product Type Name\Product TypesController@create']);
Route::put('productTypes/{productTypes}', ['as'=> 'productTypes.update', 'uses' => 'Product Type Name\Product TypesController@update']);
Route::patch('productTypes/{productTypes}', ['as'=> 'productTypes.update', 'uses' => 'Product Type Name\Product TypesController@update']);
Route::get('productTypes/{id}/delete', ['as' => 'productTypes.delete', 'uses' => 'Product Type Name\Product TypesController@getDelete']);
Route::get('productTypes/{id}/confirm-delete', ['as' => 'productTypes.confirm-delete', 'uses' => 'Product Type Name\Product TypesController@getModalDelete']);
Route::get('productTypes/{productTypes}', ['as'=> 'productTypes.show', 'uses' => 'Product Type Name\Product TypesController@show']);
Route::get('productTypes/{productTypes}/edit', ['as'=> 'productTypes.edit', 'uses' => 'Product Type Name\Product TypesController@edit']);

});


Route::group(array('prefix' => 'admin/productTypeName/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.productTypeName.'), function () {

Route::get('productTypes', ['as'=> 'productTypes.index', 'uses' => 'Product Type Name\Product TypesController@index']);
Route::post('productTypes', ['as'=> 'productTypes.store', 'uses' => 'Product Type Name\Product TypesController@store']);
Route::get('productTypes/create', ['as'=> 'productTypes.create', 'uses' => 'Product Type Name\Product TypesController@create']);
Route::put('productTypes/{productTypes}', ['as'=> 'productTypes.update', 'uses' => 'Product Type Name\Product TypesController@update']);
Route::patch('productTypes/{productTypes}', ['as'=> 'productTypes.update', 'uses' => 'Product Type Name\Product TypesController@update']);
Route::get('productTypes/{id}/delete', ['as' => 'productTypes.delete', 'uses' => 'Product Type Name\Product TypesController@getDelete']);
Route::get('productTypes/{id}/confirm-delete', ['as' => 'productTypes.confirm-delete', 'uses' => 'Product Type Name\Product TypesController@getModalDelete']);
Route::get('productTypes/{productTypes}', ['as'=> 'productTypes.show', 'uses' => 'Product Type Name\Product TypesController@show']);
Route::get('productTypes/{productTypes}/edit', ['as'=> 'productTypes.edit', 'uses' => 'Product Type Name\Product TypesController@edit']);

});


Route::group(array('prefix' => 'admin/serviceOrder/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.serviceOrder.'), function () {

Route::get('serviceOrders', ['as'=> 'serviceOrders.index', 'uses' => 'Service Order\Service OrderController@index']);
Route::post('serviceOrders', ['as'=> 'serviceOrders.store', 'uses' => 'Service Order\Service OrderController@store']);
Route::get('serviceOrders/create', ['as'=> 'serviceOrders.create', 'uses' => 'Service Order\Service OrderController@create']);
Route::put('serviceOrders/{serviceOrders}', ['as'=> 'serviceOrders.update', 'uses' => 'Service Order\Service OrderController@update']);
Route::patch('serviceOrders/{serviceOrders}', ['as'=> 'serviceOrders.update', 'uses' => 'Service Order\Service OrderController@update']);
Route::get('serviceOrders/{id}/delete', ['as' => 'serviceOrders.delete', 'uses' => 'Service Order\Service OrderController@getDelete']);
Route::get('serviceOrders/{id}/confirm-delete', ['as' => 'serviceOrders.confirm-delete', 'uses' => 'Service Order\Service OrderController@getModalDelete']);
Route::get('serviceOrders/{serviceOrders}', ['as'=> 'serviceOrders.show', 'uses' => 'Service Order\Service OrderController@show']);
Route::get('serviceOrders/{serviceOrders}/edit', ['as'=> 'serviceOrders.edit', 'uses' => 'Service Order\Service OrderController@edit']);

});


Route::group(array('prefix' => 'admin/serviceOrders/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.serviceOrders.'), function () {

Route::get('serviceOrders', ['as'=> 'serviceOrders.index', 'uses' => 'Service Orders\ServiceOrdersController@index']);
Route::post('serviceOrders', ['as'=> 'serviceOrders.store', 'uses' => 'Service Orders\ServiceOrdersController@store']);
Route::get('serviceOrders/create', ['as'=> 'serviceOrders.create', 'uses' => 'Service Orders\ServiceOrdersController@create']);
Route::put('serviceOrders/{serviceOrders}', ['as'=> 'serviceOrders.update', 'uses' => 'Service Orders\ServiceOrdersController@update']);
Route::patch('serviceOrders/{serviceOrders}', ['as'=> 'serviceOrders.update', 'uses' => 'Service Orders\ServiceOrdersController@update']);
Route::get('serviceOrders/{id}/delete', ['as' => 'serviceOrders.delete', 'uses' => 'Service Orders\ServiceOrdersController@getDelete']);
Route::get('serviceOrders/{id}/confirm-delete', ['as' => 'serviceOrders.confirm-delete', 'uses' => 'Service Orders\ServiceOrdersController@getModalDelete']);
Route::get('serviceOrders/{serviceOrders}', ['as'=> 'serviceOrders.show', 'uses' => 'Service Orders\ServiceOrdersController@show']);
Route::get('serviceOrders/{serviceOrders}/edit', ['as'=> 'serviceOrders.edit', 'uses' => 'Service Orders\ServiceOrdersController@edit']);

});


Route::group(array('prefix' => 'admin/serviceOrders/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.serviceOrders.'), function () {

Route::get('serviceOrders', ['as'=> 'serviceOrders.index', 'uses' => 'Serviceorders\ServiceOrdersController@index']);
Route::post('serviceOrders', ['as'=> 'serviceOrders.store', 'uses' => 'Serviceorders\ServiceOrdersController@store']);
Route::get('serviceOrders/create', ['as'=> 'serviceOrders.create', 'uses' => 'Serviceorders\ServiceOrdersController@create']);
Route::put('serviceOrders/{serviceOrders}', ['as'=> 'serviceOrders.update', 'uses' => 'Serviceorders\ServiceOrdersController@update']);
Route::patch('serviceOrders/{serviceOrders}', ['as'=> 'serviceOrders.update', 'uses' => 'Serviceorders\ServiceOrdersController@update']);
Route::get('serviceOrders/{id}/delete', ['as' => 'serviceOrders.delete', 'uses' => 'Serviceorders\ServiceOrdersController@getDelete']);
Route::get('serviceOrders/{id}/confirm-delete', ['as' => 'serviceOrders.confirm-delete', 'uses' => 'Serviceorders\ServiceOrdersController@getModalDelete']);
Route::get('serviceOrders/{serviceOrders}', ['as'=> 'serviceOrders.show', 'uses' => 'Serviceorders\ServiceOrdersController@show']);
Route::get('serviceOrders/{serviceOrders}/edit', ['as'=> 'serviceOrders.edit', 'uses' => 'Serviceorders\ServiceOrdersController@edit']);

});


Route::group(array('prefix' => 'admin/productType/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.productType.'), function () {

Route::get('productTypes', ['as'=> 'productTypes.index', 'uses' => 'Producttype\ProductTypeController@index']);
Route::post('productTypes', ['as'=> 'productTypes.store', 'uses' => 'Producttype\ProductTypeController@store']);
Route::get('productTypes/create', ['as'=> 'productTypes.create', 'uses' => 'Producttype\ProductTypeController@create']);
Route::put('productTypes/{productTypes}', ['as'=> 'productTypes.update', 'uses' => 'Producttype\ProductTypeController@update']);
Route::patch('productTypes/{productTypes}', ['as'=> 'productTypes.update', 'uses' => 'Producttype\ProductTypeController@update']);
Route::get('productTypes/{id}/delete', ['as' => 'productTypes.delete', 'uses' => 'Producttype\ProductTypeController@getDelete']);
Route::get('productTypes/{id}/confirm-delete', ['as' => 'productTypes.confirm-delete', 'uses' => 'Producttype\ProductTypeController@getModalDelete']);
Route::get('productTypes/{productTypes}', ['as'=> 'productTypes.show', 'uses' => 'Producttype\ProductTypeController@show']);
Route::get('productTypes/{productTypes}/edit', ['as'=> 'productTypes.edit', 'uses' => 'Producttype\ProductTypeController@edit']);

});


Route::group(array('prefix' => 'admin/paymentMode/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.paymentMode.'), function () {

Route::get('paymentModes', ['as'=> 'paymentModes.index', 'uses' => 'Paymentmode\PaymentModeController@index']);
Route::post('paymentModes', ['as'=> 'paymentModes.store', 'uses' => 'Paymentmode\PaymentModeController@store']);
Route::get('paymentModes/create', ['as'=> 'paymentModes.create', 'uses' => 'Paymentmode\PaymentModeController@create']);
Route::put('paymentModes/{paymentModes}', ['as'=> 'paymentModes.update', 'uses' => 'Paymentmode\PaymentModeController@update']);
Route::patch('paymentModes/{paymentModes}', ['as'=> 'paymentModes.update', 'uses' => 'Paymentmode\PaymentModeController@update']);
Route::get('paymentModes/{id}/delete', ['as' => 'paymentModes.delete', 'uses' => 'Paymentmode\PaymentModeController@getDelete']);
Route::get('paymentModes/{id}/confirm-delete', ['as' => 'paymentModes.confirm-delete', 'uses' => 'Paymentmode\PaymentModeController@getModalDelete']);
Route::get('paymentModes/{paymentModes}', ['as'=> 'paymentModes.show', 'uses' => 'Paymentmode\PaymentModeController@show']);
Route::get('paymentModes/{paymentModes}/edit', ['as'=> 'paymentModes.edit', 'uses' => 'Paymentmode\PaymentModeController@edit']);

});


Route::group(array('prefix' => 'admin/unitofMeasure/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.unitofMeasure.'), function () {

Route::get('unitofMeasures', ['as'=> 'unitofMeasures.index', 'uses' => 'Unitofmeasure\UnitofMeasureController@index']);
Route::post('unitofMeasures', ['as'=> 'unitofMeasures.store', 'uses' => 'Unitofmeasure\UnitofMeasureController@store']);
Route::get('unitofMeasures/create', ['as'=> 'unitofMeasures.create', 'uses' => 'Unitofmeasure\UnitofMeasureController@create']);
Route::put('unitofMeasures/{unitofMeasures}', ['as'=> 'unitofMeasures.update', 'uses' => 'Unitofmeasure\UnitofMeasureController@update']);
Route::patch('unitofMeasures/{unitofMeasures}', ['as'=> 'unitofMeasures.update', 'uses' => 'Unitofmeasure\UnitofMeasureController@update']);
Route::get('unitofMeasures/{id}/delete', ['as' => 'unitofMeasures.delete', 'uses' => 'Unitofmeasure\UnitofMeasureController@getDelete']);
Route::get('unitofMeasures/{id}/confirm-delete', ['as' => 'unitofMeasures.confirm-delete', 'uses' => 'Unitofmeasure\UnitofMeasureController@getModalDelete']);
Route::get('unitofMeasures/{unitofMeasures}', ['as'=> 'unitofMeasures.show', 'uses' => 'Unitofmeasure\UnitofMeasureController@show']);
Route::get('unitofMeasures/{unitofMeasures}/edit', ['as'=> 'unitofMeasures.edit', 'uses' => 'Unitofmeasure\UnitofMeasureController@edit']);

});


Route::group(array('prefix' => 'admin/customerType/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.customerType.'), function () {

Route::get('customerTypes', ['as'=> 'customerTypes.index', 'uses' => 'Customertype\CustomerTypeController@index']);
Route::post('customerTypes', ['as'=> 'customerTypes.store', 'uses' => 'Customertype\CustomerTypeController@store']);
Route::get('customerTypes/create', ['as'=> 'customerTypes.create', 'uses' => 'Customertype\CustomerTypeController@create']);
Route::put('customerTypes/{customerTypes}', ['as'=> 'customerTypes.update', 'uses' => 'Customertype\CustomerTypeController@update']);
Route::patch('customerTypes/{customerTypes}', ['as'=> 'customerTypes.update', 'uses' => 'Customertype\CustomerTypeController@update']);
Route::get('customerTypes/{id}/delete', ['as' => 'customerTypes.delete', 'uses' => 'Customertype\CustomerTypeController@getDelete']);
Route::get('customerTypes/{id}/confirm-delete', ['as' => 'customerTypes.confirm-delete', 'uses' => 'Customertype\CustomerTypeController@getModalDelete']);
Route::get('customerTypes/{customerTypes}', ['as'=> 'customerTypes.show', 'uses' => 'Customertype\CustomerTypeController@show']);
Route::get('customerTypes/{customerTypes}/edit', ['as'=> 'customerTypes.edit', 'uses' => 'Customertype\CustomerTypeController@edit']);

});


Route::group(array('prefix' => 'admin/paymentMode/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.paymentMode.'), function () {

Route::get('paymentModes', ['as'=> 'paymentModes.index', 'uses' => 'Paymentmode\PaymentModeController@index']);
Route::post('paymentModes', ['as'=> 'paymentModes.store', 'uses' => 'Paymentmode\PaymentModeController@store']);
Route::get('paymentModes/create', ['as'=> 'paymentModes.create', 'uses' => 'Paymentmode\PaymentModeController@create']);
Route::put('paymentModes/{paymentModes}', ['as'=> 'paymentModes.update', 'uses' => 'Paymentmode\PaymentModeController@update']);
Route::patch('paymentModes/{paymentModes}', ['as'=> 'paymentModes.update', 'uses' => 'Paymentmode\PaymentModeController@update']);
Route::get('paymentModes/{id}/delete', ['as' => 'paymentModes.delete', 'uses' => 'Paymentmode\PaymentModeController@getDelete']);
Route::get('paymentModes/{id}/confirm-delete', ['as' => 'paymentModes.confirm-delete', 'uses' => 'Paymentmode\PaymentModeController@getModalDelete']);
Route::get('paymentModes/{paymentModes}', ['as'=> 'paymentModes.show', 'uses' => 'Paymentmode\PaymentModeController@show']);
Route::get('paymentModes/{paymentModes}/edit', ['as'=> 'paymentModes.edit', 'uses' => 'Paymentmode\PaymentModeController@edit']);

});


Route::group(array('prefix' => 'admin/servicestatus/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.servicestatus.'), function () {

Route::get('servicestatuses', ['as'=> 'servicestatuses.index', 'uses' => 'Servicestatus\ServicestatusController@index']);
Route::post('servicestatuses', ['as'=> 'servicestatuses.store', 'uses' => 'Servicestatus\ServicestatusController@store']);
Route::get('servicestatuses/create', ['as'=> 'servicestatuses.create', 'uses' => 'Servicestatus\ServicestatusController@create']);
Route::put('servicestatuses/{servicestatuses}', ['as'=> 'servicestatuses.update', 'uses' => 'Servicestatus\ServicestatusController@update']);
Route::patch('servicestatuses/{servicestatuses}', ['as'=> 'servicestatuses.update', 'uses' => 'Servicestatus\ServicestatusController@update']);
Route::get('servicestatuses/{id}/delete', ['as' => 'servicestatuses.delete', 'uses' => 'Servicestatus\ServicestatusController@getDelete']);
Route::get('servicestatuses/{id}/confirm-delete', ['as' => 'servicestatuses.confirm-delete', 'uses' => 'Servicestatus\ServicestatusController@getModalDelete']);
Route::get('servicestatuses/{servicestatuses}', ['as'=> 'servicestatuses.show', 'uses' => 'Servicestatus\ServicestatusController@show']);
Route::get('servicestatuses/{servicestatuses}/edit', ['as'=> 'servicestatuses.edit', 'uses' => 'Servicestatus\ServicestatusController@edit']);

});


Route::group(array('prefix' => 'admin/serviceBilling/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.serviceBilling.'), function () {

Route::get('serviceBillings', ['as'=> 'serviceBillings.index', 'uses' => 'Servicebilling\ServiceBillingController@index']);
Route::post('serviceBillings', ['as'=> 'serviceBillings.store', 'uses' => 'Servicebilling\ServiceBillingController@store']);
Route::get('serviceBillings/create', ['as'=> 'serviceBillings.create', 'uses' => 'Servicebilling\ServiceBillingController@create']);
Route::put('serviceBillings/{serviceBillings}', ['as'=> 'serviceBillings.update', 'uses' => 'Servicebilling\ServiceBillingController@update']);
Route::patch('serviceBillings/{serviceBillings}', ['as'=> 'serviceBillings.update', 'uses' => 'Servicebilling\ServiceBillingController@update']);
Route::get('serviceBillings/{id}/delete', ['as' => 'serviceBillings.delete', 'uses' => 'Servicebilling\ServiceBillingController@getDelete']);
Route::get('serviceBillings/{id}/confirm-delete', ['as' => 'serviceBillings.confirm-delete', 'uses' => 'Servicebilling\ServiceBillingController@getModalDelete']);
Route::get('serviceBillings/{serviceBillings}', ['as'=> 'serviceBillings.show', 'uses' => 'Servicebilling\ServiceBillingController@show']);
Route::get('serviceBillings/{serviceBillings}/edit', ['as'=> 'serviceBillings.edit', 'uses' => 'Servicebilling\ServiceBillingController@edit']);

});


Route::group(array('prefix' => 'admin/serviceInvoice/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.serviceInvoice.'), function () {

Route::get('serviceInvoices', ['as'=> 'serviceInvoices.index', 'uses' => 'Serviceinvoice\ServiceInvoiceController@index']);
Route::post('serviceInvoices', ['as'=> 'serviceInvoices.store', 'uses' => 'Serviceinvoice\ServiceInvoiceController@store']);
Route::get('serviceInvoices/create', ['as'=> 'serviceInvoices.create', 'uses' => 'Serviceinvoice\ServiceInvoiceController@create']);
Route::put('serviceInvoices/{serviceInvoices}', ['as'=> 'serviceInvoices.update', 'uses' => 'Serviceinvoice\ServiceInvoiceController@update']);
Route::patch('serviceInvoices/{serviceInvoices}', ['as'=> 'serviceInvoices.update', 'uses' => 'Serviceinvoice\ServiceInvoiceController@update']);
Route::get('serviceInvoices/{id}/delete', ['as' => 'serviceInvoices.delete', 'uses' => 'Serviceinvoice\ServiceInvoiceController@getDelete']);
Route::get('serviceInvoices/{id}/confirm-delete', ['as' => 'serviceInvoices.confirm-delete', 'uses' => 'Serviceinvoice\ServiceInvoiceController@getModalDelete']);
Route::get('serviceInvoices/{serviceInvoices}', ['as'=> 'serviceInvoices.show', 'uses' => 'Serviceinvoice\ServiceInvoiceController@show']);
Route::get('serviceInvoices/{serviceInvoices}/edit', ['as'=> 'serviceInvoices.edit', 'uses' => 'Serviceinvoice\ServiceInvoiceController@edit']);

});


Route::group(array('prefix' => 'admin/paymentType/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.paymentType.'), function () {

Route::get('paymentTypes', ['as'=> 'paymentTypes.index', 'uses' => 'Paymenttype\PaymentTypeController@index']);
Route::post('paymentTypes', ['as'=> 'paymentTypes.store', 'uses' => 'Paymenttype\PaymentTypeController@store']);
Route::get('paymentTypes/create', ['as'=> 'paymentTypes.create', 'uses' => 'Paymenttype\PaymentTypeController@create']);
Route::put('paymentTypes/{paymentTypes}', ['as'=> 'paymentTypes.update', 'uses' => 'Paymenttype\PaymentTypeController@update']);
Route::patch('paymentTypes/{paymentTypes}', ['as'=> 'paymentTypes.update', 'uses' => 'Paymenttype\PaymentTypeController@update']);
Route::get('paymentTypes/{id}/delete', ['as' => 'paymentTypes.delete', 'uses' => 'Paymenttype\PaymentTypeController@getDelete']);
Route::get('paymentTypes/{id}/confirm-delete', ['as' => 'paymentTypes.confirm-delete', 'uses' => 'Paymenttype\PaymentTypeController@getModalDelete']);
Route::get('paymentTypes/{paymentTypes}', ['as'=> 'paymentTypes.show', 'uses' => 'Paymenttype\PaymentTypeController@show']);
Route::get('paymentTypes/{paymentTypes}/edit', ['as'=> 'paymentTypes.edit', 'uses' => 'Paymenttype\PaymentTypeController@edit']);

});


Route::group(array('prefix' => 'admin/paymentAndDue/','namespace' => 'Admin','middleware' => 'admin','as'=>'admin.paymentAndDue.'), function () {

Route::get('paymentAndDues', ['as'=> 'paymentAndDues.index', 'uses' => 'Paymentanddue\PaymentAndDueController@index']);
Route::post('paymentAndDues', ['as'=> 'paymentAndDues.store', 'uses' => 'Paymentanddue\PaymentAndDueController@store']);
Route::get('paymentAndDues/create', ['as'=> 'paymentAndDues.create', 'uses' => 'Paymentanddue\PaymentAndDueController@create']);
Route::put('paymentAndDues/{paymentAndDues}', ['as'=> 'paymentAndDues.update', 'uses' => 'Paymentanddue\PaymentAndDueController@update']);
Route::patch('paymentAndDues/{paymentAndDues}', ['as'=> 'paymentAndDues.update', 'uses' => 'Paymentanddue\PaymentAndDueController@update']);
Route::get('paymentAndDues/{id}/delete', ['as' => 'paymentAndDues.delete', 'uses' => 'Paymentanddue\PaymentAndDueController@getDelete']);
Route::get('paymentAndDues/{id}/confirm-delete', ['as' => 'paymentAndDues.confirm-delete', 'uses' => 'Paymentanddue\PaymentAndDueController@getModalDelete']);
Route::get('paymentAndDues/{paymentAndDues}', ['as'=> 'paymentAndDues.show', 'uses' => 'Paymentanddue\PaymentAndDueController@show']);
Route::get('paymentAndDues/{paymentAndDues}/edit', ['as'=> 'paymentAndDues.edit', 'uses' => 'Paymentanddue\PaymentAndDueController@edit']);

});
