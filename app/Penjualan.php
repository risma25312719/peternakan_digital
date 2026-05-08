<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DetailPenjualan;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'penjualan_id';
    protected $fillable = ['tanggal', 'pembeli', 'total_harga'];

    //relas
    public function detailpenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id');
    }
}
