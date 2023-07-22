<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;
use Log;

class UserInfo extends Model
{
    use HasFactory;

    protected $table = "user_infos";
    protected $fillable = [
        'user_id',
        'nick_name',
        'gender',
        'phone',
        'address',
        'birthday',
        'avatar',
        'cover_image',
        'links',
    ];

    const GENDER = [
        'FEMALE' => 1,
        'MALE' => 2,
        'OTHER' => 3,
    ];

    public static $gender_text = [
        self::GENDER['FEMALE'] => ['text' => 'Nữ', 'icon' => "/workwise/images/icons/-A1fdkjvECX.png"],
        self::GENDER['MALE'] => ['text' => 'Nam', 'icon' => "/workwise/images/icons/qXTmWu_dlXK.png"],
        self::GENDER['OTHER'] => ['text' => 'Khác', 'icon' => "/workwise/images/icons/p9D5De3o02X.png"],
    ];

    public function getGenderTextAttribute()
    {
        return self::$gender_text[$this->gender];
    }

    public function getNickNameUserAttribute() {
        return $this->nick_name ? $this->nick_name : 'Người dùng WorkWise';
    }

    public function getUrlCoverImageAttribute() {
        return url(Storage::url($this->cover_image));
    }

    public function getLinksUrlJsonAttribute() {
        return json_decode($this->links);
    }

    // Hàm kiểm tra avatar của người dùng với tham số "alternativeImage":
    // $alternativeImage là ảnh thay thế khi người dùng avatar của người dùng rỗng
    //str_contains
    //strpos
    public function CheckEmptyImage() {
        if($this->avatar) {
            if(str_contains($this->avatar, 'https://')) {
                return $this->avatar;
            }else{
                return url(Storage::url($this->avatar));
            }
        }
        return '/workwise/images/resources/user_empty.jpg';
    }
}
