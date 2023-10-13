<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class HandBook extends Model
{
    use HasFactory;

    public function getImageUrlAttribute() {
        return Storage::url($this->thumbnail);
    }
}
