<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('nguoi_dung', function (Blueprint $table) {
            $table->string('id')->primary();

            $table->string('ho_ten', 100)->nullable();

            $table->string('tai_khoan', 100)->nullable()->unique();

            $table->string('mat_khau', 255)->nullable();

            $table->string('so_dien_thoai', 20)->nullable();

            $table->string('email', 50)->unique();

            $table->string('avatar')->nullable();

            $table->string('vai_tro', 50);

            $table->string('dang_nhap_qua', 50)->nullable();

            $table->rememberToken();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nguoi_dung');
    }
};