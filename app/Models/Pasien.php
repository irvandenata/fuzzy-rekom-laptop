<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
     protected $guarded = [];
     protected $primaryKey = 'id';
     public $incrementing = false;
     protected $keyType = 'string';

    public function kelurahan(){
    return $this->belongsTo(Kelurahan::class,'kelurahan_id');
    }
}
