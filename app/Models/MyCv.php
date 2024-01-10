<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class MyCv extends Model
{
    use HasFactory;

    const STATUS = [
        "Awaiting" => 0,
        "Interview" => 1,
        "NotSuitable" => 2,
        "SuccessfulApplication" => 3,
    ];

    public static $status_text = [
        self::STATUS['Awaiting'] => "Đang chờ xét duyệt",
        self::STATUS['Interview'] => "Hẹn phỏng vấn",
        self::STATUS['NotSuitable'] => "Hồ sơ không phù hợp",
        self::STATUS['SuccessfulApplication'] => "Ứng tuyển thành công",
    ];

    public function getRoleTextAttribute() {
        return self::$status_text[$this->status];
    }

    public function getPathUrlAttribute() {
        return Storage::url($this->path);
    }

    public function user() {
        return $this->belongsTo(User::class); 
    }
}
