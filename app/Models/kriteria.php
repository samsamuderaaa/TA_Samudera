<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kriteria extends Model
{
    protected $table = "kriteria";
    protected $guarded = ['created_at', 'updated_at'];

    public function sub_kriteria(){
        return $this->hasMany(sub_kriteria::class,'id_kriteria','id_kriteria');
    }
}
