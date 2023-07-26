<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrianmesin extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyekorders_id',
        'nospk',
        'tglspk',
        'namabarang',
        'qtybarang',

        'tglmhotpress',
        'tglkhotpress',
        'kethotpress',

        'tglmbasic',
        'tglkbasic',
        'ketbasic',

        'tglmedging',
        'tglkedging',
        'ketedging',

        'tglmcnc',
        'tglkcnc',
        'ketcnc',

        'tglmtukang',
        'tglktukang',
        'kettukang',

        'tglmfinish',
        'tglkfinish',
        'ketfinish',

    ];

    public function proyekorder()
    {
        return $this->belongsTo(Proyekorder::class);
    }
}
