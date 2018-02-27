<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\User;

class UserController extends Controller
{
    // Login
    public function login(Request $request)
    {
        return view('login');
    }

    // Do Login
    public function doLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $check = DB::table('users')
                ->where('username', $username)
                ->first();

        if($check)
        {
            if(Hash::check($password, $check->password)){
                $data = array(
                    'id' => $check->id,
                    'username' => $check->username,
                    'fullname' => $check->fullname,
                    'email' => $check->email,
                    'level' => $check->level
                );

                $request->session()->put('login_data', $data);

                return redirect('home');
            }else{
                $request->session()->flash('errors', 'Email or Password Incorrect!');

                return redirect('login');
            }
        }else{
            $request->session()->flash('errors', 'Email or Password Incorrect!');

            return redirect('login');
        }
    }

    // Log Out
    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect('login');
    }

    // Get
    public function get(Request $request, $id = null)
    {
      if(!$id){
        $data['users'] = User::all();
        $data['title'] = 'Manage Users';

        return view('user/manage', $data);
      }else{
        $data['user'] = User::find($id);
        $data['title'] = 'Profile : '.$data['user']->fullname;
        $data['division'] = ['umrah', 'tour'];
        $data['levels'] = DB::table('levels')->get();

        if($request->session()->get('login_data')['level'] != 1 && $request->session()->get('login_data')['id'] != $id){
          abort(404);
        }

        return view('user/read', $data);
      }
    }

    // Change Avatar
    public function changeAvatar(Request $request, $id)
    {
      if(!$id){
          return redirect()->back();
      }

      $data['user'] = User::find($id);
      $data['title'] = 'Change Avatar';
      $data['url_back'] = url('user/'.$id);

      if($request->session()->get('login_data')['level'] != 1 && $request->session()->get('login_data')['id'] != $id){
        abort(404);
      }

      return view('user/change_avatar', $data);
    }

    // Change Password
    public function changePassword(Request $request, $id)
    {
      if(!$id){
          return redirect()->back();
      }

      if($request->session()->get('login_data')['level'] != 1 && $request->session()->get('login_data')['id'] != $id){
        abort(404);
      }

      $data['user'] = User::find($id);
      $data['title'] = 'Change Password';
      $data['url_back'] = url('user/'.$id);

      return view('user/change_password', $data);
    }

    // update
    public function doUpdate(Request $request, $id)
    {
      if(!$id){
          return redirect()->back();
      }

      if($request->session()->get('login_data')['level'] != 1 && $request->session()->get('login_data')['id'] != $id){
        abort(503);
      }

      if($request->mode == 'full'){
      $validator = Validator::make($request->all(), [
          'username' => 'required',
          'fullname' => 'required',
          'level' => 'required',
      ]);
      }else if($request->mode == 'avatar'){
      $validator = Validator::make($request->all(), [
          'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      }else if($request->mode == 'password'){
        $validator = Validator::make($request->all(), [
          'old_password' => 'required',
          'new_password' => 'required|min:5|different:old_password',
          're_password' => 'required_with:new_password|min:5',
        ]);
      }

      if ($validator->fails()) {
          return redirect()->back()
                      ->withErrors($validator)
                      ->withInput();
      }

      $user = User::find($id);

      if($request->mode == 'full'){
        $user->fullname = $request->fullname;
        $user->division = $request->division;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->level = $request->level;
      }else if($request->mode == 'avatar'){
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('assets/img/users-avatar/'), $imageName);

        if($user->avatar != ''){
          if(file_exists(public_path('assets/img/users-avatar/'.$user->avatar))){
              @unlink(public_path('assets/img/users-avatar/'.$user->avatar));
          }
        }

        $user->avatar = $imageName;
      }else if($request->mode == 'password'){
        if(Hash::check($request->old_password, $user->password)){
          $user->password = Hash::make($request->new_password);
        }
      }

      $user->save();

      $request->session()->flash('msg', 'Data berhasil disimpan!');
      return redirect('user/'.$id);
    }
}
