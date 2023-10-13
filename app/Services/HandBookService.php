<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\HandBook;
use Str;
use Storage;
use Log;
use Carbon\Carbon;

class HandBookService
{
    private $handbook;

    public function __construct() {
        $this->handbook = new HandBook();
    }

    public function index() {
        $handbooks = HandBook::orderBy('created_at', 'DESC')->get();

        return $handbooks;
    }

    public function store(Request $request) {
        try {
            $post = $this->handbook;
            $post->title = $request->title;
            $post->slug = Str::slug($post->title).'-'.Str::random(5);
            $post->description = $request->description;
            $post->is_hot = $request->is_hot ? 1 : 0;
            $post->status = $request->status ? 1 : 0;
            $post->content = $request->content;
            $post->created_at = Carbon::now();

            if($request->has('file')) {
                $post->thumbnail = $this->handleUploadImage($request->file('file'));
            }
            $post->save();

        } catch (\Exception $e) {
            Log::error('Error create handbook', [
                'line' => __line__,
                'method' => __method__,
                'message' => $e->getMessage(),
                'data' => $request->all(),
            ]);
        }
    }

    public function detail($slug) {
        try {
            $handbook = HandBook::where('slug', $slug)->first();
            $randomHandbook = HandBook::all()->whereNotIn('id', [$handbook->id])->random(3);
            return [$handbook, $randomHandbook];
        } catch (\Exception $e) {
            Log::error('Error create handbook', [
                'line' => __line__,
                'method' => __method__,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getIsHotHandBook() {
        $handbooks = HandBook::where(['status' => 1, 'is_hot' => 1])->orderBy('created_at', 'DESC')->get();

        return $handbooks;
    }

    public function getHandBookPaginate() {
        $handbooks = HandBook::select('title', 'slug', 'description', 'thumbnail', 'is_hot')
                            ->where(['status' => 1, 'is_hot' => 0])
                            ->orderBy('created_at', 'DESC')
                            ->paginate(6);

        foreach ($handbooks as $handbook) {
            $handbook['thumbnail'] = $handbook->image_url;
        }

        return $handbooks;
    }

    private function handleUploadImage($data) {
        $file = $data;
        $random = Str::random(40);
        $name = $file->getClientOriginalName();
        $name = current(explode('.',$name));
        $name_image = $name.$random.'.'.$file->getClientOriginalExtension();
        $path = Storage::disk('public') ->putFileAs('hand_books', $file, $name_image);

        return $path;
    }
}