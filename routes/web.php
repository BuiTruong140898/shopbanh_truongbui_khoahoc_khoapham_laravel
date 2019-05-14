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

Route::get('/', function () {
    return view('welcome');
});

Route::get('index',[
	'as'=>'trang-chu',
	'uses'=>'PageController@getIndex'
]);

Route::get('loai-san-pham/{type}',[
	'as'=>'loaisanpham',
	'uses'=>'PageController@getLoaiSp'
]);

Route::get('chi-tiet-san-pham/{id}',[
	'as'=>'chitietsanpham',
	'uses'=>'PageController@getChiTietSP'
]);

Route::get('lien-he',[
	'as'=>'lienhe',
	'uses'=>'PageController@getLienHe'
]);

Route::get('gioi-thieu',[
	'as'=>'gioithieu',
	'uses'=>"PageController@getGioiThieu"
]);

Route::get('them_vao_gio_hang/{id}',[
	'as'=>'themvaogiohang',
	'uses'=>"PageController@getThemGioHang"
]);

Route::get('xoa_gio_hang/{id}',[
	'as'=>'xoagiohang',
	'uses'=>'PageController@getXoaGioHang'
]);

Route::get('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@getDatHang'
]);

Route::post('Thong-tin-dat-hang',[
	'as'=>'thongtindathang',
	'uses'=>'PageController@postThongTinDatHang'
]);

Route::get('dang-nhap',[
	'as'=>'dangnhap',
	'uses'=>'PageController@getDangNhap'
]);

Route::get('dang-ky',[
	'as'=>'dangky',
	'uses'=>'PageController@getDangky'
<<<<<<< HEAD
]);

Route::post('dang-ky',[
	'as'=>'dangky',
	'uses'=>'PageController@postDangKy'
=======
>>>>>>> 217865a... cut login layout and signup layout
]);