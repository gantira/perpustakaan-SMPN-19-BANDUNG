<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volume extends Model
{
    protected $fillable = [
        'kode_volume',
        'nama',
    ];

    public function scopeSearch($query, $q)
    {
        return $query->where('kode_volume', 'like', '%'.$q.'%')
                     ->orWhere('nama', 'like', '%'.$q.'%');
    }
}
