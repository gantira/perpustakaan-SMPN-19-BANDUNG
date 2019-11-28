<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ebook;
use App\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['books'] = Book::all();
        
        return view('dashboard', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function elibrary(Request $request)
    {

        $data['ebooks'] = Ebook::search($request->q)->get();

        return view('elibrary', $data);
    }
}
