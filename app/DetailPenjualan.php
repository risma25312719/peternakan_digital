<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DataTernak;

class DetailPenjualan extends Model
{
    protected $table = 'detail_penjualan';
    protected $primaryKey = 'detail_id';
    protected $fillable = ['penjualan_id', 'ternak_id', 'harga'];

    //relasiiw
     public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }

    public function dataternak()
    {
        return $this->belongsTo(DataTernak::class, 'ternak_id');
    }
}
