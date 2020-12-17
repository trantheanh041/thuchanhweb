<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
session_start();

class ProductController extends Controller
{
   public function add_product(){
   		$cate_product =DB::table('type_products')->orderby('id','asc')->get();
    	
    	return view('admin.add_product')->with('id_type',$cate_product);
    
    }
    public function all_product(){
		
    	$all_product= DB::table('products')->get();
    	$manager_product = view('admin.all_product')->with('all_product',$all_product);
    	return view('page.admin')->with('admin.all_product',$manager_product);
    }
public function save_product(Request $request){
	 $data=array();
	 $data['name']=$request->product_name;
	 $data['id_type']=$request->category_product;
	 $data['description']=$request->product_desc;
	 $data['unit_price']=$request->product_unit_price;
	 $data['promotion_price']=$request->product_promo;
	 

	 $get_image=$request->file('product_image');
	 
   
			$get_name_image=$get_image->getClientOriginalName();
             $name_image=current(explode('.', $get_name_image));
             $new_image= $name_image.rand(0, 99).'.'.$get_image->getClientOriginalExtension();
             $get_image->move('source/image/product', $new_image);
             $data['image']=$new_image;
             DB::table('products')->insert($data);
             Session::put('message', 'Thêm thành công');
             return  Redirect::to('add-product');
         
     
	 $data['image']='';
	 $data['unit']=$request->unit;
	 $data['new']=1;

	 DB::table('products')->insert($data);
	 Session::put('message','Thêm sản phẩm thành công');
	 return  Redirect::to('all-product');
	}
	public function edit_product($product_id){
		$cate_product =DB::table('type_products')->orderby('id','asc')->get();
		$edit_product= DB::table('products')->where('id',$product_id)->get();
    	$manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('type_products',$cate_product);
    	return view('page.admin')->with('admin.edit_product',$manager_product);
	}
	public function update_product(Request $request,$product_id){
		
		$data=array();
		$data['name']=$request->product_name;
	 	$data['description']=$request->product_desc;
	 	$data['id_type']=$request->category_product;
	 	$get_image=$request->file('product_image');
	 	if($get_image)
	 	{
	 	$get_name_image=$get_image->getClientOriginalName();
	 	$name_image=current(explode('.', $get_name_image));
	 	$new_image= $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
	 	$get_image->move('source/image/product',$new_image);
	 	$data['image']=$new_image;
	 	DB::table('products')->where('id',$product_id)->update($data);
	 	Session::put('message','Cập nhật thành công');
	 	return  Redirect::to('all-product');
	 	}
	 	DB::table('products')->where('id',$product_id)->update($data);
	 	Session::put('message','Cập nhật thành công');
	 	return  Redirect::to('all-product');
	}
	public function delete_product($product_id){
		if(DB::table('products')->where('id',$id_type))
		{
			
		}
		DB::table('products')->where('id',$product_id)->delete();
	 	Session::put('message','Xóa  sản phẩm thành công');
	 	return  Redirect::to('all-product');
	}
}

