<?php

use Illuminate\Support\Facades\Route;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
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

Route::get('/checkdatabase', function() {
    $theloai = App\Models\TheLoai::All();
    foreach($theloai as $value) {
        echo $value;
    }
});

Route::get('/checkpage', function () {
    return view('admin.theloai.danhsach');
});

Route::get('admin/dangnhap', 'App\Http\Controllers\UserController@getDangNhapAdmin');
Route::post('admin/dangnhap', 'App\Http\Controllers\UserController@postDangNhapAdmin');
Route::get('admin/logout', 'App\Http\Controllers\UserController@getDangXuat');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
   Route::group(['prefix'=>'theloai'],function(){
         //admin/theloai/them
         Route::get('danhsach','App\Http\Controllers\TheLoaiController@getDanhSach');
         Route::get('sua/{id}','App\Http\Controllers\TheLoaiController@getSua');
         Route::post('sua/{id}','App\Http\Controllers\TheLoaiController@postSua');
         Route::get('them','App\Http\Controllers\TheLoaiController@getThem');
         Route::post('them','App\Http\Controllers\TheLoaiController@postThem');

         Route::get('xoa/{id}','App\Http\Controllers\TheLoaiController@getXoa');

   });

   Route::group(['prefix'=>'loaitin'],function(){
         //admin/loaitin/them
         
         Route::get('danhsach','App\Http\Controllers\LoaiTinController@getDanhSach');
         Route::get('sua/{id}','App\Http\Controllers\LoaiTinController@getSua');
         Route::post('sua/{id}','App\Http\Controllers\LoaiTinController@postSua');
         Route::get('them','App\Http\Controllers\LoaiTinController@getThem');
         Route::post('them','App\Http\Controllers\LoaiTinController@postThem');
         Route::get('xoa/{id}','App\Http\Controllers\LoaiTinController@getXoa');
   });

   Route::group(['prefix' => 'tintuc'], function () {
        Route::get('danhsach', 'App\Http\Controllers\TinTucController@getDanhSach');

        Route::get('sua/{id}', 'App\Http\Controllers\TinTucController@getSua');
        Route::post('sua/{id}', 'App\Http\Controllers\TinTucController@postSua');

         Route::get('binhluan/{id}', 'App\Http\Controllers\TinTucController@getBinhluan');
        Route::get('them', 'App\Http\Controllers\TinTucController@getThem');
        Route::post('them', 'App\Http\Controllers\TinTucController@postThem');

        Route::get('xoa/{id}', 'App\Http\Controllers\TinTucController@getXoa');
    });

    Route::group(['prefix'=>'comment'],function(){
         //admin/loaitin/them
         
         Route::get('xoa/{id}/{idTinTuc}','App\Http\Controllers\CommentController@getXoa');
   });
    Route::group(['prefix'=>'slide'],function(){

         Route::get('danhsach','App\Http\Controllers\SlideController@getDanhSach');
         Route::get('sua/{id}','App\Http\Controllers\SlideController@getSua');
         Route::post('sua/{id}','App\Http\Controllers\SlideController@postSua');
         Route::get('them','App\Http\Controllers\SlideController@getThem');
         Route::post('them','App\Http\Controllers\SlideController@postThem');
         Route::get('xoa/{id}','App\Http\Controllers\SlideController@getXoa');
   });
    /////////////////
    // Group User
    /////////////////
    Route::group(['prefix' => 'user'], function () {
        Route::get('danhsach', 'App\Http\Controllers\UserController@getDanhSach');

        Route::get('sua/{id}', 'App\Http\Controllers\UserController@getSua');
        Route::post('sua/{id}', 'App\Http\Controllers\UserController@postSua');

        Route::get('them', 'App\Http\Controllers\UserController@getThem');
        Route::post('them', 'App\Http\Controllers\UserController@postThem');

        Route::get('xoa/{id}', 'App\Http\Controllers\UserController@getXoa');
    });
    Route::group(['prefix' => 'ajax'], function () {
        Route::get('loaitin/{idTheLoai}', 'App\Http\Controllers\AjaxController@getLoaiTin');
    });
});



Route::get('trangchu','App\Http\Controllers\PageController@trangchu');

Route::get('lienhe','App\Http\Controllers\PageController@lienhe');

Route::get('gioithieu','App\Http\Controllers\PageController@gioithieu');

Route::get('loaitin/{id}/{TenKhongDau}.html','App\Http\Controllers\PageController@loaitin');

Route::get('tintuc/{id}/{TieuDeKhongDau}.html','App\Http\Controllers\PageController@tintuc');


Route::get('dangnhap','App\Http\Controllers\PageController@getDangnhap');

Route::post('dangnhap','App\Http\Controllers\PageController@postDangnhap');

Route::get('dangxuat','App\Http\Controllers\PageController@getDangxuat');
Route::get('nguoidung','App\Http\Controllers\PageController@getNguoidung');
Route::post('nguoidung','App\Http\Controllers\PageController@postNguoidung');
Route::get('dangky','App\Http\Controllers\PageController@getDangky');
Route::post('dangky','App\Http\Controllers\PageController@postDangky');

Route::post('comment/{id}','App\Http\Controllers\CommentController@postComment');

Route::post('timkiem','App\Http\Controllers\PageController@timkiem');