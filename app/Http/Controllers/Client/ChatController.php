<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Services\ChatService;
use Auth;

class ChatController extends Controller
{
    use ResponseTrait;

    private $chat;

    public function __construct(ChatService $chatService) {
        $this->chat = $chatService;
    }

    public function index($id) {
        $data = $this->chat->show($id);
        
        if(is_null($data)) {
            abort(404);
        }

        return view('workwise.chats.index', [
            'data' => $data,
        ]);
    }

    public function store(Request $request) {
        
        $chat = $this->chat->store($request);

        return $chat ? $this->responseSuccess() : $this->responseError();
    }

    public function setStatusPivot(Request $request) {
        $data = $this->chat->setStatusPivot($request);

        return $data ? $this->responseSuccess() : $this->responseError();
    }

    public function search(Request $request) {
        $users = $this->chat->search($request);

        return $users ? $this->responseSuccess($users) : $this->responseError();
    }
}
