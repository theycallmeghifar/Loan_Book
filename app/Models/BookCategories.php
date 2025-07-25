<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookCategories extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'book_categories';

    public $timestamps = true;

    protected $fillable = [
        'book_id',
        'category_id',
    ];
}
