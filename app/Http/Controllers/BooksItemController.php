<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BooksItem;
use Inertia\Inertia;

class BooksItemController extends Controller
{
    public function index()
    {
        $items = BooksItem::with('book')
            ->orderBy('id', 'asc')
            ->get();

        return Inertia::render('BooksItems/Index', [
            'items' => $items,

            'breadcrumbs' => [
                ['label' => 'ダッシュボード', 'url' => route('dashboard')],
                ['label' => '冊子一覧'],
            ],
        ]);
    }
    public function indexByBook(Book $book)
    {
        $items = $book->booksItems()->with('book')->get();

        return Inertia::render('BooksItems/Index', [
            'book' => $book,
            'items' => $items,
            
            //パンくずリスト
            'breadcrumbs' => [
                [
                    'label' => 'ダッシュボード',
                    'url' => route('dashboard'),
                ],
                [
                    'label' => '書籍一覧',
                    'url' => route('books.index'),
                ],
                [
                    'label' => $book->title,
                    'url' => route('books.items.index', $book->id),
                ],
                [
                    'label' => '冊子一覧',
                ],
            ],
        ]);
    }

    public function create(Book $book)
    {
        return inertia('BooksItems/Create', [
            'book' => $book,
        ]);
    }

    public function store(Request $request, Book $book)
    {
        $validated = $request->validate([
            'inventory_code' => 'required|string|max:255',
            'status' => 'required|in:available,loaned,lost,damaged',
        ]);

        $book->booksItems()->create($validated);

        return redirect()->route('books.items.index', $book->id);
    }
}
