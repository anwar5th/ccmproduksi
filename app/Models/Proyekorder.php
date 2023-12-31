<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyekorder extends Model
{
    use HasFactory;

    protected $table ='proyekorders';
    protected $fillable = [
        'kodepo',
        'namaproyek',
        'tglpo',
        'keteranganpoitem',
    ];

    public function antrianmesin()
    {
        return $this->hasMany(Antrianmesin::class, 'proyekorders_id');
    }
}
