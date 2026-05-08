<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DataTernak;

class Kesehatan extends Model
{
    protected $table = 'kesehatan';
    protected $primaryKey = 'kesehatan_id';
    protected $fillable = ['ternak_id', 'tanggal', 'kondisi', 'tindakan'];

    //relasi
     public function DataTernak()
    {
        return $this->belongsTo(DataTernak::class, 'ternak_id');
    }
}
