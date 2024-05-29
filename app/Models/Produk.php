<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'harga', 'stok', 'deskripsi', 'image'];
    protected $visible = ['nama', 'harga', 'stok', 'deskripsi', 'image'];
    public function Produk()
    {
        return $this->hasMany(Produk::class, 'id_produk');
    }
}
