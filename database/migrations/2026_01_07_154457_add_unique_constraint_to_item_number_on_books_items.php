<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books_items', function (Blueprint $table) {
            // NOT NULL に変更
            $table->string('item_number')->nullable(false)->change();

            // unique 制約を追加
            $table->unique('item_number');
        });
    }

    public function down(): void
    {
        Schema::table('books_items', function (Blueprint $table) {
            $table->dropUnique(['item_number']);
            $table->string('item_number')->nullable()->change();
        });
    }
};
