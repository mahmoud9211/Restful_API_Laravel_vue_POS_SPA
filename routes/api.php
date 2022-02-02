<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\employeesController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\ordersController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SuppliersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('signup', [AuthController::class,'signup']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});

Route::apiResource('/employees',employeesController::class);

Route::apiResource('/suppliers',SuppliersController::class);

Route::apiResource('/categories',CategoriesController::class);

Route::apiResource('/products',ProductsController::class);

Route::get('/category/get',[HelperController::class,'category']);
Route::get('/supplier/get',[HelperController::class,'supplier']);
Route::get('/customer/get',[HelperController::class,'customer']);

Route::post('/quantity/update/{id}',[HelperController::class,'quantity_update']);



Route::apiResource('/customers',CustomersController::class);

Route::apiResource('/expenses',ExpensesController::class);

Route::get('/pos/products',[PosController::class,'products']);
Route::get('/pos/category/products/{id}',[PosController::class,'products_by_categories']);

Route::get('/cart/add/{id}',[CartController::class,'add']);
Route::get('/cart/get',[CartController::class,'getContent']);
Route::get('/cart/remove/{id}',[CartController::class,'remove']);
Route::get('/cart/increment/{id}',[CartController::class,'increment']);
Route::get('/cart/decrement/{id}',[CartController::class,'decrement']);

Route::post('/order/done',[CartController::class,'order_insert']);

Route::get('/orders/today',[ordersController::class,'orders_today']);

Route::get('/order/details/{id}',[ordersController::class,'order_details']);
Route::get('/order/orderdetails/{id}',[ordersController::class,'details']);

Route::get('/today/sell',[ordersController::class,'today_sell']);
Route::get('/today/income',[ordersController::class,'today_income']);
Route::get('/today/due',[ordersController::class,'today_due']);
Route::get('/today/expense',[ordersController::class,'today_expense']);

























