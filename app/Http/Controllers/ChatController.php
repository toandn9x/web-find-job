<?php

namespace App\Http\Controllers;

use App\Models\Chat as Message;
use App\Models\User;
use App\Events\Chat;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereNotIn('id', [Auth::user()->id])->get();

        return view('welcome', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addMessage(Request $request)
    {
        $data = $request->only(['to','text']);

        $data['id'] = Auth::user()->id;
        event(new Chat($data));

        $message = new Message();
        $message->form = Auth::user()->id;
        $message->to = $data['to'];
        $message->text = $data['text'];
        $message->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $message->save();
    }

   public function showFriend(Request $request) {
        $data = $request->only('id');

        $id_me = Auth::user()->id;

        $user = User::where('id', $data['id'])
                    ->select('id','name')
                    ->first();

        $messages = Message::where(function ($query) use($data, $id_me) {
            $query->where(['form' => $data['id'], 'to' => $id_me]);
        })->orWhere(function ($query) use($data, $id_me) {
            $query->where(['to' => $data['id'], 'form' => $id_me]);
        })->get(['form','to','text','created_at']);

        return response()->json(['data' => ["user" => $user,"messages" => $messages]] ,200);
   }
}
