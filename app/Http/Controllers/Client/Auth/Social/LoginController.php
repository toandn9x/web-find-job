<?php

namespace App\Http\Controllers\Client\Auth\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Company;
use Auth;
use Hash;
use Socialite;
use Log;
use Carbon\Carbon;

class LoginController extends Controller
{
    private $user;
    private $userInfo;
    private $company;

    public function __construct() {
        $this->user = new User();
        $this->userInfo = new UserInfo();
        $this->company = new Company();
    }

    public function formLogin() {
        // dd(env('GOOGLE_CLIENT_ID'), env('GOOGLE_CLIENT_LOCAL'), env('GOOGLE_CLIENT_SECRET'));
        // Kiểm tra tài khoản xem đã đăng nhập chưa ?
        // * Trả về trang đăng nhập nếu chưa đăng nhập
        // * Trả về trang trủ nếu đã đăng nhập
        $check = Auth::check() ? redirect()->route('home') : view('workwise.auth.login');
        
        return $check;
    }

    //Đăng nhập với tài khoản tự đăng ký
    public function login(Request $request) {
        try {

            $data = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            if(Auth::attempt($data)) {
                return response()->json(['data' => ['message' => 'success', 'status' => 0]], 200);
            }

            return response()->json(['data' => ['message' => 'Email hoặc mật khẩu không đúng!', 'status' => 1]], 200);

        } catch (\Exception $e) {
            Log::error('Error get list banks', [
                'method' => __METHOD__,
                'message' => $e->getMessage(),
                'line' => __LINE__
            ]);
            return 'error';
        }
    }

    //Đăng nhập với tài khoản facebook
    public function redirectToFacebook() {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(Request $request) {
        try {
            $user = Socialite::driver('facebook')->user();

            // Kiểm tra xem tài khoản facebook này đã được đăng ký chưa và lấy thông tin đó từ csdl
            $finduser = User::where('facebook_id', $user->id)->first();

            if($finduser) {

                Auth::login($finduser);

                return redirect()->route('home');
            }else {
                $newUser = $this->user;
                $newUser->type_login = "facebook";
                $newUser->facebook_id = $user->id;
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->password = Hash::make('123456workwise');
                $newUser->created_at = Carbon::now();

                $newUser->save();

                $info = $this->userInfo;
                $info->user_id = $newUser->id;
                $info->avatar = $user->avatar;

                $info->save();

                Auth::login($newUser);

                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            abort(500);
        }
    }

    // Đăng nhập với tài khoản google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
            
            // Kiểm tra xem tài khoản google này đã được đăng ký chưa và lấy thông tin tài khoản đó từ csdl
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->route('home');
       
            }else{
                $newUser = $this->user;
                $newUser->type_login = "google";
                $newUser->google_id = $user->id;
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->password = Hash::make('123456workwise');
                $newUser->created_at = Carbon::now();

                $newUser->save();

                $info = $this->userInfo;
                $info->user_id = $newUser->id;
                $info->avatar = $user->avatar;

                $info->save();

                Auth::login($newUser);

                return redirect()->route('home');
            }
      
        } catch (Exception $e) {
            abort(500);
        }
    }

    // Đăng ký tài khoản
    public function register(Request $request) {
        $data = $request->only('name', 'email', 'password', 'company', 'phone', 'address', 'role');

        if($this->checkUniqueEmail($data['email'])) {
            return response()->json(['data' => ['error' => 'Email này đã tồn tại.' ,'status' => 1]], 200);
        }else{
            $newUser = $this->user;
            $newUser->name = $data['name'];
            $newUser->email = $data['email'];
            $newUser->password = Hash::make($data['password']);
            $newUser->role = $data['role'];
            $newUser->created_at = Carbon::now();
            $newUser->save();

            if($data['role'] == User::ROLE['EMPLOYER']) {
                $company = $this->company;
                $company->user_id = $newUser->id;
                $company->name = $data['company'];
                $company->phone = $data['phone'];
                $company->address = $data['address'];
                $company->created_at = Carbon::now();
                $company->save();
            }

            $info = $this->userInfo;
            $info->user_id = $newUser->id;
            $info->save();

            return response()->json(['data' => ['message' => 'Đăng ký thành công.' ,'status' => 0]], 200);
        }

    }

    private function checkUniqueEmail($email) {
        $uniqueEmail = User::whereEmail($email)->first();

        return $uniqueEmail ? true : false;
    }
}