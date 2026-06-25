<?php

namespace App\Http\Controllers;

use App\Models\BooksItem;
use App\Models\Action;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowController extends Controller
{
    public function borrow(Request $request, BooksItem $item)
    {
        // すでに貸出中なら NG
        if ($item->status === 'loaned') {
            return redirect()->back()->with('error', 'この冊子はすでに貸出中です');
        }

        // 貸出中にステータス変更
        $item->update([
            'status' => 'loaned',
        ]);

        // 貸出履歴（Action）を登録
        Action::create([
            'member_id'     => 1,              // 今は固定でOK
            'books_item_id' => $item->id,
            'action_type'   => 'borrow',
            'action_date'   => Carbon::now(),
            'due_date'      => Carbon::now()->addDays(14),
        ]);

        return redirect()->back()->with('success', '貸出しました 📚');
    }
}
