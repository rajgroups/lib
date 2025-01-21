<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\book;
use App\Models\author;
use App\Models\bookqty;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books = book::with('author')->get();
        // dd($books);
        return view('admin.book.list',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $authors = author::all();
        
        return view('admin.book.create',compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
            //
            // dd($request->author);
            $request->validate([
                'isbn'          => 'required|unique:tbl_book,isbn,isbn|min:13',
                // 'isbn'          => 'required|unique',Rule::unique('tbl_book')->ignore($request->isbn, 'isbn'),
                'title'         => 'required|string',
                'author'        => 'required|Integer|exists:tbl_author,id',
                'genre'         => 'required|in:non-fiction,sci-fi,etc',
                'format'        => 'required|in:hardcover,paperback,ebook',
                'price'         => 'required|Integer',
                'qty'           => 'required|integer|min:0' // Validation for quantity
            ]);

            try{
                $book = book::create([
                    'title'         => $request->title,
                    'author_id'     => $request->author,
                    'genre'         => $request->genre,
                    'price'         => $request->price,
                    'isbn'          => $request->isbn,
                    'format'        => $request->format,
                ]);

                DB::table('tbl_book_qty')->insert([
                    'book_id' => $book->id,
                    'qty'     => $request->qty,
                    'format'  => $request->format,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        
                return redirect()->back()->with('success','Book Created SuccessFully');
                // dd('data saved');
            } catch (Exception $e){
                return redirect()->back()->with('error','Some Error Occured:'.$e->getMessage());
            }
            
        }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $book = book::find($id)->with('author');
        return view('admin.book.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(book $book)
    {
    //
    // dd($book);
    $authors = author::all();
    $quantities = $book->quantities; // Assuming the relationship is defined in the Book model

    return view('admin.book.edit', compact('book', 'authors', 'quantities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
        // dd($request->author);
        $request->validate([
            'isbn'          => 'required|min:13|unique:tbl_book,isbn,'.$book->id,
            'title'         => 'required|string',
            'author'        => 'required|integer|exists:tbl_author,id',
            'genre'         => 'required|in:non-fiction,sci-fi,etc',
            'format'        => 'required|in:hardcover,paperback,ebook',
            'price'         => 'required|integer',
            'qty'           => 'required|integer|min:0',
        ]);
        try {
            $book->update([
                'title'         => $request->title,
                'author_id'     => $request->author,
                'genre'         => $request->genre,
                'price'         => $request->price,
                'isbn'          => $request->isbn,
                'format'        => $request->format,
            ]);

            bookqty::updateOrCreate(
                ['book_id' => $book->id, 'format' => $request->format],
                ['qty' => $request->qty]
            );

            return redirect()->back()->with('success', 'Book and Quantity Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Some Error Occurred: '.$e->getMessage());
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $deleteBook = book::find($id);
            $deleteBook->delete();
            return redirect()->back()->with('success','Book Deleted SucessFully');
        }catch (Exception $e){
            return redirect()->back()->with('error','Sorry! Could Not Delete.Error::'.$e->getMessage());
        } 
        

    }
}
