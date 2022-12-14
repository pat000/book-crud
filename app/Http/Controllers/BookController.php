<?php

namespace App\Http\Controllers;

use App\Models\Book;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $books = Book::all();
        return view('welcome', compact('books'));
    }

    public function getbooks(Request $request)
    {   
        if ($request->ajax()) {
            $books = Book::get();
            return Datatables::of($books)->make(true);
        }
    }

    public function getDataBook($id)
    {   
        $book = Book::find($id);
        return $book;
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
        $book = New Book;
        $book->title = $request->get('title');
        $book->isbn = $request->get('isbn');
        $book->author = $request->get('author');
        $book->publisher = $request->get('publisher');
        $book->year_published = $request->get('year_published');
        $book->category = $request->get('category');
        $book->save();
        return $book;
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
        $book = Book::find($id);
        $book->title = $request->get('title');
        $book->isbn = $request->get('isbn');
        $book->author = $request->get('author');
        $book->publisher = $request->get('publisher');
        $book->year_published = $request->get('year_published');
        $book->category = $request->get('category');
        $book->save();
        return $book;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
        $book->delete();
        
        return $book;
    }
}
