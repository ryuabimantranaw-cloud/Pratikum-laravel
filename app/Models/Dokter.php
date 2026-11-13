<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter_0004';

    protected $fillable = [
        'kode_dokter', 'nama_lengkap', 'gelar', 'jenis_kelamin', 'sip',
        'spesialisasi', 'hari_praktik', 'email', 'telepon',
    ];
}
