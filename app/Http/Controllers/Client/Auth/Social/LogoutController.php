<?php

namespace App\Http\Controllers\Client\Auth\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LogoutController extends Controller
{
    public function logout(Request $request) {

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::logout();
        return redirect()->intended('/login');
    }
}
