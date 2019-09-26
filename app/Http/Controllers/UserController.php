<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UserPasswordRequest;
use Auth;
use Hash;
use Response;
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
    public function changePassword(){
        return view('changepwd');
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
        return Response::json($response);
    }
}