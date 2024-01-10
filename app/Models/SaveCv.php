<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveCv extends Model
{
    use HasFactory;

    protected $table = 'save_cvs';

    public function user() {
        return $this->beLongsTo(User::class);
    }
}
