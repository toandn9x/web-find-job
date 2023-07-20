<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use App\Events\Chat as ChatEvent;
use Auth;
use Log;
use Carbon\Carbon;

class ChatService
{
    private $chat;

    public function __construct() {
        $this->chat = new Chat();
    }

    public function show($id) {
        try {

            $user = User::select('id', 'name')
                ->where('id', $id)
                ->with(['userInfo', 'company', 'friends'])
                ->firstOrFail();

            if(Auth::user()->id != $id) {
                $this->handleCheckMakeFriend($user);
            }

            $this->setStatusPivot($user->id, Auth::user()->id, 0);

            $messages = $this->handleShowMessages($id);

            $data = [
                'user' => $user,
                'messages' => $messages,
            ];

            return $data;

        } catch (\Exception $e) {
            Log::error('Error show user', [
                'method' => __METHOD__,
                'line' => __LINE__,
                'message' => $e->getMessage(),
                'data' => $id,
            ]);
        }
    }

    public function handleShowMessages($id) {
        $user_from_id = Auth::user()->id;
        $user_to_id = $id;

        $messages = Chat::where(['user_from_id' => $user_from_id, 'user_to_id' => $user_to_id])
                    ->orWhere( function($query) use($user_from_id, $user_to_id) {
                        $query->where(['user_from_id' => $user_to_id, 'user_to_id' => $user_from_id]);
                    })
                    ->get();

        return $messages;
    }

    public function store(Request $request) {
        try {

            $data = $request->except('_token');

            $data['user_from_id'] = Auth::user()->id;
            event(new ChatEvent($data));

            $chat = $this->chat;
            $chat->user_from_id = Auth::user()->id;
            $chat->user_to_id = $data['user_to_id'];
            $chat->message = $data['message'];
            $chat->created_at = Carbon::now();
            $chat->save();

            $this->setStatusPivot($data['user_from_id'], $data['user_to_id'], 1);

            return true;

        } catch (\Exception $e) {
            Log::error('Error send message', [
                'method' => __METHOD__,
                'line' => __LINE__,
                'message' => $e->getMessage(),
                'data' => $request->all(),
            ]);
            return false;
        }
    }

    public function setStatusPivot($user_from_id, $user_to_id, $status) {
        try {
            $user = User::find($user_to_id);
            $user->friends()->updateExistingPivot(
                $user_from_id, 
                ['status' => $status]
            );
        } catch (\Exception $e) {
            Log::error('Error update status', [
                'method' => __METHOD__,
                'line' => __LINE__,
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function handleCheckMakeFriend($data) {
        $user_from = Auth::user();
        $user_to = $data;

        //Kiểm tra xem người dùng này đã có trong danh sách bạn bè với mình chưa
        $check1 = $user_from->friends()->where('user_to_id', $user_to->id)->first();
        if(!$check1) {
            $user_from->friends()->attach($user_to->id);
        }

        //Kiểm tra xem mình có trong danh sách bạn bè với người này chưa
        $check2 = $user_to->friends()->where('user_to_id', $user_from->id)->first();
        if(!$check2) {
            $user_to->friends()->attach($user_from->id);
        }
    }
}