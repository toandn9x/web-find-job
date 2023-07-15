<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Comment;
use Log;
use Auth;
use Carbon\Carbon;

class CommentService
{
    private $comment;

    public function __construct() {
        $this->comment = new Comment();
    }

    public function store(Request $request) {
        try {
            
            $data = $request->except('_token');
            $comment = $this->comment;
            $comment->user_id = Auth::user()->id;
            $comment->job_id = $data['_id'];
            $comment->content = $data['content'];
            $comment->save();
            
            return true;
        } catch (\Exception $e) {
            Log::error('Error store comment', [
                "method" => __METHOD__,
                "line" => __LINE__,
                "message" => $e->getMessage(),
                "data" => $request->all(),
            ]);
            return false;
        }
    }

    public function show($id) {
        $comments = Comment::where('job_id', $id)
                        ->where('parent_id', 0)
                        ->with(['user' => function($query){
                            $query->select('id','name')
                                    ->with(['userInfo' => function($query) {
                                        $query->select('user_id', 'avatar');
                                    }]);
                        }])
                        ->orderBy('created_at', 'DESC')
                        ->get();
        return $comments;
    }
}