<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable = ['id_produk', 'harga', 'total_item', 'id_kasir'];
    protected $visible = ['id_produk', 'harga', 'total_item','id_kasir'];

    public function Produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
    public function Kasir()
    {
        return $this->belongsTo(kasir::class, 'id_kasir');
    }
    public function Pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'id_pembeli');
    }
    
}
