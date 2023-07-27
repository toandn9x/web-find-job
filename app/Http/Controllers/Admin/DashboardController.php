<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Post;
use App\Services\UserService;
use App\Services\PostService;
use App\Services\JobService;

class DashboardController extends Controller
{
    private $user;

    public function __construct(UserService $userService) {
        $this->user = $userService;
    }
   
    public function index()
    {
        $users = $this->user->index();
        $posts = Post::select('id')->get();
        $jobs = Job::select('id')->get();

        return view('admin.home.dashboard', [
            'users' => $users,
            'posts' => $posts,
            'jobs' => $jobs,
        ]);
    }
}
