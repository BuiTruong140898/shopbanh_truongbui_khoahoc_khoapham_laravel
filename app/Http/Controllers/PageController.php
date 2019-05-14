<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Slide;

use App\Product;

use App\ProductType;

use App\cart;

use Session;

use App\customer;

use App\Bill;

use App\BillDetail;

class PageController extends Controller
{
    public function getindex(){
        $slide = Slide::all();
        $new_product = Product::where('new',1)->paginate(8, ['*'], 'page_article');
        $promotion_product = Product::where('promotion_price','<>',0)->paginate(4, ['*'], 'page_articl');
    	return view('page.trangchu',compact('slide','new_product','promotion_product'));
    }

    public function getLoaiSP($type){
    	$sp_theoloai = Product::where('id_type',$type)->get();
    	$sp_khac = Product::where('id_type','<>',$type)->paginate(3);
    	$loai = ProductType::all();
    	$loai_dang_xem = ProductType::where('id',$type)->first();
    	return view('page.loai_sanpham', compact('sp_theoloai','sp_khac','loai','loai_dang_xem'));
    }

    public function getChiTietSP(Request $req){
    	$sanpham = Product::where('id',$req->id)->first();
    	$sp_cungloai = Product::where('id_type',$sanpham->id_type)->paginate(3, ['*'], 'page_artle');
    	return view('page.chitiet_sanpham', compact('sanpham','sp_cungloai'));
    }

    public function getLienHe(){
    	return view('page.lienhe');
    }

    public function getGioiThieu(){
    	return view('page.gioithieu');
    }

    public function getthemgiohang(Request $req,$id){
    	$product = Product::find($id);
    	$oldCart = Session('cart')?Session::get('cart'):null;
    	$cart = new Cart($oldCart);
    	$cart->add($product, $id);
    	$req->Session()->put('cart',$cart);
    	return redirect()->back();
    }

    public function getxoagiohang(Request $req,$id){
    	$oldCart = session::has('cart')?Session::get('cart'):null;
    	$cart = new Cart($oldCart);
    	$cart->removeItem($id);
    	if($cart->items>0){
	    	Session::put('cart',$cart);
	    }
	    else{
	    	Session::forget('cart');
	    }
    	return redirect()->back();
    }

    public function getDatHang(){
    	return view('page.dathang');
    }

    public function postThongTinDatHang(Request $req){

    	$cart = Session::get('cart');


    	$customer = new Customer;
    	$customer->name = $req->name;
    	$customer->gender = $req->gender;
    	$customer->email = $req->email;
    	$customer->address = $req->address;
    	$customer->phone_number = $req->phone_number;
    	$customer->note =$req->note;
    	$customer->save();

    	$bill = new bill;
    	$bill->id_customer = $customer->id;
    	$bill->date_order = date('y-m-d');
    	$bill->total = $cart->totalPrice;
    	$bill->payment = $req->payment_method;
    	$bill->note = $req->note;
    	$bill->save();

		foreach($cart->items as $key=>$value){
	    	$bill_detail = new billDetail;
	    	$bill_detail->id_bill = $bill->id;
	    	$bill_detail->id_product = $key;
	    	$bill_detail->quantity = $value['qty'];
	    	$bill_detail->unit_price = ($value['price']/$value['qty']);
	    	$bill_detail->save();
	    }
	    Session::forget('cart');
	    return redirect()->back()->with('thongbao','Đặt hàng thành công');
  
    }
}

