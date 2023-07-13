<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserInfo;
use Auth;
use Storage;
use Log;
use Str;
use Hash;
use Carbon\Carbon;

class UserService {
    
    // private $user;

    public function __construct() {
       
    }

    public function index() {
        $users = User::orderBy('created_at', 'desc')->get();

        return $users;
    }

    public function profile($id) {
        $user = User::select('id','name','email','role')
                ->with(['posts', 'userInfo', 'company'])
                ->where('id', $id)
                ->first();

        return $user;
    }

    public function show($id) {
        
    }

    public function update(Request $request) {
        try {
            $user = UserInfo::where('user_id',Auth::user()->id)->firstOrFail();

            if(isset($request['nick_name'])) {
                $user->nick_name = $request['nick_name'];
            }
            if(isset($request['address'])) {
                $user->address = $request['address'];
            }
            if(isset($request['gender'])) {
                $user->gender = $request['gender'];
            }
            if(isset($request['birthday'])) {
                $user->birthday = $request['birthday'];
            }
            if(isset($request['links'])) {
                if(count(json_decode($request['links'])) > 0 ) {
                    $user->links = $request['links'];
                }else{
                    $user->links = NULL;
                }
            }
            if(isset($request['phone'])) {
                $user->phone = $request['phone'];
            }
            $user->save();
            return true;
        } catch (\Exception $e) {
            Log::error('Error update user', [
                'method' => __METHOD__,
                'line' => __LINE__,
                'message' => $e->getMessage(),
                'data' => $request->all(),
            ]);
            return false;
        }
        
    }

    public function updateCoverImage(Request $request) {
        try {
            if($request->hasFile('file')) {
                $path = $this->handleUploadImage($request->file('file'), 'cover-images');
                $userInfo = UserInfo::where('user_id', Auth::user()->id)
                                    ->update(['cover_image' => $path]);
            }
            return true;

        } catch (\Exception $e) {
            Log::error('Error upload file', [
                'method' => __METHOD__,
                'line' => __LINE__,
                'message' => $e->getMessage(),
                'data' => $request->all(),
            ]);
            return false;
        }
    }

    public function updateAvatar(Request $request) {
        try {
            if($request->hasFile('file')) {
                $path = $this->handleUploadImage($request->file('file'), 'avatars');
                $userInfo = UserInfo::where('user_id', Auth::user()->id)
                                    ->update(['avatar' => $path]);
            }
            return true;
        } catch (\Exception $e) {
            Log::error('Error update avatar', [
                'method' => __METHOD__,
                'line' => __LINE__,
                'message' => $e->getMessage(),
                'data' => $request->all(),
            ]);
            return false;
        }
    }

    public function changePassword(Request $request, $id) {
        try {
            $user = User::find($id);
            $user->password = Hash::make($request['password']);
            $user->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $user->save();

            return true;
        } catch (\Exception $e) {
            Log::error('Error change password', [
                'method' => __METHOD__,
                'line' => __LINE__,
                'message' => $e->getMessage(),
                'data' => $request->all(),
            ]);
            return false;
        }
    }

    //$data: file ảnh
    //$folder: Thư mục muốn lưu trữ ảnh
    private function handleUploadImage($data, $folder) {
        try {
            $file = $data;
            $random = Str::random(40);
            $name = $file->getClientOriginalName();
            $name = current(explode('.',$name));
            $name_image = $name.$random.'.'.$file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs($folder, $file, $name_image);
            
            return $path;
        } catch (\Throwable $th) {
            Log::error('Error upload file', [
                'method' => __METHOD__,
                'line' => __LINE__,
                'message' => $e->getMessage(),
                'data' => $data,
            ]);
            return false;
        }
    }
}