<?php

namespace App\Http\Controllers;

use Cart;

use Session;
use App\Setting;
use App\User;
use App\Book;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Cart::destroy();

        $data['transactions'] = Transaction::search($request->q)->latest()->get();

        return view('transaction.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['books'] = Book::search($request->q)->get();
        $data['users'] = User::whereStatus('active')->role('member')->get();

        return view('transaction.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $user = $request->user_id;

        $result = User::find($user)->whereHas('transaction', function ($query) use($user) { $query->whereUserId($user)->whereStatusPinjam(1); })->first();
        if ($result) {
            Session::flash('message', 'The user\'s loan status is active'); 
            Session::flash('alert-class', 'alert-warning');
            Session::flash('fe-alert', 'fe-alert-triangle');

            return redirect()->back();
        }

        $dataRequest = $request->all();
        $dataRequest['qty'] = Cart::content()->count();

        $transaction = Transaction::create($dataRequest);
        foreach (Cart::content() as $row) {
            TransactionDetail::create(['transaction_id' => $transaction->id, 'book_id' => $row->id, 'tgl_pinjam' => Carbon::now(), 'tgl_kembali'=> Carbon::now()->addDay(+7)]);
        }
        
        Cart::destroy();

        Session::flash('message', 'The transaction has created'); 
        Session::flash('alert-class', 'alert-success');
        Session::flash('fe-alert', 'fe-check');

        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $data['receipt'] = $transaction;

        return view('receipt.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Transaction $transaction)
    {   
        $transaction = $transaction->transactionDetail()->where('status', 'loan')->get();
        foreach ($transaction as $row) {
            Cart::add($row->book_id, $row->book->title, 1, 0)->associate(Book::class);
        }

        $data['books'] = Book::search($request->q)->get();
        $data['transaction'] = $transaction->first();

        return view('transaction.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        // TransactionDetail::whereTransactionId($transaction->id)->delete();

        foreach (Cart::content() as $row) {
            TransactionDetail::firstOrCreate(['transaction_id' => $transaction->id, 'book_id' => $row->id, 'status'=> 'loan'], ['tgl_pinjam' => Carbon::now(), 'tgl_kembali'=> Carbon::now()->addDay(+7)]);
        }

        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        Session::flash('message', 'Successfully deleted the transaction '); 
        Session::flash('alert-class', 'alert-success');
        Session::flash('fe-alert', 'fe-link');

        return redirect()->back();
    }

    public function addItem($id, $title)
    {
        if (Cart::content()->count() >= 3) {
            Session::flash('message', 'Can not borrow more than 3 books'); 
            Session::flash('alert-class', 'alert-warning');
            Session::flash('fe-alert', 'fe-alert-triangle');

            return redirect()->back();
        }

        Cart::add($id, $title, 1, 0)->associate(Book::class);

        return redirect()->back();
    }

    public function removeItem($id)
    {
        Cart::remove($id);

        return redirect()->back();
    }
    
    public function return($id)
    {
        Transaction::find($id)->update(['status_pinjam' => 0]);
        $transactionDetail = TransactionDetail::whereTransactionId($id);
        $transactionDetail->whereStatus('loan')->update(['status'=>'returned']);

        foreach (TransactionDetail::whereTransactionId($id)->get() as $key => $buku) {

            if ($buku->status == 'late') {
                if (Carbon::now() > Carbon::parse($buku->tgl_kembali)) {
                    $buku->denda = Carbon::now()->diffInDays($buku->tgl_kembali) * Setting::value('telat');
                }
            }

            if ($buku->status == 'lost') {
                $buku->denda = $buku->book->harga;
            }

            if ($buku->status == 'broken') {
                $buku->denda = $buku->book->harga;
            }
            $buku->save();
        }

        Session::flash('message', 'The book was successfully restored. Thank you'); 
        Session::flash('alert-class', 'alert-success');
        Session::flash('fe-alert', 'fe-book');

        return redirect()->back();
    }

    public function receipt($id)
    {
        $data['transaction'] = Transaction::find($id);

        return view('receipt.show', $data);
    }

}
