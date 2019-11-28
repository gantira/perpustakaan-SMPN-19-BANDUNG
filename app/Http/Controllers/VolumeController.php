<?php

namespace App\Http\Controllers;

use App\Volume;
use Illuminate\Http\Request;
use App\Http\Requests\VolumeRequest;
use Session;

class VolumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['volume'] = Volume::search($request->q)->get();

        return view('volume.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('volume.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VolumeRequest $request)
    {
        Volume::create($request->all());

        Session::flash('message', '<i class="fe fe-check mr-2" aria-hidden="true"></i>Add volume was successful'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('volume.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Volume  $volume
     * @return \Illuminate\Http\Response
     */
    public function show(Volume $volume)
    {
        $data['volume'] = $volume;

        return view('volume.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Volume  $volume
     * @return \Illuminate\Http\Response
     */
    public function edit(Volume $volume)
    {
        $data['volume'] = $volume;

        return view('volume.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Volume  $volume
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Volume $volume)
    {
        $volume->update($request->except('kode_kategori'));

        Session::flash('message', '<i class="fe fe-edit-3 mr-2" aria-hidden="true"></i>Update volume was successful'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('volume.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Volume  $volume
     * @return \Illuminate\Http\Response
     */
    public function destroy(Volume $volume)
    {
        $volume->delete();

        Session::flash('message', '<i class="fe fe-trash mr-2" aria-hidden="true"></i>Delete volume was successful'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('volume.index');
    }

}
