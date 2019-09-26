<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
class UserController extends Controller{
    public function profile(){
    	return view('profile');
    }
    public function index(){
    	return view('users');	
    }
    public function listings(Request $request){
    	$user = new User;
    	$user->listings($request);
    }
}