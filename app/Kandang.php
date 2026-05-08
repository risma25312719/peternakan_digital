<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DataTernak;

class Kandang extends Model
{
    protected $table      = 'kandang';
    protected $primaryKey = 'kandang_id';

    protected $fillable = [
        'nama_kandang',
        'kapasitas',
        'lokasi',      
    ];

    public function dataTernak()  
    {
        return $this->hasMany(DataTernak::class, 'kandang_id', 'kandang_id');
    }
}