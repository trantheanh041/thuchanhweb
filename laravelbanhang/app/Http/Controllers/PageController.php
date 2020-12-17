<?php

namespace App\Http\Controllers;
use App\Models\Slide;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginater;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\User;
use Hash;
use Auth;

use Session;

class PageController extends Controller
{
    public function getIndex(){
    	$slide= Slide::all();
    	$new_product= Product::where('new',1)->paginate(4);
    	$sanpham_khuyenmai=Product::where('promotion_price','<>',0)->paginate(8);
    	return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));
    }
    public function getLoaiSp($type){
        $sp_theoloai=Product::where('id_type',$type)->get();
        $sp_khac=Product::where('id_type','<>',$type)->Paginate(3);
        $loai =ProductType::all();
        $loai_sp=ProductType::where('id',$type)->first();
    	return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }
     public function getChiTiet(Request $req){
        $sanpham =Product::where('id',$req->id)->first();
        $sp_tuongtu=Product::where('id_type',$sanpham->id_type)->paginate(6);
    	return view('page.chitiet_sanpham',compact('sanpham','sp_tuongtu'));
    }
      public function getLienHe(){
    	return view('page.lienhe');
    }
     public function getGioiThieu(){
    	return view('page.gioithieu');
    }
    public function getAddtoCart(Request $request ,$id){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart =new Cart($oldCart);
        $cart->add($product,$id);
        $request->Session()->put('cart',$cart);
        return redirect()->back();
    }
    public function getDelItemCart($id){
         $oldCart = Session('cart')?Session::get('cart'):null;
         $cart =new Cart($oldCart);
         $cart->removeItem($id);
         if(count($cart->items)>0){
            Session::put('cart',$cart);
         }
         else{
            Session::forget('cart');
         }
         return redirect()->back();
    }
     public function getCheckout(){
        return view('page.dat_hang');
    }
   
    public function postCheckout(Request $request){
        $cart =Session::get('cart');
        
        $customer = new Customer;
        $customer ->name=$request ->name;
        $customer ->gender =$request ->gender;
        $customer ->email =$request ->email;
        $customer ->address= $request ->address;
        $customer->phone_number =$request ->phone;
        $customer ->note =$request->notes;
        $customer ->save();

        $bill= new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order =date('Y-m-d');
        $bill->total =$cart->totalPrice;
        $bill->payment= $req ->payment;
        $bill->note = $req->notes;
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $bill_detail =new BillDetail;
            $bill_detail ->id_bill=$bill->id;
            $bill_detail->id_product=$key;
            $bill_detail->quantity =$value['qty'];
            $bill_detail->unit_price =$value['price']/$value['qty'];
            $bill_detail->save();
        }
        
        Session::forget('cart');
        return redirect()->back()->with('thongbao','Đặt hàng thành công');

    }
    public function getLogin(){
        return view('page.dangnhap');
    }
     public function getSignup(){
        return view('page.dangky');
    }
     public function postSignup(Request $req){
        $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:6|max:20',
                'fullname'=>'required',
                're_password'=>'required|same:password'
                
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email.',
                'email.unique'=>'Email đã có người sử dụng.',
                'password.required'=>'Vui lòng nhập password',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Vui lòng nhập password từ 6-20 ký tự.',
                'password.max'=>'Vui lòng nhập password từ 6-20 ký tự.',
                'fullname.required'=>'Vui lòng nhập tên',
                're_password.required'=>'Vui lòng nhập lại password.'


            ]);
        $user= new User();
        $user ->full_name=$req->fullname;
        $user->email=$req->email;
        $user->password= Hash::make($req ->password);
        $user->phone=$req->phone;
        $user ->address=$req->address;
        $user->save();
        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
    }

    public function postLogin(Request $req){
        $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:6|max:20'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email.',
                'password.required'=>'Vui lòng nhập password',
                'password.min'=>'Vui lòng nhập password từ 6-20 ký tự.',
                'password.max'=>'Vui lòng nhập password từ 6-20 ký tự.'
            ]
        );
        $credentials= array('email'=>$req ->email,'password'=>$req->password);
        if(Auth::attempt($credentials)){
            return redirect()->back()->with(['flag'=>'success','message'=>'Đăng nhập thành công']);
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
        }
    }

    public function postLogout(){
        Auth::logout();
        return redirect()->back();
    }
    public function getSearch(Request $req){
        $product=Product::where('name','like','%'.$req->key.'%')->orWhere('unit_price',$req->key)->get();
        $product_khac=Product::where('name','like','%'.$req->key.'%')->Paginate(6);
        return view('page.search',compact('product','product_khac'));
    }

}
