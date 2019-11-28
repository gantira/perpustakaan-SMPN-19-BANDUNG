<?php

namespace App\Http\Controllers;

use File;
use Session;
use App\Book;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Carbon\Carbon;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['books'] = Book::search($request->q)->get();

        return view('book.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $data = $request->all();
        $data['kode_buku'] = '-' . Carbon::now()->format('dmy') . '-' . (Book::where('category_id', $request->category_id)->count()+1);
        
        if ($request->file('image')) {
            $destinationPath = public_path('upload/books/');
            $fileName = time() . '-' . str_slug($request->title) .'.'. $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destinationPath, $fileName);
            $data['image'] = $fileName;
        }

        Book::create($data);

        Session::flash('message', '<i class="fe fe-check mr-2" aria-hidden="true"></i>Add book was successful'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $data['book'] = $book;

        return view('book.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $data['book'] = $book;

        return view('book.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $data = $request->except('kode_buku');

        if ($request->file('image')) {
            $this->delete_image($book->image);

            $destinationPath = public_path('upload/books/');
            $fileName = time() . '-' . str_slug($request->title) .'.'. $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destinationPath, $fileName);
            $data['image'] = $fileName;
        }

        $book->update($data);

        Session::flash('message', '<i class="fe fe-edit-3 mr-2" aria-hidden="true"></i>Update book was successful'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        $this->delete_image($book->image);

        Session::flash('message', '<i class="fe fe-trash mr-2" aria-hidden="true"></i>Delete book was successful'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('book.index');
    }

    public function delete_image($value='')
    {
        $image_path = public_path('upload/books/'. $value);

        if (File::exists($image_path) && $value != 'book.jpg') {
            File::delete($image_path);
        }
    }
}
