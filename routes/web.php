<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Purchase Route Start
Route::GROUP(['prefix' => 'purchase', 'as' => 'purchase.','middleware'=>['auth']],function(){
    Route::GET('/create',[
        'uses'      => 'PurchaseController@create',
        'as'        => 'create'
    ]);
});


// Purchase Route End



// Product Route Start 
Route::GROUP(['prefix'=>'product', 'as'=>'product.', 'middleware'=>['auth'] ],function(){
    // Product Route Start
    Route::GROUP(['prefix' => 'product', 'as' => 'product.'],function(){
        Route::GET('/list',[
            'uses'   => 'ProductController@index',
            'as'     => 'list'
        ]);
        Route::GET('/add',[
            'uses'   => 'ProductController@create',
            'as'     => 'add'
        ]);
        Route::POST('/store',[
            'uses'   => 'ProductController@store',
            'as'     => 'store'
        ]);
        Route::GET('/edit',[
            'uses'   => 'ProductController@edit',
            'as'     => 'edit'
        ]);
        Route::POST('/update',[
            'uses'   => 'ProductController@update',
            'as'     => 'update'
        ]);
        Route::GET('/destroy',[
            'uses'   => 'ProductController@destroy',
            'as'     => 'destroy'
        ]);
    });

    // Product Route End
    // Product Category Route Start
    Route::GROUP(['prefix'=>'category', 'as'=>'category.'],function(){
        Route::GET('/list', [
            'uses'  =>'CategoryController@index',
            'as'    =>'list'
        ]);
        Route::POST('/store',[
            'uses'  => 'CategoryController@store',
            'as'    => 'store'
        ]);
        Route::GET('/destroy',[
            'uses'  => 'CategoryController@destroy',
            'as'    => 'destroy'
        ]);
        Route::POST('update',[
            'uses'  => 'CategoryController@update',
            'as'    => 'update'
        ]);
    });
    // Product Category Route End
    // Product Brand Route Start
    Route::GROUP(['prefix' => 'brand', 'as' => 'brand.'],function(){
        Route::GET('/list',[
            'uses'   => 'BrandController@index',
            'as'     => 'list'
        ]);
        Route::POST('/store',[
            'uses'  => 'BrandController@store',
            'as'    => 'store'
        ]);
        Route::POST('/update',[
            'uses'  => 'BrandController@update',
            'as'    => 'update'
        ]);
        Route::GET('/destroy',[
            'uses'  => 'BrandController@destroy',
            'as'    => 'destroy'
        ]);
    });

    // Product Payment Method Route Start
    Route::GROUP(['prefix' => 'payment-method','as' => 'payment-method.'],function(){
        Route::GET('/list',[
            'uses'  => 'PaymentMethodController@index',
            'as'    => 'list' 
        ]);
        Route::POST('/store',[
            'uses'  => 'PaymentMethodController@store',
            'as'    => 'store'
        ]);
        Route::POST('/update',[
            'uses'  => 'PaymentMethodController@update',
            'as'    => 'update'
        ]);
        Route::GET('/destroy',[
            'uses' => 'PaymentMethodController@destroy',
            'as'   => 'destroy'
        ]);
    });

    // Product Attribute Route Start
    Route::GROUP(['prefix' => 'attribute','as' => 'attribute.'],function(){
        Route::GET('/list',[
            'uses'  => 'ProductAttributeController@index',
            'as'    => 'list'
        ]);
        Route::POST('/store',[
            'uses'  => 'ProductAttributeController@store',
            'as'    => 'store'
        ]);
        Route::POST('/update',[
            'uses'  => 'ProductAttributeController@update',
            'as'    => 'update'
        ]);
        Route::GET('/destroy',[
            'uses' => 'ProductAttributeController@destroy',
            'as'   => 'destroy'
        ]);
        Route::GET('/edit',[
            'uses' => 'ProductAttributeController@edit',
            'as'   => 'edit'
        ]);
    });
});

// Regsiter Route Start

Route::GROUP(['prefix'=>'register', 'as'=>'register.', 'middleware'=>['auth'] ],function(){

    Route::GROUP(['prefix' => 'organization','as' => 'organization.'],function(){
        Route::GET('/list',[
            'uses'     => 'OrganizationController@index',
            'as'      => 'list'
        ]);
        Route::POST('/store',[
            'uses'     => 'OrganizationController@store',
            'as'      => 'store'
        ]);
        Route::POST('/update',[
            'uses'  => 'OrganizationController@update',
            'as'    => 'update'
        ]);
        Route::GET('/edit',[
            'uses'   => 'OrganizationController@edit',
            'as'     => 'edit'
        ]);
        Route::GET('/destroy',[
            'uses'  => 'OrganizationController@destroy',
            'as'    => 'destroy'
        ]);
        Route::GET('/show',[
            'uses'   => 'OrganizationController@show',
            'as'     => 'show'
        ]);
    });

    Route::GROUP(['prefix' => 'supplier', 'as' => 'supplier.'],function(){
        // Supplier Type Route Start
        Route::GROUP(['prefix' => 'supplier-type', 'as' => 'supplier-type.'],function(){
            Route::GET('/list',[
                'uses'   => 'SupplierTypeController@index',
                'as'     => 'list'
            ]);
            Route::POST('/store',[
                'uses'  => 'SupplierTypeController@store',
                'as'    => 'store'
            ]);
            Route::POST('/update',[
                'uses'  => 'SupplierTypeController@update',
                'as'    => 'update'
            ]);
            Route::GET('/destroy',[
                'uses'  => 'SupplierTypeController@destroy',
                'as'    => 'destroy'
            ]);
        });
        // Supplier Type Route End
        Route::GET('/list',[
            'uses'   => 'SupplierController@index',
            'as'     => 'list'
        ]);
        Route::POST('/store',[
            'uses'   => 'SupplierController@store',
            'as'     => 'store'
        ]);
        Route::GET('/edit',[
            'uses'   => 'SupplierController@edit',
            'as'     => 'edit'
        ]);
        Route::POST('/update',[
            'uses'   => 'SupplierController@update',
            'as'     => 'update'
        ]);
        Route::GET('/destroy',[
            'uses'   => 'SupplierController@destroy',
            'as'     => 'destroy'
        ]);
        Route::GET('/show',[
            'uses'   => 'SupplierController@show',
            'as'     => 'show'
        ]);
    });
    // Reference Route Start
    Route::GROUP(['prefix' => 'reference','as' => 'reference.'],function(){
        Route::GET('/list',[
            'uses'   => 'ReferenceController@index',
            'as'     => 'list'
        ]);
        Route::POST('/store',[
            'uses'   => 'ReferenceController@store',
            'as'     => 'store'
        ]);
        Route::GET('/edit',[
            'uses'   => 'ReferenceController@edit',
            'as'     => 'edit'
        ]);
        Route::GET('/destroy',[
            'uses'   => 'ReferenceController@destroy',
            'as'     => 'destroy'
        ]);
        Route::POST('/update',[
            'uses'   => 'ReferenceController@update',
            'as'     => 'update'
        ]);
    });
});
// Register Route End



















