<?php

namespace App\Http\Controllers;

use App\Models\kriteria;
use App\Models\kuisoner;
use App\Models\sub_kriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data_kriteria = kriteria::where('id_kriteria', $id)->first();
        $data_subKriteria = sub_kriteria::where('id_kriteria',$id)->get();
        return view('subKriteria.subKriteria',['data_subKriteria' => $data_subKriteria,'data_kriteria'=>$data_kriteria]);
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
        sub_kriteria::create([
            'id_kriteria' => $request->id_Kriteria,
            'nama_subkriteria' => $request->nama_subKriteria,
            'bobot'=>$request->bobot,
        ]);
        return redirect('kriteria-'.$request->id_Kriteria.'/sub-kriteria');
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
    public function update(Request $request, $id, $id_subkriteria)
    {
        // dd($request);
        sub_kriteria::where('id_subkriteria',$id_subkriteria)->update([
            'nama_subkriteria' => $request->nama_subkriteria,
            'bobot'=>$request->bobot,
        ]);
        return redirect('kriteria-'.$id.'/sub-kriteria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_subkriteria)
    {
        sub_kriteria::where('id_subkriteria', $id_subkriteria)->delete();
        kuisoner::where('status', 1)->update([
            'status' => 0,
        ]);
        return redirect('kriteria-'.$id.'/sub-kriteria');
    }
}
