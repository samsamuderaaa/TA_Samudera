<?php

namespace App\Http\Controllers;

use App\Models\kriteria;
use App\Models\kuisoner;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_kriteria = kriteria::all();
        return view('kriteria.kriteria', ['data_kriteria' => $data_kriteria]);
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
        // dd($request);
        $id_kriteria = kriteria::max('id_kriteria');
        $id_kriteria++;
        kriteria::create([
            'id_kriteria' => $id_kriteria,
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'jenis' => $request->jenis,
            'bobot' => $request->bobot,
            'status' => 1,
        ]);
        kuisoner::where('status', 1)->update([
            'status' => 0,
        ]);
        return redirect('/kriteria');
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

        kriteria::where('id_kriteria',$id)->update([
            'kode_kriteria'=>$request->kode_kriteria,
            'nama_kriteria'=>$request->nama_kriteria,
            'jenis' => $request->jenis,
            'bobot' => $request->bobot,
            'status' => $request->status,
        ]);
        $kriteria = kriteria::where('id_kriteria', $id)->first();
        // dd($kriteria->status != $request->status);
        if ($kriteria->status != $request->status) {
            kuisoner::where('status', 1)->update([
                'status' => 0,
            ]);
        }
        return redirect('/kriteria');
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
