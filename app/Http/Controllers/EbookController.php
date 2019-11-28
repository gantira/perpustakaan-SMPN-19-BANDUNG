<?php

namespace App\Http\Controllers;

use File;
use Session;
use App\Ebook;
use Illuminate\Http\Request;
use App\Http\Requests\EbookRequest;

class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['ebooks'] = Ebook::search($request->search)->get();

        return view('ebook.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ebook.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EbookRequest $request)
    {
        $data = $request->all();

        if ($request->file('image')) {
            $destinationPath = public_path('upload/ebooks/');
            $fileName = time() . '-' . str_slug($request->title) .'.'. $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destinationPath, $fileName);
            $data['image'] = $fileName;
        }

        if ($request->file('pdf')) {
            $destinationPath = public_path('upload/ebooks/pdf/');
            $fileName = time() . '-' . str_slug($request->title) .'.'. $request->file('pdf')->getClientOriginalExtension();
            $request->file('pdf')->move($destinationPath, $fileName);
            $data['pdf'] = $fileName;
        }
        
        Ebook::create($data);

        Session::flash('message', '<i class="fe fe-check mr-2" aria-hidden="true"></i>Add ebook was successful'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('ebook.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function show(Ebook $ebook)
    {
        $data['ebook'] = $ebook;

        return view('ebook.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Ebook $ebook)
    {
        $data['ebook'] = $ebook;

        return view('ebook.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ebook $ebook)
    {
        $data = $request->all();

        if ($request->file('image')) {
            $this->delete_image($ebook->image);

            $destinationPath = public_path('upload/ebooks/');
            $fileName = time() . '-' . str_slug($request->title) .'.'. $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destinationPath, $fileName);
            $data['image'] = $fileName;
        }

        if ($request->file('pdf')) {
            $this->delete_pdf($ebook->pdf);

            $destinationPath = public_path('upload/ebooks/pdf/');
            $fileName = time() . '-' . str_slug($request->title) .'.'. $request->file('pdf')->getClientOriginalExtension();
            $request->file('pdf')->move($destinationPath, $fileName);
            $data['pdf'] = $fileName;
        }

        $ebook->update($data);

        Session::flash('message', '<i class="fe fe-edit-3 mr-2" aria-hidden="true"></i>Update ebook was successful'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('ebook.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ebook $ebook)
    {
        $ebook->delete();

        $this->delete_image($ebook->image);
        $this->delete_pdf($ebook->pdf);

        Session::flash('message', '<i class="fe fe-trash mr-2" aria-hidden="true"></i>Delete ebook was successful'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('ebook.index');
    }

    public function delete_image($value='')
    {
        $image_path = public_path('upload/ebooks/'. $value);

        if (File::exists($image_path) && $value != 'ebook.jpg') {
            File::delete($image_path);
        }
    }

    public function delete_pdf($value='')
    {
        $pdf_path = public_path('upload/ebooks/pdf/'. $value);

        if (File::exists($pdf_path)) {
            File::delete($pdf_path);
        }
    }
}
