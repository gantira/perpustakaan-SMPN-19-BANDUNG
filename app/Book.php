<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'kode_buku',
        'category_id',
        'volume_id',
        'title',
        'author',
        'publisher',
        'isbn',
        'year',
        'stock',
        'image',
        'harga',
        'description'
    ];

    public function scopeSearch($query, $q)
    {
        return $query->where('title', 'like', '%'.$q.'%')
                     ->orWhere('kode_buku', 'like', '%'.substr($q, 2, strlen($q)).'%')
                     ->orWhere('author', 'like', '%'.$q.'%')
                     ->orWhere('year', 'like', '%'.$q.'%')
                     ->orWhere('publisher', 'like', '%'.$q.'%')
                     ->orWhere('isbn', 'like', '%'.$q.'%');
    }

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeStockRemaining($query, $book_id)
    {
        return $query->find($book_id)->stock - $query->find($book_id)->transactionDetail()->whereStatus('loan')->whereHas('transaction', function($query) { $query->whereStatusPinjam(1); })->count();
    }

}
