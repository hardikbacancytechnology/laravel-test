<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class HomeController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.home');
    }
    public function index1(){
        return view('admin.home1');
    }
    public function index2(){
        echo "string";
    }
}