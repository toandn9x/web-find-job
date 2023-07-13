<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';
    protected $fillable = [
        'user_id',
        'title',
        'status',
        'content',
        'background_post',
        'emoji',
        'check_in',
    ];
    protected $hidden = [
        'deleted_at',
    ];

    public function getFormatDateAttribute() {
        $format = date('d', strtotime($this->created_at)). ' Tháng '. date('m', strtotime($this->created_at)). ', '. date('Y', strtotime($this->created_at));

        return $format;
    }

    public function getTime() {
        $time = Carbon::parse($this->created_at)->toDayDateTimeString();
        $day = $this->formatDay(Str::substr($time, 0, 3));

        return $day. ', '. $this->getFormatDateAttribute(). ' lúc '. date('H:i', strtotime($this->created_at));
    }

    public function user() {
        return $this->beLongsTo(User::class,'user_id', 'id');
    }

    public function images() {
        return $this->hasMany(ImagePost::class);
    }

    function formatDay($day) {
        $d = "";
        switch ($day) {
            case 'Mon':
                $d = "Thứ Hai";
                break;
            case 'Tue':
                $d = "Thứ Ba";
                break;
            case 'Wed':
                $d = "Thứ Tư";
                break;
            case 'Thu':
                $d = "Thứ Năm";
                break;
            case 'Fri':
                $d = "Thứ Sáu";
                break;
            case 'Sat':
                $d = "Thứ Bảy";
                break;
            case 'Sun':
                $d = "Chủ Nhật";
                break;
        }
        return $d;
    }
}
