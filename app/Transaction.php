<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'qty',
        'status_pinjam',
        'tgl_pinjam',
        'tgl_kembali',
    ];

    public function scopeSearch($query, $q)
    {
        return $query->whereHas('user', function ($query) use($q) { 
                            $query->where('name', 'like', '%'.$q.'%')
                                  ->OrWhere('nik', 'like', '%'.$q.'%'); 
                            });
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function book()
    {
    	return $this->belongsTo(Book::class);
    }

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function hariKe($tgl_pinjam, $tgl_kembali)
    {
        return 7 - \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($tgl_kembali));
    }

    public function scopeIndktrBg($query, $id, $tgl_pinjam, $tgl_kembali)
    {   
        if (! $query->find($id)->status_pinjam) {
            return "bg-secondary";
        }

        $result = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($tgl_kembali));

        if ($result >= 4) {
            $bg = "bg-green";
        }elseif ($result >= 1) {
            $bg = "bg-yellow";
        }else {
            $bg = "bg-danger";
        }

        return $bg;
    }

    public function indktrW($tgl_pinjam, $tgl_kembali)
    {
        $result = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($tgl_kembali));

        if ($result >= 7) {
            $bgW = "0%";
        }elseif ($result >= 6) {
            $bgW = "10%";
        }elseif ($result >= 5) {
            $bgW = "25%";
        }elseif ($result >= 4) {
            $bgW = "45%";
        }elseif ($result >= 3) {
            $bgW = "60%";
        }elseif ($result >= 2) {
            $bgW = "75%";
        }elseif ($result >= 1) {
            $bgW = "90%";
        }else {
            $bgW = "100%";
        }

        return $bgW;
    }
}
