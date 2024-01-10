<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use App\Models\User;
use Log;
use Hash;
use Auth;
use Gate;

class UserController extends Controller
{
    use ResponseTrait;

    private $user;

    public function __construct(UserService $userService) {
        $this->user = $userService;
    }

    public function profile($id) {
        $user = $this->user->profile($id);

        return view('workwise.users.profile', [
            'user' => $user,
        ]);
    }

    public function viewSettingProfile($id) {

        $user = $this->user->profile($id);

        if(!Gate::allows('view', $user))
        {
            abort(403);
        }

        return view('workwise.users.setting-profile', [
            'user' => $user,
        ]);
    }

    public function update(Request $request) {
        $user = $this->user->update($request);

        return $user ? $this->responseSuccess() : $this->responseError();
    }

    public function changePassword(Request $request, $id) {
        try {
            $data = $request->except('_token');
            $user = User::find($id);
            if(!Hash::check($data['old-password'], $user->password)) {
                return $this->responseSuccess('error', 'Mật khẩu cũ không đúng.', 1);
            }
            $action = $this->user->changePassword($request, $id);
            return $action ? $this->responseSuccess() : $this->responseError();
        } catch (\Exception $e) {
            Log::error('Error change password', [
                'method' => __METHOD__,
                'line' => __LINE__,
                'message' => $e->getMessage(),
                'data' => $request->all(),
            ]);
        }
    }

    public function updateCoverImage(Request $request) {
        $user = $this->user->updateCoverImage($request);

        return $user ? $this->responseSuccess() : $this->responseError();
    }

    public function updateAvatar(Request $request) {
        $user = $this->user->updateAvatar($request);

        return $user ? $this->responseSuccess() : $this->responseError();
    }

    public function updateStatus(Request $request) {
        User::where('id', Auth::user()->id)->update(['status_cv' => 0]);

        return $this->responseSuccess();
    }
}
