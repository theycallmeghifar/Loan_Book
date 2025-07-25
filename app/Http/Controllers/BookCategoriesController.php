<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Categories;
use App\Models\BookCategories;

class BookCategoriesController extends Controller
{
    public function index()
    {
        $bookCategories = BookCategories::all();
        $books = Books::all();
        $categories = Categories::all();

        return view('bookCategories.index', compact('bookCategories', 'books', 'categories'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'book_id' => 'exists:books,id',
            'category_id' => 'exists:categories,id',
        ]);

        try {
            BookCategories::create([
                'book_id' => $request->book_id,
                'category_id' => $request->category_id,
            ]);
            return redirect()->back()->with('success', 'Data added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Failed to add data.');
        }
    }

    public function getBookCategoriesById(Request $request)
    {
        $bookCategory = BookCategories::find($request->id);

        if ($bookCategory) {
            return response()->json([
                'status' => true,
                'data' => $bookCategory
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
            'idUpdate' => 'required|exists:book_categories,id',
            'book_idUpdate' => 'required|exists:books,id',
            'category_idUpdate' => 'required|exists:categories,id',
        ]);

        try {
            $bookCategory = BookCategories::findOrFail($request->idUpdate);

            $bookCategory->book_id = $request->book_idUpdate;
            $bookCategory->category_id = $request->category_idUpdate;
            $bookCategory->save();

            return redirect()->back()->with('success', 'Data updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Failed to update data.');
        }
    }

    public function delete($id)
    {
        try {
            $bookCategory = BookCategories::findOrFail($id);
            $bookCategory->delete();

            return response()->json(['success' => true, 'message' => 'Data deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete data.']);
        }
    }
}
