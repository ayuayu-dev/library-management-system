<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Services\ItemNumberGenerator;

class BookController extends Controller
{
    // 一覧
    public function index(Request $request)
    {
        //検索キーワード取得
        $keyword = $request->input('keyword');

        //booksテーブルからデータ取得（子テーブルのbooks_items情報も一緒に取得）
        $books = Book::with('booksItems')
            //検索キーワードが入力されている時のみwhere文を付与
            ->when($keyword, function ($query, $keyword) {
                //タイトルを部分一致検索する
                $query->where('title', 'like', "%{$keyword}%");
            })
            //登録日時順（created_at）に表示する
            ->orderByDesc('created_at')
            //1ページに30件表示する
            ->paginate(30)
            ->withQueryString();

        //Vue(Books/Index)へデータを渡して画面を表示
        return Inertia::render('Books/Index', [
            //booksテーブルから取得したデータ
            'books' => $books,
            //パンくずリスト
            'breadcrumbs' => [
                ['label' => 'ダッシュボード', 'url' => route('dashboard')],
                ['label' => '書籍一覧'],
            ],
            //検索キーワード
            'filters' => [
                'keyword' => $keyword,
            ],
        ]);
    }


    // 作成フォーム
    public function create()
    {
        return Inertia::render('Books/Create', [
            'authors' => Author::all(),
            'categories' => Category::all(),
            'breadcrumbs' => [
                ['label' => 'ダッシュボード', 'url' => route('dashboard')],
                ['label' => '書籍一覧', 'url' => route('books.index')],
                ['label' => '書籍を登録'],
            ],
        ]);
    }

    // 保存処理
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => ['required'],
            'author' => ['nullable'],
            'publisher' => ['nullable'],
            'isbn' => ['nullable'],
            'published_year' => ['nullable', 'integer'],
            'category_id' => ['required'],
            'description' => ['nullable'],
            'start_stock' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($validated) {

            // ① books を作る
            $book = Book::create([
                'title' => $validated['title'],
                'author' => $validated['author'],
                'publisher' => $validated['publisher'],
                'isbn' => $validated['isbn'],
                'category_id' => $validated['category_id'],
                'description' => $validated['description'],
                'published_year' => $validated['published_year'],
                'start_stock' => $validated['start_stock'],
            ]);

            // ② start_stock の数だけ冊子を作る
            for ($i = 1; $i <= $validated['start_stock']; $i++) {

                $book->booksItems()->create([
                    'status'      => 'available',
                    'item_number' => ItemNumberGenerator::generate($book->id, $i),
                ]);
            }
        });

        return redirect()
            ->route('books.index')
            ->with('success', '書籍を登録しました！');
    }

    // 編集画面
    public function edit(Book $book)
    {
        return Inertia::render('Books/Edit', [
            'book' => $book,
            'breadcrumbs' => [
                ['label' => 'ダッシュボード', 'url' => route('dashboard')],
                ['label' => '書籍一覧', 'url' => route('books.index')],
                ['label' => '書籍を編集'],
            ],
            'categories' => Category::all(),
        ]);
    }

    // 更新処理
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'nullable|string',
            'isbn' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'published_year' => 'nullable|integer',
        ]);

        $book->update($validated);

        return redirect()
            ->route('books.index')
            ->with('success', '書籍情報を更新しました！');
    }

    // 削除
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index');
    }
}
