<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentPost extends Model
{
    use HasFactory;

    protected $table = 'comment_post';

    public function user() {
        return $this->belongsTo(User::class);
    }
}
