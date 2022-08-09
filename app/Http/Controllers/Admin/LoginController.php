<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function loginView()
    {
        return view('admin.login.login');
    }

    public function doLogin(Request $request){

        $rules =  [
            "email" => "required",
            "password" => "required"
        ];

        $request->validate($rules);

        $auth = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if(Auth::attempt($auth)){

                // if(Auth::user()->hasRole('admin')){

                    return redirect()->route('admin.dashboard');
                // }
        }else{

            $notify[] = ['error', 'Email or password is invalid'];
        	return back()->withNotify($notify);

        }

    }

    public function logout(){

        Auth::logout();
        
        return redirect()->route('login.view');

    }
    public function createUser(){
        return view('admin.create_user.add');
    }
    public function saveUser(Request $request){
        $rules =  [
            "email" => "required",
            "password" => "required",
            "first_name"=>"required",
            "last_name"=>"required"
        ];

        $request->validate($rules);

        $data=$request->all();
        $data['password']=Hash::make($request->password);
        $data['admin_user']=1;

        if($create=User::create($data)){
            return redirect()->route('admin.listUser');
        }
        else{

            $notify[] = ['error', 'Internal Server Error'];
        	return back()->withNotify($notify);

        }

    }
    public function listUser(){
        $users=User::where('admin_user',1)->get();
        return view('admin.create_user.list',compact('users'));
    }
    public function editUser($id){
        $user=User::find($id);
        return view('admin.create_user.edit',compact('user'));
    }
    public function updateUser(Request $request){
        $rules =  [
            "email" => "required",
            "password" => "required",
            "first_name"=>"required",
            "last_name"=>"required",
            'id'=>"required"
        ];

        $request->validate($rules);

        $data=$request->all();
        $data['password']=Hash::make($request->password);
        $updated=User::find($request->id)->update([
            'email'=>$request->email,
            'password'=>$data['password'],
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name
        ]);
        if($updated){
            return redirect()->route('admin.listUser');
        }else {
            $notify[] = ['error', 'Internal Server Error'];
        	return back()->withNotify($notify);
        }
    }
    public function deleteUser($id){
        $user=User::destroy($id);
        return redirect()->route('admin.listUser');
    }

}
