<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Users;
use App\Models\Loans;

class LoansController extends Controller
{
    public function index()
    {
        $loans = Loans::all();
        $books = Books::all();
        $librarians = Users::where('role', 'librarian')->get();
        $members = Users::where('role', 'member')->get();

        return view('loans.index', compact('loans', 'books', 'librarians', 'members'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'librarian_id' => 'required|exists:users,id',
            'member_id' => 'required|exists:users,id',
            'loan_at' => 'required|date',
            'returned_at' => 'nullable|date',
            'note' => 'string|max:255',
        ]);

        try {
            Loans::create([
                'book_id' => $request->book_id,
                'librarian_id' => $request->librarian_id,
                'member_id' => $request->member_id,
                'loan_at' => Carbon::parse($request->loan_at)->format('Y-m-d H:i:s'),
                'returned_at'  => $request->returned_at
                    ? Carbon::parse($request->returned_at)->format('Y-m-d H:i:s')
                    : null,
                'note' => $request->note,
            ]);
            return redirect()->back()->with('success', 'Data added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Failed to add data.');
        }
    }

    public function getLoansById(Request $request)
    {
        $loan = loans::find($request->id);

        if ($loan) {
            return response()->json([
                'status' => true,
                'data' => $loan
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
            'idUpdate' => 'required|exists:loans,id',
            'book_idUpdate' => 'required|exists:books,id',
            'librarian_idUpdate' => 'required|exists:users,id',
            'member_idUpdate' => 'required|exists:users,id',
            'loan_atUpdate' => 'required|date',
            'returned_atUpdate' => 'nullable|date',
            'noteUpdate' => 'required|string|max:255',
        ]);

        try {
            $loan = Loans::findOrFail($request->idUpdate);

            $loan->book_id = $request->book_idUpdate;
            $loan->librarian_id = $request->librarian_idUpdate;
            $loan->member_id = $request->member_idUpdate;
            $loan->loan_at = $request->loan_atUpdate;
            $loan->returned_at = $request->returned_atUpdate;
            $loan->note = $request->noteUpdate;
            $loan->save();

            return redirect()->back()->with('success', 'Data updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Failed to update data.');
        }
    }

    public function delete($id)
    {
        try {
            $loan = Loans::findOrFail($id);
            $loan->delete();

            return response()->json(['success' => true, 'message' => 'Data deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete data.']);
        }
    }
}
