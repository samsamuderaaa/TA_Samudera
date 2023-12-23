<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kuisoner extends Model
{
    protected $table = "kuisoner";
    protected $guarded = ['created_at', 'updated_at'];

    public function penilaian(){
        return $this->hasMany(penilaian::class,'id_kuisoner','id_kuisoner')
        ->leftJoin('sub_kriteria','penilaian.id_sub_kriteria','=','sub_kriteria.id_subkriteria')
        ->leftJoin('kriteria', function($join) {
            $join->on('penilaian.id_kriteria','=','kriteria.id_kriteria')
                ->where('kriteria.status', '=', 1);
        });
    }


}
