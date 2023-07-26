<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;
use Log;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewCompany(User $user) {
        return $user->role == User::ROLE['EMPLOYER'];
    }

    public function view(User $user, User $model) {
        Log::info($user);
        Log::info($model);
        return $user->id === $model->id;
    }
}
