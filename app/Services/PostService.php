<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\ImagePost;
use Storage;
use Auth;
use Log;
use Carbon\Carbon;

class PostService
{
    private $post;

    public function __construct() {
        $this->post = new Post;
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
                        // ->orderBy('created_at', 'DESC')
                        ->get();
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
            Log::error("Error show post", [ 
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

    private function handleUploadPostImages($data, $id) {
        try {
            $file = $data;
            $name = $file->getClientOriginalName();
            $name = current(explode('.',$name));
            $name_image = $name.rand(0,99).'.'.$file->getClientOriginalExtension();
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