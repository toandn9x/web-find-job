<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Traits\ResponseTrait;
use Log;

class PostController extends Controller
{
    use ResponseTrait;

    private $post;

    public function __construct(PostService $postService) {
        $this->post = $postService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->post->store($request);

        return $this->responseSuccess();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = $request->only('post_id');
        $post = $this->post->edit($data['post_id']);

        return $post ? $this->responseSuccess($post) : $this->responseError();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $post = $this->post->update($request);
        return $post ? $this->responseSuccess() : $this->responseError();
    }

    // public function delete(Request $request)
    // {
        
    // }

    public function destroy(Request $request)
    {
        $data = $request->only("post_id");
        $post = $this->post->destroy($data['post_id']);

        return $post ? $this->responseSuccess() : $this->responseError();
    }
}
