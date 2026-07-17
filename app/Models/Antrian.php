<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $table = 'antrians';

    protected $fillable = [
        'antrianmesin_id',
        'mesin_id',
        'nomor_antrian',
        'waktu_masuk',
        'waktu_selesai',
        'status_antrian',
        'keterangan',
    ];

    public function antrianmesin()
    {
        return $this->belongsTo(Antrianmesin::class, 'antrianmesin_id');
    }

    public function mesin()
    {
        return $this->belongsTo(Mesin::class, 'mesin_id');
    }
}
