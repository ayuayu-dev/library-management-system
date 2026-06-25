<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('actions', function (Blueprint $table) {
            // 外部キー制約を一旦外す
            $table->dropForeign(['member_id']);

            // nullable に変更
            $table->foreignId('member_id')->nullable()->change();

            // 外部キーを付け直す
            $table->foreign('member_id')
                ->references('id')
                ->on('members')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('actions', function (Blueprint $table) {
            // 外部キーを外す
            $table->dropForeign(['member_id']);

            // NOT NULL に戻す
            $table->foreignId('member_id')->nullable(false)->change();

            // 外部キーを付け直す（元に戻す）
            $table->foreign('member_id')
                ->references('id')
                ->on('members');
        });
    }
};
