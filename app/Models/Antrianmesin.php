<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrianmesin extends Model
{
    use HasFactory;

    protected $fillable = [
        'nospk',
        'tglspk',
        'namabarang',
        'qtyspk',

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
}
