<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrianmesin extends Model
{
    use HasFactory;

    protected $table ='antrianmesins';
    protected $fillable = [
        'proyekorders_id',
        'nospk',
        'tglspk',
        'deadline',
        'prioritas',
        'namabarang',
        'qtybarang',
        'created_by',
        'updated_by',

        'tglmhotpress',
        'tglkhotpress',
        'kethotpress',

        'tglmrunningsaw',
        'tglkrunningsaw',
        'ketrunningsaw',

        'tglmcnc5axis',
        'tglkcnc5axis',
        'ketcnc5axis',

        'tglmcnc4axis',
        'tglkcnc4axis',
        'ketcnc4axis',

        'tglmboring',
        'tglkboring',
        'ketboring',

        'tglmrouter',
        'tglkrouter',
        'ketrouter',

        'tglmrakit',
        'tglkrakit',
        'ketrakit',

        'tglmfinish',
        'tglkfinish',
        'ketfinish',

        'tglcompleted'
    ];

    public $tempAttributes = [];

    /**
     * Get dynamic machine code-to-name mapping from database
     */
    public function getMachineNameMap()
    {
        static $map = null;
        if ($map === null) {
            $map = [];
            try {
                $machines = Mesin::all();
                foreach ($machines as $m) {
                    $code = preg_replace('/[^a-z0-9]/', '', strtolower($m->nama_mesin));
                    $map[$code] = $m->nama_mesin;
                }
            } catch (\Exception $e) {
                // Fallback map during initial migrations/seeding
                $map = [
                    'hotpress' => 'Hot Press',
                    'runningsaw' => 'Running Saw',
                    'cnc5axis' => 'CNC 5 Axis',
                    'cnc4axis' => 'CNC 4 Axis',
                    'boring' => 'Boring Vertikal',
                    'router' => 'CNC Router',
                    'rakit' => 'Rakit',
                    'finish' => 'Finishing',
                ];
            }
        }
        return $map;
    }

    protected static function booted()
    {
        static::created(function ($antrianmesin) {
            $machineNameMap = $antrianmesin->getMachineNameMap();
            foreach ($machineNameMap as $code => $name) {
                $mesin = Mesin::firstOrCreate(
                    ['nama_mesin' => $name],
                    ['status' => 'aktif']
                );
                
                $antrianmesin->antrians()->create([
                    'mesin_id' => $mesin->id,
                    'waktu_masuk' => null,
                    'waktu_selesai' => null,
                    'keterangan' => null,
                    'status_antrian' => 'menunggu',
                ]);
            }
        });

        static::saved(function ($antrianmesin) {
            $machineNameMap = $antrianmesin->getMachineNameMap();
            foreach ($machineNameMap as $code => $name) {
                $hasTglm = array_key_exists("tglm{$code}", $antrianmesin->tempAttributes);
                $hasTglk = array_key_exists("tglk{$code}", $antrianmesin->tempAttributes);
                $hasKet = array_key_exists("ket{$code}", $antrianmesin->tempAttributes);
                
                if ($hasTglm || $hasTglk || $hasKet) {
                    $mesin = Mesin::firstOrCreate(
                        ['nama_mesin' => $name],
                        ['status' => 'aktif']
                    );
                    
                    $existing = $antrianmesin->antrians()->where('mesin_id', $mesin->id)->first();
                    
                    $waktu_masuk = $hasTglm ? $antrianmesin->tempAttributes["tglm{$code}"] : ($existing ? $existing->waktu_masuk : null);
                    $waktu_selesai = $hasTglk ? $antrianmesin->tempAttributes["tglk{$code}"] : ($existing ? $existing->waktu_selesai : null);
                    $keterangan = $hasKet ? $antrianmesin->tempAttributes["ket{$code}"] : ($existing ? $existing->keterangan : null);
                    
                    $status_antrian = 'menunggu';
                    if (!empty($waktu_selesai)) {
                        $status_antrian = 'selesai';
                    } elseif (!empty($waktu_masuk)) {
                        $status_antrian = 'diproses';
                    }
                    
                    $antrianmesin->antrians()->updateOrCreate(
                        ['mesin_id' => $mesin->id],
                        [
                            'waktu_masuk' => $waktu_masuk ?: null,
                            'waktu_selesai' => $waktu_selesai ?: null,
                            'keterangan' => $keterangan ?: null,
                            'status_antrian' => $status_antrian,
                        ]
                    );
                }
            }
        });
    }

    public function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if (preg_match('/^(tglm|tglk|ket)(.+)$/', $key)) {
                $this->tempAttributes[$key] = $value;
                unset($attributes[$key]);
            }
        }
        return parent::fill($attributes);
    }

    public function setAttribute($key, $value)
    {
        if (preg_match('/^(tglm|tglk|ket)(.+)$/', $key)) {
            $this->tempAttributes[$key] = $value;
            return $this;
        }
        return parent::setAttribute($key, $value);
    }

    public function getAttribute($key)
    {
        if (preg_match('/^(tglm|tglk|ket)(.+)$/', $key, $matches)) {
            $type = $matches[1];
            $machineCode = $matches[2];
            
            $machineNameMap = $this->getMachineNameMap();
            
            if (isset($machineNameMap[$machineCode])) {
                $machineName = $machineNameMap[$machineCode];
                
                if (array_key_exists($key, $this->tempAttributes)) {
                    return $this->tempAttributes[$key];
                }
                
                $antrian = $this->antrians->first(function ($item) use ($machineName) {
                    return optional($item->mesin)->nama_mesin === $machineName;
                });
                
                if ($antrian) {
                    if ($type === 'tglm') return $antrian->waktu_masuk;
                    if ($type === 'tglk') return $antrian->waktu_selesai;
                    if ($type === 'ket') return $antrian->keterangan;
                }
            }
            return null;
        }
        return parent::getAttribute($key);
    }

    public function proyekorder()
    {
        return $this->belongsTo(Proyekorder::class, 'proyekorders_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function antrians()
    {
        return $this->hasMany(Antrian::class, 'antrianmesin_id');
    }
}
