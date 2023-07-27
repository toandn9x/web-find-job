<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

    public function formLogin() {
        if(Auth::guard('admin')->check()) {
            return redirect()->route('admin.home');
        }
        return view('admin.auth.form-login');
    }

    public function login(Request $request) {
        $data = $request->except('_token');

        if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $request->session()->forget('error');
            return redirect()->route('admin.home');
        }else{
            $request->session()->put('error', 'Email hoặc mật khẩu không đúng');
            return back();
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();

        return redirect('admin/auth/login');
    }
}
