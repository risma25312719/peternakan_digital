<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kandang;
use App\PemberianPakan;  // ← bukan DataPakan, sesuaikan nama modelnya
use App\Kesehatan;
use App\DetailPenjualan;

class DataTernak extends Model
{
    protected $table      = 'data_ternak';
    protected $primaryKey = 'ternak_id';

    protected $fillable = [
        'kode_ternak',
        'jenis_hewan',
        'jenis_kelamin',
        'tanggal_masuk',
        'status',
        'kandang_id',   
    ];

    public function kandang()  
    {
        return $this->belongsTo(Kandang::class, 'kandang_id', 'kandang_id');
    }

    public function pemberianPakan()  
    {
        return $this->hasMany(PemberianPakan::class, 'ternak_id', 'ternak_id');
    }

    public function kesehatan()
    {
        return $this->hasMany(Kesehatan::class, 'ternak_id', 'ternak_id');
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'ternak_id', 'ternak_id');
    }
}