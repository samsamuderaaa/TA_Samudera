<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_kriteria extends Model
{
    protected $table = "sub_kriteria";
    protected $guarded = ['created_at', 'updated_at'];

    public function kriteria(){
        return $this->belongsTo(kriteria::class,'id_kriteria','id_kriteria');
    }
}
