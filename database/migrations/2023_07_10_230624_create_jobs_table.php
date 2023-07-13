<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->integer('company_id')->index();
            $table->text('title')->nullable()->comment('Tiêu đề tuyển dụng');
            $table->string('category', 255)->nullable()->comment('Ngành nghề');
            $table->integer('qty')->nullable()->comment('Số lượng tuyển');
            $table->integer('rank')->nullable()->comment('Cấp bậc');
            $table->integer('form_time_work')->nullable()->comment('Hình thức làm việc');
            $table->string('city', 255)->nullable();
            $table->text('address')->nullable()->comment('Địa chỉ làm việc chi tiết');
            $table->integer('currency')->nullable()->comment('Đơn vị tiền tệ: 1-VND, 2-USD');
            $table->integer('money_type')->nullable()->comment('Phương thức chọn kiểu trả lương: 1-Thỏa thuận, 2-Cố định, 3-Từ mức->Đến mức, 4-Trong khoảng');
            $table->bigInteger('money_min')->nullable();
            $table->bigInteger('money_max')->nullable();
            $table->integer('money_kg')->nullable();
            $table->text('description')->nullable()->comment('Mô tả công việc');
            $table->integer('experience')->nullable()->comment('Kinh nghiệm');
            $table->integer('degree')->nullable()->comment('Bằng cấp');
            $table->integer('gender')->nullable()->comment('Giới tính');
            $table->text('request_other')->nullable()->comment('Yêu cầu khác');
            $table->text('benefits_enjoyed')->nullable()->comment('Chế độ hưởng lợi');
            $table->text('job_application')->nullable()->comment('Hồ sơ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
