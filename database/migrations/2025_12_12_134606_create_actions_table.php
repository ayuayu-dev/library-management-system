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
        Schema::create('actions', function (Blueprint $table) {
            $table->id();  // PK

            $table->foreignId('member_id')             // 利用者
                  ->constrained('members')
                  ->cascadeOnDelete();

            $table->foreignId('books_item_id')         // 借りた冊子（本の１つ）
                  ->constrained('books_items')
                  ->cascadeOnDelete();

            $table->enum('action_type', ['borrow', 'return', 'reserve']);
              // borrow = 貸出、return = 返却、reserve = 予約

            $table->dateTime('action_date');           // この行動が起きた日時

            $table->date('due_date')->nullable();       // 返却期限（借りた時だけ使う）

            $table->timestamps();                       // created_at / updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};
