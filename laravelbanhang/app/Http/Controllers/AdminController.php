<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Auth;
use Session;
session_start();

class AdminController extends Controller
{
    public function index(){
    	return view('page.admin_login');
    } 
    public function show_dashboard(){
    	return view('admin.dashboard');
    } 
    public function dashboard(Request $request){
    	$admin_email =$request->admin_email;
    	$admin_password =$request ->admin_password;
    	$result = DB::table('admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
    	if($result){
    	Session::put('admin_name',$result->admin_name);
    	Session::put('admin_id',$result->admin_id);
    	return Redirect::to('admin');

   		}else{
   			Session::put('message','Mật khẩu hoặc tài khoản sai!');
   			return Redirect::to('dang-nhap-admin');
   		}
    }
     public function logout(){
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('dang-nhap-admin');
    }
    
}
