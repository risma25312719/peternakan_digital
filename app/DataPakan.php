<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PemberianPakan;

class DataPakan extends Model
{
    protected $table = 'data_pakan';
    protected $primaryKey = 'data_pakan_id';
    protected $fillable = ['nama_pakan', 'stok', 'satuan'];

    //relasyi
     public function pemberianpakan()
        {
            return $this->hasMany(PemberianPakan::class, 'data_pakan_id');
        }
}
