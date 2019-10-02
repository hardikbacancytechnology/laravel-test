<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UserPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Jobs\ProcessPodcast;
use Auth;
use Hash;
use Response;
use App\User;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
//Enables us to output flash messaging
use Session;
class UserController extends Controller{
    public function __construct() {
        $this->middleware(['isAdmin'])->except('profile','index','listings','changePassword','storeNewPassword'); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }    
    public function index(){
        $breadcrumb[0]['name'] = 'Dashboard';
        $breadcrumb[0]['url'] = route('home');
        $breadcrumb[1]['name'] = 'Users Listing';
        $breadcrumb[1]['url'] = '';
        $users = User::all();
    	return view('admin.users.index',compact(['breadcrumb','users']));
    }    
    public function create(){
        $breadcrumb[0]['name'] = 'Dashboard';
        $breadcrumb[0]['url'] = route('home');
        $breadcrumb[1]['name'] = 'Users Listing';
        $breadcrumb[1]['url'] = route('users.index');
        $breadcrumb[2]['name'] = 'Add new user';
        $breadcrumb[2]['url'] = '';
        $roles = Role::get();
        return view('admin.users.create',compact(['breadcrumb','roles']));
    }
    public function store(UserRequest $request){
        $user = new User;
        $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }        
        if($user->saveData($request,$user)):
            $response = ['status'=>100,'message'=>'User created successfully','url'=>route('users.index'),'counter'=>User::count()];
        else:
            $response = ['status'=>102,'message'=>'Something went wrong with saving data'];
        endif;
        return Response::json($response);
    }
    public function edit(User $user){
        $breadcrumb[0]['name'] = 'Dashboard';
        $breadcrumb[0]['url'] = route('home');
        $breadcrumb[1]['name'] = 'Users Listing';
        $breadcrumb[1]['url'] = route('users.index');
        $breadcrumb[2]['name'] = 'Edit user';
        $breadcrumb[2]['url'] = '';
        $selectedRoles = [];
        foreach ($user->roles as $key => $role) {
            $selectedRoles[] += $role->id;
        }
        $roles = Role::get(); //Get all roles
        return view('admin.users.create',compact(['user','breadcrumb','roles','selectedRoles']));
    }
    public function update(UserRequest $request,User $user){
        if($user->saveData($request,$user)):
            $roles = $request['roles']; //Retreive all roles
            if (isset($roles)) {
                $user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
            }else {
                $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
            }
            $response = ['status'=>100,'message'=>'User updated successfully','url'=>route('users.index')];
        else:
            $response = ['status'=>102,'message'=>'Something went wrong with saving data'];
        endif;
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
                        $response = ['status'=>100,'message'=>'The user deleted successfully!!!','counter'=>User::count()];
                    else:
                        $response = ['status'=>103,'message'=>'The user you are tryinng to delete does not exists!!!'];
                    endif;
                }
            }
        }
        return Response::json($response);
    }
    public function listings(Request $request){
        $user = new User;
        $user->listings($request);
    }
    public function profile(){
        $breadcrumb[0]['name'] = 'Dashboard';
        $breadcrumb[0]['url'] = route('home');
        $breadcrumb[1]['name'] = 'User Profile';
        $breadcrumb[1]['url'] = '';
        return view('admin.users.profile',compact(['breadcrumb']));
    }
    public function changePassword(){
        $breadcrumb[0]['name'] = 'Dashboard';
        $breadcrumb[0]['url'] = route('home');
        $breadcrumb[1]['name'] = 'Change Password';
        $breadcrumb[1]['url'] = '';
        return view('admin.users.changepwd',compact(['breadcrumb']));
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
}