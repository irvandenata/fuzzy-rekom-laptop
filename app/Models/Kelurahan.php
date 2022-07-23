<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function kecamatan(){
    return $this->belongsTo(Kecamatan::class);
    }
    public function pasiens (){
    return $this->hasMany(Pasien::class,'kelurahan_id');

    }
}
