<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['id','title', 'description', 'cat_id', 'aut_id', 'price', 'quantity' ,'status'];

    public function images(){
        return $this->hasMany(BookImage::class,'book_id');
    }

    public function author(){
        return $this->belongsTo(Author::class,'aut_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'cat_id');
    }

}
