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
        Schema::create('books', function (Blueprint $table) {
            $table->id();                          // PK
            $table->string('title');               // タイトル
            $table->string('author');              // 著者名
            $table->string('publisher')->nullable(); // 出版社
            $table->string('isbn')->nullable();    // ISBN
            $table->foreignId('category_id')       // カテゴリID
                  ->constrained('categories')      // categories.id を参照
                  ->cascadeOnDelete();             // カテゴリ削除時に紐付く本も削除
            $table->text('description')->nullable(); // 説明文
            $table->timestamps();                  // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
