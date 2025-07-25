<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class UsersController extends Controller
{
    public function index()
    {
        $users = Users::all();
        return view('users.index', compact('users'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'role' => 'required|string|in:librarian,member,admin',
        ]);

        try {
            users::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => $request->role,
            ]);
            return redirect()->back()->with('success', 'Data added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Failed to add data: ' . $e->getMessage());
        }
    }

    public function getUsersById(Request $request)
    {
        $user = users::find($request->id);

        if ($user) {
            return response()->json([
                'status' => true,
                'data' => $user
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
            'idUpdate' => 'required|exists:users,id',
            'nameUpdate' => 'required|string|max:255',
            'emailUpdate' => 'required|string|max:255',
            'passwordUpdate' => 'required|string|max:255',
            'phoneUpdate' => 'required|string|max:255',
            'addressUpdate' => 'required|string|max:255',
            'roleUpdate' => 'required|string|in:librarian,member,admin',
        ]);

        try {
            $user = users::findOrFail($request->idUpdate);

            $user->name = $request->nameUpdate;
            $user->email = $request->emailUpdate;
            $user->password = Hash::make($request->passwordUpdate);
            $user->phone = $request->phoneUpdate;
            $user->address = $request->addressUpdate;
            $user->role = $request->roleUpdate;
            $user->save();

            return redirect()->back()->with('success', 'Data updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Failed to update data.');
        }
    }

    public function delete($id)
    {
        try {
            $user = users::findOrFail($id);
            $user->delete();

            return response()->json(['success' => true, 'message' => 'Data deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete data.']);
        }
    }
}
