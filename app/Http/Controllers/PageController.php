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

use App\User;

use Hash;

use Auth;

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

    public function getDangNhap(){
    	return view('page.dangnhap');
    }

    public function getDangKy(){
    	return view('page.dangky');
    }

    public function postDangKy(Request $req){
    	$this->validate($req,
    		[
    			'email'=>'required|email|unique:users,email',
    			'password'=>'required|min:6|max:20',
    			'full_name'=>'required',
    			're_password'=>'required|same:password'
    		],
    		[
    			'email.required'=>'Vui lòng nhập lại email',
    			'email.email'=>'Email không đúng định dạng',
    			'email.unique'=>'Email đã tồn tại',
    			'password.required'=>'Vui lòng nhập lại mật khẩu',
    			're_password.same'=>'Mật khẩu xác nhận không khớp',
    			'password.min'=>'Vui lòng nhập mật khẩu từ 6-20 kí tự',
    			'password.max'=>'Vui lòng nhập mật khẩu từ 6-20 kí tự',

    		]
    	);
    	$user = new User;
    	$user->full_name = $req->full_name;
    	$user->email = $req->email;
    	$user->phone = $req->phone;
    	$user->address = $req->address;
    	$user->password = Hash::make($req->password);
    	$user->save();
    	return redirect()->back()->with('thanhcong','Tạo tài khoản thành công'); 
    }

    public function postDangNhap(Request $req){
    	$this->validate($req,[
    		'email'=>'required|email',
    		'password'=>'required|min:6|max:20'
    	],
    	[
    		'email.required'=>'Vui lòng nhập email',
    		'email.email'=>'Email không đúng định dạng',
    		'password.required'=>"Vui lòng nhập mật khẩu",
    		'password.min'=>'Mật khẩu phải có ít nhất 6 kí tự',
    		'password.max'=>'Mật khẩu phải có không quá 20 kí tự'
    	]
    );
    $credentails = array('email'=>$req->email,'password'=>$req->password);
    if(Auth::attempt($credentails)){
    	return redirect()->back()->with(['flag'=>'success','message'=>'Đăng nhập thành công']);
    }	
    else{
    	return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập thất bại']);
    }
    }

    public function getDangXuat(){
    	Auth::logout();
    	return redirect()->route('trang-chu');
    }

    public function getTimKiem(Request $req){
    	$ketquatimkiem = Product::where('name','like','%'.$req->key.'%')->orWhere('unit_price',$req->key)->paginate(8);
    	return view('page.ketquatimkiem',compact('ketquatimkiem'));
    }
}

