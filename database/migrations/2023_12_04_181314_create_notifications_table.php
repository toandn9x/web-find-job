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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('recipient_id')->index()->comment("Id của người nhận thông báo");
            $table->integer('sender_id')->index()->comment("Id của người gửi thông báo");
            $table->text('content')->nullable()->comment("Nội dung thông báo");
            $table->boolean('is_read')->default(false);
            $table->string('path', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
