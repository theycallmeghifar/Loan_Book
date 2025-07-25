<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BooksController extends Controller
{
    public function index()
    {
        $books = Books::all();
        return view('books.index', compact('books'));
    }

    public function getAllBooks(Request $request)
    {
        $books = Books::all();

        if ($books->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'data' => $books
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data not found'
            ], 404);
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'authors' => 'required|string|max:255',
            'isbn' => 'required|string|max:255',
        ]);

        try {
            Books::create([
                'title' => $request->title,
                'description' => $request->description,
                'authors' => $request->authors,
                'isbn' => $request->isbn,
            ]);
            return redirect()->back()->with('success', 'Data added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Failed to add data.');
        }
    }

    public function getBooksById(Request $request)
    {
        $book = Books::find($request->id);

        if ($book) {
            return response()->json([
                'status' => true,
                'data' => $book
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data not found'
            ], 404);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'idUpdate' => 'required|exists:books,id',
            'titleUpdate' => 'required|string|max:255',
            'descriptionUpdate' => 'required|string',
            'authorsUpdate' => 'required|string|max:255',
            'isbnUpdate' => 'required|string|max:255',
        ]);

        try {
            $book = Books::findOrFail($request->idUpdate);

            $book->title = $request->titleUpdate;
            $book->authors = $request->authorsUpdate;
            $book->description = $request->descriptionUpdate;
            $book->isbn = $request->isbnUpdate;
            $book->save();

            return redirect()->back()->with('success', 'Data updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Failed to update data.');
        }
    }

    public function delete($id)
    {
        try {
            $book = Books::findOrFail($id);
            $book->delete();

            return response()->json(['success' => true, 'message' => 'Data deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete data.']);
        }
    }
}
