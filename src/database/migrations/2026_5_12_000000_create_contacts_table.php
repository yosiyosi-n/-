<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();                                                           // bigint unsigned / PRIMARY KEY / NOT NULL
            $table->foreignId('categry_id')->constrained('categories')->onDelete('cascade');
            $table->string('first_name', 255);                                      // varchar(255) / NOT NULL
            $table->string('last_name', 255);                                       // varchar(255) / NOT NULL
            $table->tinyInteger('gender');                                          // tinyint / NOT NULL (1:男性 2:女性 3:その他)
            $table->string('email', 255);                                           // varchar(255) / NOT NULL
            $table->string('tel', 255);                                             // varchar(255) / NOT NULL
            $table->string('address', 255);                                         // varchar(255) / NOT NULL
            $table->string('building', 255)->nullable();

            // 💡 追記：生年月日を西暦（YYYY-MM-DD）で安全に保存する日付型カラムを追加します
            $table->date('birth_date')->nullable();

            $table->text('detail');                                                 // text / NOT NULL
            $table->timestamps();                                                   // created_at, updated_at (timestamp)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};

