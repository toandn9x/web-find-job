<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FindJob extends Model
{
    use HasFactory;

    public function getJsonJobAttribute() {
        return json_decode($this->jobs, true);
    }

    public function getJsonAddressAttribute() {
        return json_decode($this->address, true);
    }
}
