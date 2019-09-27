<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UserPasswordRequest;
use App\Http\Requests\UserRequest;
use Auth;
use Hash;
use Response;
use App\User;
class UserController extends Controller{
    public function profile(){
    	return view('admin.users.profile');
    }
    public function index(){
        $breadcrumb[0]['name'] = 'Dashboard';
        $breadcrumb[0]['url'] = route('home');
        $breadcrumb[1]['name'] = 'Users Listing';
        $breadcrumb[1]['url'] = '';
    	return view('admin.users.index',compact(['breadcrumb']));
    }
    public function listings(Request $request){
        $user = new User;
        $user->listings($request);
    }
    public function create(){
        $breadcrumb[0]['name'] = 'Dashboard';
        $breadcrumb[0]['url'] = route('home');
        $breadcrumb[1]['name'] = 'Users Listing';
        $breadcrumb[1]['url'] = route('users.index');
        $breadcrumb[2]['name'] = 'Add new user';
        $breadcrumb[2]['url'] = '';
        return view('admin.users.create',compact(['breadcrumb']));
    }
    public function store(UserRequest $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()):
            $response = ['status'=>100,'message'=>'User created successfully','url'=>route('users.index')];
        else:
            $response = ['status'=>102,'message'=>'Something went wrong with saving data'];
        endif;
        return Response::json($response);
    }
    public function edit(User $user){
        return view('admin.users.create',compact(['user']));
    }
    public function update(UserRequest $request,User $user){
        $user->name = $request->name;
        $user->email = $request->email;
        if($user->save()):
            $response = ['status'=>100,'message'=>'User updated successfully','url'=>route('users.index')];
        else:
            $response = ['status'=>102,'message'=>'Something went wrong with saving data'];
        endif;
        return Response::json($response);
    }
    public function changePassword(){
        return view('admin.users.changepwd');
    }
    public function storeNewPassword(UserPasswordRequest $request){
        $old_pwd = $request->old_pwd;
        $new_pwd = $request->new_pwd;
        $confirm_pwd = $request->confirm_pwd;
        $user = User::findOrFail(Auth::user()->id);
        if(Hash::check($old_pwd,$user->password)){
            $user->password = Hash::make($new_pwd);
            if($user->save()):
                $response = ['status'=>100,'message'=>'Password updated successfully'];
            else:
                $response = ['status'=>102,'message'=>'Something went wrong with saving data'];
            endif;
        }else{
            $response = ['status'=>101,'message'=>'There is a problem','errors'=>['old_pwd'=>'Old password did not match']];
        }
        return Response::json($response);
    }
    public function destroy(User $user){
        if(!$user){
            $response = ['status'=>101,'message'=>'The user you are tryinng to delete does not exists!!!'];
        }else{
            if($user->id=='1' and Auth::user()->id!='1'){
                $response = ['status'=>104,'message'=>'You don\'t have permission to delete this record!!!'];
            }else{
                if($user->id==Auth::user()->id){
                    $response = ['status'=>102,'message'=>'You can\'t delete your own record!!!'];
                }else{
                    if($user->delete()):
                        $response = ['status'=>100,'message'=>'The user deleted successfully!!!'];
                    else:
                        $response = ['status'=>103,'message'=>'The user you are tryinng to delete does not exists!!!'];
                    endif;
                }
            }
        }
        return Response::json($response);
    }
}