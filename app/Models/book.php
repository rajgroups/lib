<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\author;
use Illuminate\Database\Eloquent\SoftDeletes;

class book extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $table = 'tbl_book';

    protected $dates = ['deleted_at'];
    
    // ['fiction','non-fiction','sci-fi','etc']
    // enum('hardcover', 'paperback', 'ebook', '')

    protected $fillable = [
        'id',
        'title',
        'author_id',
        'genre',
        'format',
        'isbn',
        'price',
    ];

    public function author(){
        return $this->hasOne(author::class, 'id', 'author_id');
    }

    public function quantities()
{
    return $this->hasMany(bookqty::class, 'book_id', 'id');
}
}
