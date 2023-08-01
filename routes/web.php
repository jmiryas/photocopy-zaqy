<?php

use App\Http\Controllers\MerkController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaperController;
use App\Http\Controllers\PaperSizeController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleTypeController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockTypeController;
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
})->name("dashboard");

Route::resource("merks", MerkController::class);
Route::resource("paper-sizes", PaperSizeController::class);
Route::resource("sale-types", SaleTypeController::class);
Route::resource("stock-types", StockTypeController::class);
Route::resource("orders", OrderController::class);
Route::resource("papers", PaperController::class);
Route::resource("sales", SaleController::class);

Route::get("/stocks/orders", [StockController::class, "orderStocks"])->name("stocks.orders");
Route::get("/stocks/sales", [StockController::class, "salesStocks"])->name("stocks.sales");