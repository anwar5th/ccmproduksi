<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    use HasFactory;

    protected $table = 'mesins';

    protected $fillable = [
        'nama_mesin',
        'status',
    ];

    public function antrians()
    {
        return $this->hasMany(Antrian::class, 'mesin_id');
    }
}
