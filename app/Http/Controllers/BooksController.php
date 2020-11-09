<?php

namespace App\Http\Controllers;

use App\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Books::orderByDesc('updated_at')->get();
        return view('home', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $books = new Books;
        $books->title = $request->title;
        $books->author = $request->author;
        $books->pages = $request->pages;

        if ( $request->hasFile( 'image' ) &&
            $request->file( 'image' )->isValid()
        ) {
            $name = date( 'H-i-' ) . $request->file( 'image' )
                                            ->getClientOriginalName();

            $path = $request->file( 'image' )
                            ->storeAs( 'uploads/' . date( 'Y' ) . '/' . date( 'm' ), $name, 'public' );
                
            $books->image = '/storage/' . $path;
        }
        else {
            $books->image = '/storage/placeholder.png';
        }

        $books->save();
        return redirect()->route('books.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Books $books)
    {
        $books->title = $request->title;
        $books->author = $request->author;
        $books->pages = $request->pages;

        if ( $request->hasFile( 'image' ) &&
            $request->file( 'image' )->isValid()
        ) {
            $name = date( 'H-i-' ) . $request->file( 'image' )
                                            ->getClientOriginalName();

            $path = $request->file( 'image' )
                            ->storeAs( 'uploads/' . date( 'Y' ) . '/' . date( 'm' ), $name, 'public' );
            
            if ($books->image != '/storage/' . $path) {
                $books->image = '/storage/' . $path;
            }
        }

        $books->save();
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function destroy(Books $books)
    {
        $books->delete();
        return redirect()->route('books.index');
    }
}
