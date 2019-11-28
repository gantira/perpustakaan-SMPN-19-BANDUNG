<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'isbn',
        'image',
        'pdf',
        'description',
    ];

    public function scopeSearch($query, $q)
    {
        return $query->where('title', 'like', '%'.$q.'%')
                     ->orWhere('author', 'like', '%'.$q.'%')
                     ->orWhere('publisher', 'like', '%'.$q.'%')
                     ->orWhere('isbn', 'like', '%'.$q.'%');
    }
}
