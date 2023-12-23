<?php

namespace App\Http\Controllers;

use App\Models\kriteria;
use App\Models\kuisoner;
use App\Models\maskapai;
use App\Models\penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KuisonerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_kuisoner = kuisoner::all();
        
        return view('kuisoner.kuesioner', ['data_kuisoner' => $data_kuisoner]);
    }
    public function qr_code(Request $request)
    {
        $text = $request->input('text');
        $qrCodePath = public_path('qr_codes/' . $text . '.png');

        // Generate QR code
        QrCode::size(300)
            ->format('png')
            ->generate($text, $qrCodePath);

        // Kembalikan URL QR code sebagai respons JSON
        $qrCodeUrl = asset('qr_codes/' . $text . '.png');

        return response()->json(['qrCodeUrl' => $qrCodeUrl]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kriteria = kriteria::with(['sub_kriteria'=>function($query) {
            $query->orderBy('bobot','desc');
        }])->where('status',1)->get();
        $data_maskapai = maskapai::where('status',1)->get();
        return view('kuisoner.formKuisoner', ['data_maskapai'=>$data_maskapai,'kriteria' => $kriteria]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'foto' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            'nomor_identitas' => 'required|unique:kuisoner,nomor_identitas',
        ], [
            'nomor_identitas.unique' => 'Satu nomor identitas hanya bisa mengisi satu kuesioner.',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($request->kriteria as $index => $item) {
            list($idKriteria, $idSubkriteria) = explode('-', $item);
            $kriteria[$index]['id_kriteria'] = $idKriteria;
            $kriteria[$index]['id_subkriteria'] = $idSubkriteria;
        }

        $id_kuisoner = kuisoner::max('id_kuisoner');
        $id_kuisoner++;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
        }

        $path = $request->file('foto')->storeAs('photo', $filename);
        $file->move('photo', $filename);

        $input_kuisoner = kuisoner::create([
            'id_kuisoner' => $id_kuisoner,
            'nomor_identitas' => $request->nomor_identitas,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'maskapai' => $request->maskapai,
            'path_photo' => $path,
            'status' => 1
        ]);

        if ($input_kuisoner) {
            foreach ($kriteria as $value) {
                penilaian::create([
                    'id_kuisoner' => $id_kuisoner,
                    'id_kriteria' => $value['id_kriteria'],
                    'id_sub_kriteria' => $value['id_subkriteria'],
                ]);
            }
        }
        return redirect('kuesioner/done');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data_kuisoner = kuisoner::where('id_kuisoner', $id)->with('penilaian')->first();
        // dd($data_kuisoner);

        return view('kuisoner.detail_kuisoner', ['data_kuisoner' => $data_kuisoner]);
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
