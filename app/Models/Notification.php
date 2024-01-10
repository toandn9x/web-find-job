<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
                                                           
class Notification extends Model
{
    use HasFactory;

    public function recipient() {
        return $this->belongsTo(User::class, 'recipient_id ', 'id');
    }

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function getTimeAgo($carbonObject) {
        Carbon::setLocale('vi');
        $now = Carbon::now();

        return $carbonObject->diffForHumans($now);
    }
}
