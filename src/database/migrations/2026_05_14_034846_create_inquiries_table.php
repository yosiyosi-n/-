<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // 姓
            $table->string('last_name');  // 名
            $table->tinyInteger('gender'); // 性別（1:男性, 2:女性, 3:その他）
            $table->string('email');
            $table->string('telephone_one');   // 電話番号1
            $table->string('telephone_two');   // 電話番号2
            $table->string('telephone_three'); // 電話番号3
            $table->string('address');
            $table->string('building_name')->nullable(); // 建物名（空欄を許可）
            $table->tinyInteger('inquiry_type'); // お問い合わせの種類（1〜5）
            $table->text('content'); // お問い合わせの内容
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
