<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPerjalananDinas extends Model
{
    protected $table = 'detail_perjalanan_dinas';

    protected $fillable = [
        'perjalanan_dinas_id',
        'ringkasan_kegiatan',
        'foto_kegiatan',
        'laporan',
        'status'
    ];

    public function perjalananDinas()
    {
        return $this->belongsTo(PerjalananDinas::class);
    }
}
