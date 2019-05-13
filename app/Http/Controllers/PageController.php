<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Slide;

use App\Product;

class PageController extends Controller
{
    public function getIndex(){
        $slide = Slide::all();
        $new_product = Product::where('new',1)->paginate(8);
        $promotion_product = Product::where('promotion_price','<>',0)->paginate(4);
    	return view('page.trangchu',compact('slide','new_product','promotion_product'));
    }

    public function getLoaiSP($type){
    	$sp_theoloai = Product::where('id_type',$type)->get();
    	$sp_khac = Product::where('id_type','<>',$type)->paginate(3);
    	return view('page.loai_sanpham', compact('sp_theoloai','sp_khac'));
    }

    public function getChiTietSP(){
    	return view('page.chitiet_sanpham');
    }

    public function getLienHe(){
    	return view('page.lienhe');
    }

    public function getGioiThieu(){
    	return view('page.gioithieu');
    }
}

