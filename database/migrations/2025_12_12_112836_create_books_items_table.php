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
        Schema::create('books_items', function (Blueprint $table) {
            $table->id();                                // PK

            $table->foreignId('book_id')                 // 親テーブル: books
                  ->constrained('books')
                  ->cascadeOnDelete();

            $table->string('item_number')->nullable();   // 冊子の管理番号
            $table->enum('status', ['available', 'loaned', 'lost', 'damaged'])
                  ->default('available');                // 状態（enum）

            $table->text('remarks')->nullable();         // 備考（自由メモ）
            $table->timestamps();                        // created_at / updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_items');
    }
};
