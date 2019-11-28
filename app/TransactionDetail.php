<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_id',
        'book_id',
        'tgl_pinjam',
        'tgl_kembali',
        'status',
        'denda',
    ];

    public function book()
    {
    	return $this->belongsTo(Book::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
