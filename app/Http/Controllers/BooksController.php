<?php

namespace App\Http\Controllers;

use App\Models\Books;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = Books::where('action', 'active')->latest()->paginate(5);
        return view('create.index', compact('books'));
    }
    public function create()
    {
        $books = Books::where('action', 'active')->latest()->paginate(5);
        return view('create.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|min:3',
                'price' => 'required|numeric|min:0',
                'quantity' => 'required|numeric|min:0',
                'publishedDate' => 'required',
            ],
            [
                'title.min' => 'Title must be at least 3 characters',
                'price.min' => 'Title must be at least 0 characters',
                'quantity.min' => 'Title must be at least 0 characters',
            ]
        );

        $authe = Auth()->user()->id;

        $authe = Auth()->user()->id;
        $part1 = rand(100, 999);
        $part2 = rand(10, 99);
        $part3 = rand(100, 999);
        $part4 = rand(10, 99);
        $part5 = rand(100, 999);
        $part6 = Auth()->user()->id . rand(10, 99);
        $isbn = $part1 . '-' . $part2 . '-' . $part3 . '-' . $part4 . '-' . $part5 . '-' . $part6;
        Books::create([
            'title' => $request->title,
            'author' => $authe,
            'isbn' => $isbn,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'published_date' => $request->publishedDate,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Create Successfully');


    }

    public function Edit($id)
    {
        $booksEdit = Books::where('action', 'active')->where('id', $id)->first();
        $books = Books::where('action', 'active')->latest()->paginate(5);
        return view('create.create', compact('booksEdit', 'books'));
    }

    public function update(Request $request, $id)
    {
        $booksEdit = Books::where('id', $id)->first();
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'publishedDate' => 'required',
        ]);

        $authe = Auth()->user()->id;
        $part1 = rand(100, 999);
        $part2 = rand(10, 99);
        $part3 = rand(100, 999);
        $part4 = rand(10, 99);
        $part5 = rand(100, 999);
        $part6 = Auth()->user()->id . rand(10, 99);
        $isbn = $part1 . '-' . $part2 . '-' . $part3 . '-' . $part4 . '-' . $part5 . '-' . $part6;
        Books::find($booksEdit->id)->update([
            'title' => $request->title,
            'author' => $authe,
            'isbn' => $isbn,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'published_date' => $request->publishedDate,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Update Successfully');


    }

    public function delete($id)
    {
        $booksEdit = Books::where('id', $id)->first();
        Books::find($booksEdit->id)->update([
            'action' => 'deactive',
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Delete Successfully');
    }

    public function search_title(Request $request)
    {

        $request->validate(['search' => 'required']);
        $search = $request->input('search');

        $books = Books::when($search, function ($query, $search) {
            $query->where('action', 'active')->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%");
        })->paginate(10);

        return view('create.index', compact('books'));

    }

    public function search_price(Request $request)
    {
        $request->validate([
            'lowPrice' => 'required',
            'highPrice' => 'required',
        ]);

        $lowPrice = $request->input('lowPrice');
        $highPrice = $request->input('highPrice');

        $books = Books::where('action', 'active')->whereBetween('price', [$lowPrice, $highPrice])
            ->paginate(10);
        return view('create.index', compact('books'));

    }



}
