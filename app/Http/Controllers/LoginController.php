<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Session;
use Mail;
use Carbon\Carbon;

class LoginController extends Controller
{

    public function formLogin() {
        if(Auth::check()) {
            return redirect('/');
        }else{
            return view('auth.login');
        }
    }

    public function login(Request $request) {
        $data = $request->only(['email', 'password']);

        $user = User::where('email', $data['email'])->first();
        if($user && Hash::check($data['password'], $user->password)) {
            // Kiểm tra xem tài khoản đã đã xác thực email chưa
            if($user->status == 1) {
                $token = $this->createTokenVerifiableEmail($user->email);
                $user->token =  random_int(100000, 999999);
                $user->time_life_token = Carbon::now('Asia/Ho_Chi_Minh')->addMinutes(5);
                $user->save();
                return response()->json(['data' => ['code' => 302,'userEmail' => $data['email'], 'userToken' => $token]], 200);
            }else{
                Auth::attempt(['email' => $data['email'], 'password' => $data['password']]);
                return response()->json(['data' => ['code' => 200]], 200);
            }
        }else{
            return response()->json(['data' => ['code' => 500]], 200);
        }
        
    }

    //Đăng xuất tài khoản
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/form-login');
    }

    public function register(Request $request) {
        $data = $request->only(['email', 'name', 'password']);

        $rand_code = random_int(100000, 999999);

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->token =  $rand_code;
        $user->time_life_token = Carbon::now('Asia/Ho_Chi_Minh')->addMinutes(5);
        $user->save();
        
        $token = $this->createTokenVerifiableEmail($data['email']);
        
        $info = [
            'email' => $data['email'],
            'name' => $data['name'],
            'code' => $rand_code,
        ];

        $this->sendMail($info);

        return response()->json(['data' => ['code' => 302,'userEmail' => $data['email'], 'userToken' => $token]], 200);
    }

    public function verifiableEmail(Request $request) {
        if(Session::has(['token', 'email'])) {
            if($request->get('token') == Session::get('token') && $request->get('email') == Session::get('email')) {
                return view('auth.verifiable-email');
            }else{
                abort(403);
            }
        }else{
            abort(403);
        }
    }

    public function checkVerifiableEmail(Request $request) {
        $data = $request->only('code-email');

        $user = User::where(['email' => Session::get('email'), 'token' => $data['code-email']])->first();
        
        if($user) {
            // Kiểm tra xem mã còn thời gian hiệu lực không
            if($user->time_life_token < Carbon::now('Asia/Ho_Chi_Minh')) {
                return response()->json(['data' => ['code' => 500, 'message' => "Mã đã hết hạn ! Vui lòng nhấn gửi lại mã để nhận lại mã."]], 200);
            }else{
                $user->status = 1;
    
                $user->save();

                Auth::login($user);

                return response()->json(['data' => ['code' => 200]], 200);
            }
        }else{
            return response()->json(['data' => ['code' => 500, 'message' => "Mã xác minh không đúng !"]], 200);
        }
    }

    public function sendAgainEmail(Request $request) {
       $data = [
        'email' => Session::get('email'),
        'code' => random_int(100000, 999999),
       ];

       $user = User::where('email', $data['email'])->update(['token' => $data['code']]);

       $this->sendMail($data);
       return response()->json(['data' => ['code' => 200]], 200);
    }

    //Hàm tạo token để vào trang xác thực Email
    private function createTokenVerifiableEmail($email) {
        Session::forget('token');
        Session::forget('email');

        $token = md5(Carbon::now('Asia/Ho_Chi_Minh'));

        Session::put(['token' => $token, 'email' => $email]);

        return $token;
    }

    private function sendMail($data) {
        Mail::send('send-email-user', $data, function ($message) use($data) {
            $message->from('adminFakeSenger@gmail.com', 'Admin Dev');
            $message->to($data['email']);
            $message->subject('FakeSenger mã xác minh tài khoản.');
        });
    }
}
