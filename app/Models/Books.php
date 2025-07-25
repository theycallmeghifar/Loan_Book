<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Books extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'books';
    
    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'authors',
        'isbn',
    ];
}
