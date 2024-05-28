<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;
    protected $fillable = ['nama_pembeli', 'jk'];
    protected $visible = ['nama_pembeli', 'jk'];
}
