<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class MailBoxController extends Controller{
    public function index(){
    	return view('admin.mailbox.index');
    }
    public function compose(){
    	return view('admin.mailbox.compose');
    }
    public function read(){
    	return view('admin.mailbox.read');
    }
}