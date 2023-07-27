<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\ImagePost;
use App\Models\CommentPost;
use Storage;
use Auth;
use Log;
use Str;
use Carbon\Carbon;

class PostService
{
    private $post;
    private $comment;

    public function __construct() {
        $this->post = new Post;
        $this->comment = new CommentPost;
    }

    public function index() {
        $posts = Post::select('id','user_id','title','content','status','background_post','created_at')
                        ->with([
                        "user" => function($query) {
                            $query->select('id','name');
                        }, 
                        "images" => function($query) {
                            $query->select('post_id','path');
                        }])
                        ->whereIn('status', [1,2])
                        ->orderBy('created_at', 'DESC')
                        ->get();
        return $posts;
    }

    public function showAll() {
        $posts = Post::all();
        return $posts;
    }

    public function store(Request $request) {
        try {
            $post = $this->post;
            $post->user_id = Auth::user()->id;
            $post->title = $request['title'];
            $post->content = $request['content'];
            $post->status = $request['status'];
            $post->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $post->emoji = $request['emoji'];
            $post->check_in = $request['check_in'];

            if($request->has('background_post')) {
                $post->background_post = $request['background_post'];
            }

            $post->save();

            if(isset($request['totalFiles']) || $request['totalFiles'] > 0) {
                for($index = 0; $index < $request['totalFiles']; $index++) {
                    if($request->hasFile('file'.$index)) {
                        $this->handleUploadPostImages($request->file('file'.$index), $post->id);
                    }
                }

            }
            return true;

        } catch (Exception $e) {
            Log::error("Error store post", [ 
                "method" => __METHOD__,                
                "line" => __LINE__,                    
                "message" => $e->getMessage(),
                "data" => $request->all(),       
            ]);
            return false;   
        }
    }

    public function show($id) {
        try {
            $images = [];
            $post = Post::select('id','user_id','content','background_post','title','status', 'created_at')
                        ->with(['user' => function($query) {
                            $query->select('id','name')->with(['userInfo' => function($query) {
                                $query->select('user_id', 'avatar');
                            }]);
                        }, 'likes' => function($query) {
                            $query->select('user_id')->count();
                        }, 'comments' => function($query) {
                            $query->select('post_id', 'content', 'user_id', 'created_at')
                                ->with(['user' => function($query) {
                                    $query->select('id', 'name')
                                        ->with(['userInfo' => function($query) {
                                            $query->select('user_id', 'avatar');
                                        }]);
                                }]);
                        }])
                        ->where('id', $id)
                        ->first();
                
            if(!empty($post->images)) {
                foreach ($post->images as $value) {
                    $images[] = [
                        'id' => $value->id,
                        'path' => $value->image_url,
                    ];
                }
               $post['imagePath'] = $images;
               $post['checkLike'] = $post->checkUserLike();
            }

            return $post;

        } catch (Exception $e) {
            Log::error("Error show post", [ 
                "method" => __METHOD__,                
                "line" => __LINE__,                    
                "message" => $id,
            ]);
            return false;
        }
    }

    public function edit($id) {
        try {
            
            $images = [];
            $post = Post::select('id','user_id','emoji','check_in','content','background_post','title','status')
                        ->with(['user' => function($query) {
                            $query->select('id','name');
                        }])
                        ->where('id', $id)
                        ->first();
                
            if(!empty($post->images)) {
                foreach ($post->images as $value) {
                    $images[] = [
                        'id' => $value->id,
                        'path' => $value->image_url,
                    ];
                }
               $post['imagePath'] = $images;
            }

            return $post;

        } catch (Exception $e) {
            Log::error("Error edit post", [ 
                "method" => __METHOD__,                
                "line" => __LINE__,                    
                "message" => $e->getMessage(),
            ]);
            return false;
        }
    }

    public function update(Request $request) {
        try {
            $post = Post::find($request['post_id']);
            $post->title = $request['title'];
            $post->content = $request['content'];
            $post->status = $request['status'];
            $post->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            if($request->has('background_post')) {
                $post->background_post = $request['background_post'];
            }
            if(!empty($request['emoji'])) {
                $post->emoji = $request['emoji'];
            }

            if(!empty($request['check_in'])) {
                $post->check_in = $request['check_in'];
            }
            $post->save();

            if(isset($request['totalFiles']) || $request['totalFiles'] > 0) {
                for($index = 0; $index < $request['totalFiles']; $index++) {
                    if($request->hasFile('file'.$index)) {
                        $this->handleUploadPostImages($request->file('file'.$index), $post->id);
                    }
                }
            }

            if(isset($request['file_remove'])) {
                foreach(json_decode($request['file_remove']) as $value) {
                    $this->handleRemovePostImages($value);
                }
            }

            return true;
        } catch (\Exception $e) {
            Log::error("Error update post", [
                "method" => __METHOD__,
                "line" => __LINE__,
                "message" => $e->getMessage(),
                "data" => $request->all(),
            ]);
            
            return false;
        }
    }

    public function destroy($id) {
        try {
            Post::destroy($id);

            return true;

        } catch (\Exception $e) {
            Log::error('Error destroy post', [
                "method" => __METHOD__,
                "line" => __LINE__,
                "message" => $e->getMessage(),
            ]);
            return false;
        }
    }

    public function like(Request $request) {
        try {
            $data = $request->except('_token');
            $user_id = Auth::user()->id;
            $post = Post::find($data['_id']);
           
            if($post->checkUserLike()) {
                $post->likes()->detach($user_id);
            }else{
                $post->likes()->attach($user_id);
            }

            return $post;
        } catch (\Exception $e) {
            Log::error('Error like post', [
                "method" => __METHOD__,
                "line" => __LINE__,
                "message" => $e->getMessage(),
                "data" => $request->all(),
            ]);
            return false;
        }
    }

    public function comment(Request $request) {
        try {
            $data = $request->except('_token');
            $comment = $this->comment;
            $comment->post_id = $data['_id'];
            $comment->user_id = Auth::user()->id;
            $comment->content = $data['content'];
            $comment->created_at = Carbon::now();
            $comment->save();

            return true;
        } catch (\Exception $e) {
            Log::error('Error comment post', [
                "method" => __METHOD__,
                "line" => __LINE__,
                "message" => $e->getMessage(),
                "data" => $request->all(),
            ]);
            return false;
        }
    }

    private function handleUploadPostImages($data, $id) {
        try {
            $file = $data;
            $random = Str::random(40);
            $name = $file->getClientOriginalName();
            $name = current(explode('.',$name));
            $name_image = $name.$random.'.'.$file->getClientOriginalExtension();
            $path = Storage::disk('public') ->putFileAs('posts', $file, $name_image);

            $image = new ImagePost();
            $image->name = $name;
            $image->path = $path;
            $image->post_id = $id;

            $image->save();
            return true;

        } catch (Exception $e) {
            Log::error("Error upload post images", [ 
                "method" => __METHOD__,                
                "line" => __LINE__,                    
                "message" => $e->getMessage(),
                "data" => $data,       
            ]);
            return false;                                  
        }
    }

    private function handleRemovePostImages($id) {
        try {
            $image = ImagePost::find($id);
            Storage::disk($image->disk)->delete($image->path);
            $image->delete();
        } catch (\Throwable $th) {
            Log::error("Error remove post images", [ 
                "method" => __METHOD__,                
                "line" => __LINE__,                    
                "message" => $e->getMessage(),
                "data" => $id,       
            ]);
            return false;       
        }
        
    }
}