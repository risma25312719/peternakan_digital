<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DataTernak;
use App\DataPakan;

class PemberianPakan extends Model
{
    protected $table = 'pemberian_pakan';
    protected $primaryKey = 'pemberian_pakan_id';
    protected $fillable = ['ternak_id', 'pakan_id', 'tanggal', 'jumlah'];

    //relassi
    public function dataternak()
    {
        return $this->belongsTo(DataTernak::class, 'ternak_id');
    }

    public function datapakan()
    {
        return $this->belongsTo(DataPakan::class, 'data_pakan_id');
    }
}
