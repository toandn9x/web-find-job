<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PostService;
use Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    private $post;

    public function __construct(PostService $postService)
    {
        $this->post = $postService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->post->index();
       
        return view('workwise.home.dashboard', [
            'posts' => $posts,
        ]);
    }
}
