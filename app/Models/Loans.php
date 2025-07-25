<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loans extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'loans';

    public $timestamps = false;

    protected $fillable = [
        'book_id',
        'librarian_id',
        'member_id',
        'loan_at',
        'returned_at',
        'note',
    ];
}
