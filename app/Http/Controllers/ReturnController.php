<?php

namespace App\Http\Controllers;

use App\Models\BooksItem;
use App\Models\Action;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReturnController extends Controller
{
    /**
     * 冊子の返却処理（Web / Inertia 用）
     *
     * ・貸出中（loaned）の冊子のみ返却可能
     * ・冊子の状態を available に戻す
     * ・返却履歴を actions テーブルに記録する
     */
    public function store(BooksItem $item)
    {
        // ① 貸出中でなければ返却できない
        if ($item->status !== 'loaned') {
            return back()->with('error', 'この冊子は返却できません');
        }

        // ② 冊子更新＋履歴登録をトランザクションでまとめて処理
        DB::transaction(function () use ($item) {

            // 冊子の状態を「利用可能」に戻す
            $item->update([
                'status' => 'available',
            ]);

            // 返却履歴を actions テーブルに追加
            Action::create([
                'member_id'     => Auth::id(), // 返却したログインユーザー
                'books_item_id' => $item->id,  // 対象の冊子
                'action_type'   => 'return',   // 行動種別：返却
                'action_date'   => now(),      // 実行日時
            ]);
        });

        // ③ 処理完了後、一覧画面に戻してメッセージ表示
        return back()->with('success', '返却しました 😊');
    }
}
