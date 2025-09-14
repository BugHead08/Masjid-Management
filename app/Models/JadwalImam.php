<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalImam extends Model
{
    use HasFactory;
    protected $fillable = [
        'imam',
        'muazin', 
        'tanggal',
    ];
}
