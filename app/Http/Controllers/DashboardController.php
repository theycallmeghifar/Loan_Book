<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $popularBooks = DB::table('loans as l')
            ->join('books as b', 'l.book_id', '=', 'b.id')
            ->select('l.book_id', 'b.title AS book_title', DB::raw('COUNT(*) AS total'))
            ->where('l.loan_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('l.book_id', 'b.title')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $membersNotReturned = collect();
        if ($user && $user->role !== 'member') {
            $membersNotReturned = DB::table('loans as l')
                ->join('users as u', 'l.member_id', '=', 'u.id')
                ->join('books as b', 'l.book_id', '=', 'b.id')
                ->select('l.book_id', 'u.name AS member_name', 'b.title AS book_title')
                ->whereNull('l.returned_at')
                ->get();
        }
        
        $myCurrentLoans = collect();
        if ($user && $user->role === 'member') {
            $myCurrentLoans = DB::table('loans as l')
                ->join('books as b', 'l.book_id', '=', 'b.id')
                ->select('l.book_id', 'b.title AS book_title', 'l.loan_at')
                ->where('l.member_id', $user->id)
                ->whereNull('l.returned_at')
                ->get();
        }

        return view('dashboard.index', compact('popularBooks', 'membersNotReturned', 'myCurrentLoans'));
    }
}
