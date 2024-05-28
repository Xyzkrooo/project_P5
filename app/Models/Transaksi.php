<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = ['id_produk','id_pembeli', 'total_bayar','total_item','total_harga','id_kasir'];
    protected $visible = ['id_produk','id_pembeli', 'total_bayar','total_item','total_harga','id_kasir'];
}
