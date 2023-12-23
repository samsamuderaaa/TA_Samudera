<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penilaian extends Model
{
    protected $table = "penilaian";
    protected $guarded = ['created_at', 'updated_at'];

    public function sub_kriteria()
    {
        return $this->hasOne(sub_kriteria::class, 'id_subkriteria', 'id_sub_kriteria');
    }
    public function unique_multi_array($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    public function getJenis($arr_nilai, $jml_pegawai)
    {
        $jenis = [];
        foreach ($arr_nilai as $key => $value) {
            $jenis[$key] = $value['jenis'];
        }

        $convert_jenis =  array_chunk($jenis, ceil(count($jenis)) / $jml_pegawai);
        $hasil = $convert_jenis[0];
        return $hasil;
    }
}
