<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookqty extends Model
{
    use HasFactory;

    protected $table = 'tbl_book_qty';

    protected $fillable = [
        'book_id',
        'qty',
        'format',
    ];
}
