<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;


class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return view('categories.index', compact('categories'));
    }

    public function getAllCategories(Request $request)
    {
        $categories = Categories::all();

        if ($categories->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'data' => $categories
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
            'name' => 'required|string|max:255',
        ]);

        try {
            Categories::create([
                'name' => $request->name,
            ]);
            return redirect()->back()->with('success', 'Data added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Failed to add data.');
        }
    }

    public function getCategoriesById(Request $request)
    {
        $category = Categories::find($request->id);

        if ($category) {
            return response()->json([
                'status' => true,
                'data' => $category
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
            'idUpdate' => 'required|exists:categories,id',
            'nameUpdate' => 'required|string|max:255',
        ]);

        try {
            $category = Categories::findOrFail($request->idUpdate);

            $category->name = $request->nameUpdate;
            $category->save();

            return redirect()->back()->with('success', 'Data updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Failed to update data.');
        }
    }

    public function delete($id)
    {
        try {
            $category = Categories::findOrFail($id);
            $category->delete();

            return response()->json(['success' => true, 'message' => 'Data deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete data.']);
        }
    }
}
