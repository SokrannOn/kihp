<?php

namespace App\Http\Controllers;

use App\Position;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class DefaultController extends Controller
{
    public function index(){
        
        $role = Role::all();
        if(!count($role)){
            $Role = new Role();
            $Role->name = "administrator";
            $Role->description="Administrator";
            $Role->user_id=1;
            $Role->save();

            $Role = new Role();
            $Role->name = "user";
            $Role->description="Users";
            $Role->user_id=1;
            $Role->save();

            $Role = new Role();
            $Role->name = "guest";
            $Role->description="Guest";
            $Role->user_id=1;
            $Role->save();
        }

        $position = Position::all();
        if(!count($position)){
           $pos = new Position();
           $pos->name = "Administrator";
           $pos->description="Administrator";
           $pos->user_id=1;
           $pos->save();
        }

        $user = User::all();
        if(!count($user)){
           $users = new User();
           $users->active       =  1;
           $users->role_id      =   1;
           $users->position_id  =   1;
           $users->name         =   "Administrator";
           $users->username     =  "Administrator";
           $users->email        =  "Admin@gmail.com";
           $users->password     =  bcrypt('admin');
           $users->photo        =  "default_user.png";
           $users->save();

        }
        if(Auth::check()) {
            return view('admin.dashboard');
        }
//
        return view('front.home');
    }

    public function AdminPanel(){

        return view(' admin.dashboard');
    }


    public function locale(Request $request, $lang){
        $request->session()->put('locale',$lang);
    }

    public function frontLocale(Request $request, $lang){
        $request->session()->put('locale',$lang);
    }

}
