<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\BooksItem;
use App\Models\Action;
use Illuminate\Http\Request;

class LoanQuickController extends Controller
{

    public function index()
    {
        return Inertia::render('Loans/Quick', [
            'breadcrumbs' => [
                ['label' => 'ダッシュボード', 'url' => route('dashboard')],
                ['label' => '貸出・返却'],
            ],
        ]);
    }

    public function store(Request $request)
    {
        // ① 入力チェック
        $request->validate([
            'item_number' => ['required', 'string'],
        ]);

        // ② 冊子番号から検索
        $item = BooksItem::where('item_number', $request->item_number)->first();

        if (! $item) {
            return redirect()
                ->route('loans.quick')
                ->with('error', '冊子が見つかりませんでした');
        }

        // ③ 状態で分岐
        if ($item->status === 'available') {
            // 貸出処理
            $item->update([
                'status' => 'loaned',
            ]);

            Action::create([
                'books_item_id' => $item->id,
                'action_type'   => 'borrow',
                'action_date'   => now(),
            ]);
            return redirect()
                ->route('loans.quick')
                ->with('success', '貸出しました');
        }

        if ($item->status === 'loaned') {
            // 返却処理
            $item->update([
                'status' => 'available',
            ]);

            Action::create([
                'books_item_id' => $item->id,
                'action_type'   => 'return',
                'action_date'   => now(),
            ]);
            return redirect()
                ->route('loans.quick')
                ->with('success', '返却しました');
        }

        // ④ その他（lost / damaged）
        return redirect()
            ->route('loans.quick')
            ->with('error', 'この冊子は現在操作できません');
    }
}
