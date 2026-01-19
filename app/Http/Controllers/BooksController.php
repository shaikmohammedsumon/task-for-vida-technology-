<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class BooksController extends Controller
{
    public function index(Request $request)
    {
        $books = Books::where('action', 'active');

        if ($request->filled('search')) {
            $search = $request->search;

            $books->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")->orWhere('author', 'like', "%{$search}%");
            });
        }elseif($request->filled('lowPrice') && $request->filled('highPrice')) {
            $books->whereBetween('price', [$request->lowPrice,$request->highPrice]);
        }

        $books = $books->latest()->paginate(5)->withQueryString();

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
                'image' => 'required',

            ],
            [
                'title.min' => 'Title must be at least 3 characters',
                'price.min' => 'Title must be at least 0 characters',
                'quantity.min' => 'Title must be at least 0 characters',
            ]
        );
        if (Auth::user()) {
            $authe = Auth::user()->id;

            if ($request->hasFile('image')) {
                $imageName = ImageHelper::upload($request->file('image'), 'uploads/books');

                $authe = Auth::user()->id;
                $part1 = rand(100, 999);
                $part2 = rand(10, 99);
                $part3 = rand(100, 999);
                $part4 = rand(10, 99);
                $part5 = rand(100, 999);
                $part6 = Auth::user()->id . rand(10, 99);
                $isbn = $part1 . '-' . $part2 . '-' . $part3 . '-' . $part4 . '-' . $part5 . '-' . $part6;
                Books::create([
                    'title' => $request->title,
                    'author' => $authe,
                    'isbn' => $isbn,
                    'price' => $request->price,
                    'quantity' => $request->quantity,
                    'image' => $imageName,
                    'published_date' => $request->publishedDate,
                    'created_at' => now(),
                ]);

                return back()->with('success', 'Create Successfully');
            }

        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to create a book.');
        }



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

        $authe = Auth::user()->id;
        $part1 = rand(100, 999);
        $part2 = rand(10, 99);
        $part3 = rand(100, 999);
        $part4 = rand(10, 99);
        $part5 = rand(100, 999);
        $part6 = Auth::user()->id . rand(10, 99);
        $isbn = $part1 . '-' . $part2 . '-' . $part3 . '-' . $part4 . '-' . $part5 . '-' . $part6;



        if ($request->hasFile('image')) {
            $imageName = ImageHelper::upload($request->file('image'), 'uploads/books');
            if ($booksEdit->image) {
                ImageHelper::delete('uploads/books', $booksEdit->image);

                Books::find($booksEdit->id)->update([
                    'title' => $request->title,
                    'author' => $authe,
                    'isbn' => $isbn,
                    'price' => $request->price,
                    'quantity' => $request->quantity,
                    'published_date' => $request->publishedDate,
                    'image' => $imageName,
                    'updated_at' => now(),
                ]);

                return back()->with('success', 'Update Successfully');
            }

        } else {
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



}
