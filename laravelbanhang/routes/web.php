<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Category_Product;
use App\Http\Controllers\ProductController;
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

Route::get("index",[PageController::class,'getIndex']);
Route::get("loai-san-pham/{type}",[PageController::class,'getLoaiSp']);
Route::get("chi-tiet-san-pham/{id}",[PageController::class,'getChiTiet']);
Route::get("lien-he",[PageController::class,'getLienHe']);
Route::get("gioi-thieu",[PageController::class,'getGioiThieu']);
Route::get("add-to-cart/{id}",[PageController::class,'getAddtoCart']);
Route::get("del-cart/{id}",[PageController::class,'getDelItemCart']);
Route::get("dat-hang",[PageController::class,'getCheckout']);
Route::post("dat-hang",[PageController::class,'postCheckout']);
Route::get("dang-ky",[PageController::class,'getSignup']);
Route::post("dang-ky",[PageController::class,'postSignup']);
Route::get("dang-nhap",[PageController::class,'getLogin']);
Route::post("dang-nhap",[PageController::class,'postLogin']);
Route::get("dang-xuat",[PageController::class,'postLogout']);
Route::get("search",[PageController::class,'getSearch']);
Route::get("dang-nhap-admin",[AdminController::class,'index']);
Route::get("admin",[AdminController::class,'show_dashboard']);
Route::post("admin-dashboard",[AdminController::class,'dashboard']);
Route::get("dang-xuat-admin",[AdminController::class,'logout']);
Route::get("add-category-product",[Category_Product::class,'add_category_product']);
Route::get("all-category-product",[Category_Product::class,'all_category_product']);
Route::get("edit-category-product/{id}",[Category_Product::class,'edit_category_product']);
Route::get("delete-category-product/{id}",[Category_Product::class,'delete_category_product']);
Route::post("save-category-product",[Category_Product::class,'save_category_product']);
Route::post("update-category-product/{id}",[Category_Product::class,'update_category_product']);
Route::get("add-product",[ProductController::class,'add_product']);
Route::get("all-product",[ProductController::class,'all_product']);
Route::get("edit-product/{id}",[ProductController::class,'edit_product']);
Route::get("delete-product/{id}",[ProductController::class,'delete_product']);
Route::post("save-product",[ProductController::class,'save_product']);
Route::post("update-product/{id}",[ProductController::class,'update_product']);



