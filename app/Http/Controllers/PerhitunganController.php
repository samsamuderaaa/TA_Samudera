<?php

namespace App\Http\Controllers;

use App\Models\kriteria;
use App\Models\kuisoner;
use App\Models\penilaian;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_kuesioner = kuisoner::with(['penilaian' => function ($query) {
            $query->where('status', 1)->with('sub_kriteria');
        }])->leftJoin('maskapai','kuisoner.maskapai','maskapai.id_maskapai')->where('kuisoner.status', 1)->get();
        // dd($data_kuesioner);
        if (count($data_kuesioner) < 1) {
            $nilai[] = [];
            $jml_kuesioner = null;
            $kriteria = kriteria::where('status', 1)->get();
            $data_kuesioner = null;
            $transpose_normalisasi = null;
            $transpose_bobot_nilai = null;
            $total = null;
        }
        else{
            foreach ($data_kuesioner as $kuesioner) {
                $kriteria = kriteria::where('status', 1)->get();
                foreach ($kriteria as $Kriteria) {
                    $penilaian = penilaian::where('id_kuisoner', $kuesioner->id_kuisoner)->where('id_kriteria', $Kriteria->id_kriteria)->with('sub_kriteria')->first();
                   
                    if (isset($penilaian) and $penilaian->id_sub_kriteria != 0) {
                        $nilai[] = [
                            'id_kuesioner' => $kuesioner->id_kuisoner,
                            'nama_maskapai'=> $kuesioner->nama_maskapai,
                            'kode_kriteria' => $Kriteria->kode_kriteria,
                            'nama_kriteria' => $Kriteria->nama_kriteria,
                            'kriteria' => $penilaian->id_kriteria,
                            'nilai' => $penilaian->sub_kriteria->bobot,
                            'jenis' => $Kriteria->jenis,
                            'status' => $Kriteria->status,
                            'bobot' => $Kriteria->bobot,
                        ];
                    }else{
                        $nilai[] = [
                            'id_kuesioner' => $kuesioner->id_kuisoner,
                            'nama_maskapai'=> $kuesioner->nama_maskapai,
                            'kode_kriteria' => $Kriteria->kode_kriteria,
                            'nama_kriteria' => $Kriteria->nama_kriteria,
                            'kriteria' => $Kriteria->id_kriteria,
                            'nilai' => 0,
                            'jenis' => $Kriteria->jenis,
                            'status' => $Kriteria->status,
                            'bobot' => $Kriteria->bobot,
                        ];
                    }
                }
            }
            
            $p = new penilaian();
            $jml_kuesioner = $data_kuesioner->count();
            $kode_kriteria = $p->unique_multi_array($nilai, 'kode_kriteria');
            $jml_data_analisa = $p->unique_multi_array($nilai, 'id_kuesioner');
            $jenis = $p->getJenis($nilai, $jml_kuesioner);

            $array_nilai = [];
            foreach ($nilai as $key => $value) {
                $array_nilai[$key] = $value['nilai'];
            }
            $array_bobot = [];
            foreach ($nilai as $key => $value) {
                $array_bobot[$key] = $value['bobot'];
            }

            //mendapatkan bobot per kuesioner
            $con_bobot =  array_chunk($array_bobot, ceil(count($array_bobot)) / $jml_kuesioner);
            $getBobot = $con_bobot[0];

            //mendapatkan nilai per kuesioner
            $getNilai = array_chunk($array_nilai, ceil(count($array_nilai)) / $jml_kuesioner);

            //transpose data
            $array_normalisasi = [];
            foreach ($getNilai as $index => $value) {
                foreach ($value as $i => $v) {
                    $array_normalisasi[$i][$index] = $v;
                }
            }

            // dd($getNilai);
            $min = [];
            $max = [];
            foreach ($array_normalisasi as $key => $value) {
                $min[$key] = min($value);
                $max[$key] = max($value);
            }
            $data_normalisasi = [];
            foreach ($getNilai as $key => $value) {
                foreach ($value as $k => $val) {
                    if ($nilai[$k]['jenis'] == 'benefit') {
                        $data_normalisasi[$k][$key] = $max[$k] != 0 ? $val / $max[$k] : 0;
                    } else {
                        // Hindari pembagian oleh nol dengan memeriksa apakah $val bukan nol
                        $data_normalisasi[$k][$key] = $val != 0 ? $min[$k] / $val : 0;
                    }
                }
            }

            $bobot_nilai = [];
            foreach ($data_normalisasi as $key => $value) {
                foreach ($value as $k => $v) {
                    $bobot_nilai[$key][$k] = $v * $getBobot[$key];
                }
            }

            $total = [];
            foreach ($bobot_nilai as $key => $value) {
                $total[$key] = array_sum($value);
            }
            
            $transpose_normalisasi = [];
            foreach ($data_normalisasi as $index => $value) {
                foreach ($value as $i => $v) {
                    $transpose_normalisasi[$i][$index] = $v;
                }
            }

            $transpose_bobot_nilai = [];
            foreach ($bobot_nilai as $index => $value) {
                foreach ($value as $i => $v) {
                    $transpose_bobot_nilai[$i][$index] = $v;
                }
            }
        }
        // dd($data_kuesioner);
        return view('perhitungan.perhitungan', ['data_kriteria' => $kriteria, 'data_kuesioner' => $data_kuesioner, 'total' => $total, 'transpose_normalisasi' => $transpose_normalisasi, 'transpose_bobot_nilai' => $transpose_bobot_nilai]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
