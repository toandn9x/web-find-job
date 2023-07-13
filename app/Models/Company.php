<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'path',
        'introduce',
    ];

    public function getImageUrlAttribute() {
        return $this->path ? url(Storage::url($this->path)) : '/workwise/images/cover_images/201738242017-10-073138735Empty-company.jpg';
    }

    public function jobs() {
        return $this->hasMany(Job::class);
    }
}
