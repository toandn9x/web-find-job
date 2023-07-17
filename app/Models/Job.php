<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;
use Auth;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jobs';
    
    // Cấp bậc
    const RANK = [
        'INTERN' => 1,
        'STAFF' => 2,
        'LEADER' => 3,
        'MANAGER' => 4,
        'VICE_PRESIDENT' => 5,
        'PRESIDENT' => 6,
        'OTHER' => 7,
    ];

    // Hình thức làm việc
    const METHOD_WOKR = [
        'FULLTIME' => 1,
        'PARTTIME' => 2,
        'REMOTE' => 3,
        'CONTRACT' => 4,
        'OTHER' => 5,
    ];

    // Bằng cấp
    const DEGREE = [
        'NOT_REQUIRED' => 1,
        'UNIVERSITY' => 2,
        'BACHELOR' => 3,
        'CERTIFICATE' => 4,
        'MASTERS' => 5,
        'DOCTOR' => 6,
        'OTHER' => 7,
    ];
    
    // Giới tính
    const GENDER = [
        'NOT_REQUIRED' => 1,
        'MALE' => 2,
        'FEMALE' => 3,
        'OTHER' => 4,
    ];

    // Kinh nghiệm
    const EXPERIENCE = [
        'NOT_REQUIRED' => 1,
        'NOT_EXPERIENCE' => 2,
        'ZERO_TO_ONE' => 3,
        'OVER_ONE_YEAR' => 4,
        'MORE_THAN_FIVE_YEARS' => 5,
        'MORE_THAN_TEN_YEARS' => 6,
        'OTHER' => 7,
    ];

    const MONEY = [
        'LEVEL_1' => 1,
        'LEVEL_2' => 2,
        'LEVEL_3' => 3,
        'LEVEL_4' => 4,
        'LEVEL_5' => 5,
        'LEVEL_6' => 6,
        'LEVEL_7' => 7,
        'LEVEL_8' => 8,
        'LEVEL_9' => 9,
    ];

    public static $money_text = [
        self::MONEY['LEVEL_1'] => "1 - 3 triệu",
        self::MONEY['LEVEL_2'] => "3 - 5 triệu",
        self::MONEY['LEVEL_3'] => "5 - 7 triệu",
        self::MONEY['LEVEL_4'] => "7 - 10 triệu",
        self::MONEY['LEVEL_5'] => "10 - 15 triệu",
        self::MONEY['LEVEL_6'] => "15 - 20 triệu",
        self::MONEY['LEVEL_7'] => "Trên 30 triệu",
        self::MONEY['LEVEL_8'] => "Trên 50 triệu",
        self::MONEY['LEVEL_9'] => "Trên 100 triệu",
    ];
    
    public static $exp_text = [
        self::EXPERIENCE['NOT_REQUIRED'] => "Không yêu cầu",
        self::EXPERIENCE['NOT_EXPERIENCE'] => "Chưa có kinh nghiệm",
        self::EXPERIENCE['ZERO_TO_ONE'] => "0 - 1 năm kinh nghiệm",
        self::EXPERIENCE['OVER_ONE_YEAR'] => "Hơn 1 năm kinh nghiệm",
        self::EXPERIENCE['MORE_THAN_FIVE_YEARS'] => "Hơn 5 năm kinh nghiệm",
        self::EXPERIENCE['MORE_THAN_TEN_YEARS'] => "Hơn 10 năm kinh nghiệm",
        self::EXPERIENCE['OTHER'] => "Khác",
    ];

    public static $rank_text = [
        self::RANK['INTERN'] => "Thực tập sinh",
        self::RANK['STAFF'] => "Nhân viên",
        self::RANK['LEADER'] => "Nhóm trưởng",
        self::RANK['MANAGER'] => "Trưởng phòng",
        self::RANK['VICE_PRESIDENT'] => "Phó giám đốc",
        self::RANK['PRESIDENT'] => "Giám đốc",
        self::RANK['OTHER'] => "Khác",
    ];

   public static $method_work_text = [
        self::METHOD_WOKR['FULLTIME'] => "Làm việc toàn thời gian",
        self::METHOD_WOKR['PARTTIME'] => "Làm việc bán thời gian",
        self::METHOD_WOKR['REMOTE'] => "Làm việc từ xa",
        self::METHOD_WOKR['CONTRACT'] => "Hợp đồng",
        self::METHOD_WOKR['OTHER'] => "Khác",
    ];

    public static $degree_text = [
        self::DEGREE['NOT_REQUIRED'] => "Không yêu cầu",
        self::DEGREE['UNIVERSITY'] => "Đại học",
        self::DEGREE['BACHELOR'] => "Cử nhân",
        self::DEGREE['CERTIFICATE'] => "Chứng chỉ",
        self::DEGREE['MASTERS'] => "Thạc sĩ",
        self::DEGREE['DOCTOR'] => "Tiến sĩ",
        self::DEGREE['OTHER'] => "Khác",
    ];

    public static $gender_text = [
        self::GENDER['NOT_REQUIRED'] => "Không yêu cầu",
        self::GENDER['MALE'] => "Nam",
        self::GENDER['FEMALE'] => "Nữ",
        self::GENDER['OTHER'] => "Khác",
    ];

    public function getRankTextAttribute() {
        return self::$rank_text[$this->rank];
    }

    public function getMethodWorkTextAttribute() {
        return self::$method_work_text[$this->form_time_work];
    }

    public function getDegreeTextAttribute() {
        return self::$degree_text[$this->degree];
    }

    public function getExpTextAttribute() {
        return self::$exp_text[$this->experience];
    }

    public function getGenderTextAttribute() {
        return self::$gender_text[$this->gender];
    }

    public function getMoneyTextAttribute() {
        return self::$money_text[$this->money_kg];
    }

    public function getTitleLimitAttribute() {
        return Str::limit($this->title, 100);
    }

    //Hàm kiểm tra xem người dùng đã like tin chưa
    public function checkLike() {
        $check = $this->likes()->where('user_id', Auth::user()->id)->first();
        if($check) {
            return true;
        }
        return false;
    }

    //Scope

    public function scopeTitle($query, $request) {
        if($request->has('keyword')) {
            $query->where('title', 'LIKE','%'. $request->get('keyword') .'%')
                    ->orWhere('category', 'LIKE','%'. $request->get('keyword') .'%');
        }
        return $query;
    }

    public function scopeCity($query, $request) {
        if($request->has('city')) {
            $query->where('city', 'LIKE','%'. $request->get('city') .'%')
                    ->orWhere('address', 'LIKE','%'. $request->get('city') .'%');
        }
        return $query;
    }

    public function scopeRank($query, $request) {
        if($request->get('rank') != 0) {
            $query->where('rank', $request->get('rank'));
        }
        return $query;
    }

    public function scopeMethodWork($query, $request) {
        if($request->get('method_work') != 0) {
            $query->where('form_time_work', $request->get('method_work'));
        }
        return $query;
    }

    public function scopeExp($query, $request) {
        if($request->get('exp') != 0) {
            $query->where('experience', $request->get('exp'));
        }
        return $query;
    }

    // Relationship
    public function company() {
        return $this->beLongsTo(Company::class);
    }

    public function likes() {
        return $this->beLongsToMany(User::class, 'job_like');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
