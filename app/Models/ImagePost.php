<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class ImagePost extends Model
{
    use HasFactory;

    protected $table = 'image_posts';
    protected $fillable = [
        'post_id',
        'name',
        'path',
    ];

    protected $hidden = [
        'disk',
    ];

    public function getImageUrlAttribute() {
        return url(Storage::url($this->path));
    }
}
