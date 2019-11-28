<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'kode_kategori',
        'nama',
    ];

    public function scopeSearch($query, $q)
    {
        return $query->where('kode_kategori', 'like', '%'.$q.'%')
                     ->orWhere('nama', 'like', '%'.$q.'%');
    }
}
