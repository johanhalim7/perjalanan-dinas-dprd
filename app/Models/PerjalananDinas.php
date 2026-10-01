<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjalananDinas extends Model
{
    use HasFactory;

    protected $table = 'perjalanan_dinas';

    protected $fillable = [
        'user_id',
        'nama_pegawai',
        'jabatan',
        'tujuan',
        'tanggal_berangkat',
        'tanggal_pulang',
        'anggaran',
        'surat_tugas',
        'laporan_perjalanan'
    ];

    public function detailPerjalanan()
    {
        return $this->hasMany(DetailPerjalananDinas::class);
    }

    public function pegawai()
    {
        return $this->belongsToMany(User::class, 'perjalanan_dinas_pegawai');
    }

}
