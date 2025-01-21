<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\book;
use Illuminate\Database\Eloquent\SoftDeletes;
class author extends Model
{
    use SoftDeletes;

    use HasFactory;

    // $table->string('title');
    // $table->bigInteger('author_id');
    // $table->enum('genre',['fiction','non-fiction','sci-fi','etc']);
    // $table->integer('price');
    protected $dates = ['deleted_at'];

    protected $table = 'tbl_author';

    protected $fillable = [
        'id',
        'name',
    ];

    public function books(){
        
        return $this->belongsTo(book::class,'id','author_id');
        // return $this->belongsToMany(book::class,);
    }
}
