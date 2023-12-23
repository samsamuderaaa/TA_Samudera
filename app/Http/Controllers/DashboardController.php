<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\kriteria;
use App\Models\kuisoner;
use App\Models\maskapai;
use App\Models\penilaian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request->has('year') or $request->year != 'null' or $request->has('month') or $request->month != 'null'  ){
        //     $date = Carbon::create($request->year, $request->month, 1);
        // }else{
        //     $date = Carbon::now();
        // }
        $data_kuesioner = kuisoner::with(['penilaian' => function ($query) {
            $query->with('sub_kriteria');
        }])->where('kuisoner.status', 1)->get();
        // dd($data_kuesioner);
        if (count($data_kuesioner) < 1) {
            $nilai[] = [];
            $jml_kuesioner = null;
            $kriteria = kriteria::where('status', 1)->get();
            $data_kuesioner = null;
            $transpose_normalisasi = null;
            $transpose_bobot_nilai = null;
            $total = null;
            $hasil = null;
        } else {
            // dd($data_kuesioner);
            foreach ($data_kuesioner as $kuesioner) {
                $kriteria = kriteria::where('status', 1)->get();
                foreach ($kriteria as $Kriteria) {
                    $penilaian = penilaian::select('penilaian.*','kuisoner.maskapai')
                    ->leftJoin('kuisoner', 'penilaian.id_kuisoner', '=', 'kuisoner.id_kuisoner')
                    ->where('penilaian.id_kuisoner', $kuesioner->id_kuisoner)
                    ->where('penilaian.id_kriteria', $Kriteria->id_kriteria)
                    ->with('sub_kriteria')
                    ->first();

                    if (isset($penilaian) and $penilaian->id_sub_kriteria != 0) {
                        $nilai[] = [
                            'id_kuesioner' => $kuesioner->id_kuisoner,
                            'kode_kriteria' => $Kriteria->kode_kriteria,
                            'nama_kriteria' => $Kriteria->nama_kriteria,
                            'kriteria' => $penilaian->id_kriteria,
                            'nilai' => $penilaian->sub_kriteria->bobot,
                            'jenis' => $Kriteria->jenis,
                            'status' => $Kriteria->status,
                            'bobot' => $Kriteria->bobot,
                            'maskapai' => $penilaian->maskapai,
                        ];
                    } else {
                        $nilai[] = [
                            'id_kuesioner' => $kuesioner->id_kuisoner,
                            'kode_kriteria' => $Kriteria->kode_kriteria,
                            'nama_kriteria' => $Kriteria->nama_kriteria,
                            'kriteria' => $Kriteria->id_kriteria,
                            'nilai' => 0,
                            'jenis' => $Kriteria->jenis,
                            'status' => $Kriteria->status,
                            'bobot' => $Kriteria->bobot,
                            'maskapai' => $penilaian->maskapai,
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
                // $array_nilai[$key]['maskapai'] = $value['maskapai'];
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

            // Ambil nama maskapai sebagai kunci array
            $nama_maskapai = $data_kuesioner->pluck('maskapai')->toArray();
            // $resultArray = array_combine($nama_maskapai, $getNilai);
            // dd($nama_maskapai);
            //transpose data
            $array_normalisasi = [];
            foreach ($getNilai as $index => $value) {
                foreach ($value as $i => $v) {
                    $array_normalisasi[$i][$index] = $v;
                }
            }

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
                    $bobot_nilai[$k][$key] = $v * $getBobot[$key];
                }
            }
            $total = [];
            foreach ($bobot_nilai as $key => $value) {
                $total[$key] = array_sum($value);
            }
            arsort($total);
            
            
            // dd($total);
            foreach ($total as $key => $value) {
                $dataMaskapai = maskapai::where('id_maskapai',$nama_maskapai[$key])->first();
                $namaMaskapai = $dataMaskapai->nama_maskapai;
                
                if (!isset($hasil[$namaMaskapai])) {
                    // Jika nama maskapai belum ada di hasil, tambahkan dengan total dan hitung satu data
                    $hasil[$namaMaskapai] = [
                        'key' => $key,
                        'nama' => $namaMaskapai,
                        'total' => $value,
                        'count' => 1,
                        'rata_rata' => $value, // Menyertakan rata-rata dalam elemen total
                    ];
                } 
                else {
                    // Jika nama maskapai sudah ada, tambahkan total, tingkatkan hitungan, dan perbarui rata-rata
                    $hasil[$namaMaskapai]['total'] += $value;
                    $hasil[$namaMaskapai]['count']++;
                    $hasil[$namaMaskapai]['rata_rata'] = $hasil[$namaMaskapai]['total'] / $hasil[$namaMaskapai]['count'];
                }
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
        // dd($hasil);
        
        return view('dashboard', ['hasil'=>$hasil]);
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
