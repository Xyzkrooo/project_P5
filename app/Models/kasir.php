<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kasir extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kasir', 'jk', 'image'];
    protected $visible = ['nama_kasir', 'jk', 'image'];
}
