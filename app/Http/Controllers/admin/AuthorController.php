<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\author;
use Exception;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $authors = author::all();
        return view('admin.author.list',compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          // dd($request->author);
          $request->validate([
            'name'         => 'required|unique:tbl_author,name|string',
        ]);

        try{
            author::create([
                'name'         => $request->name,
            ]);
    
            return redirect()->back()->with('success','Author Created SuccessFully');
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
        $author = author::with(['books'])->findOrFail($id);
        return view('admin.author.show',compact('author'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(author $author)
    {
        //
        return view('admin.author.edit',compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, author $author)
    {
         // dd($request->author);
         $request->validate([
            'name'         => 'required|string',
            ]);
    
            // dd($request);
            try{
    
                $author->update([
                    'name'         => $request->name,
                ]);
        
                return redirect()->back()->with('success','Author Updated SuccessFully');
                // dd('data saved');
            } catch (Exception $e){
                return redirect()->back()->with('error','Some Error Occured:'.$e->getMessage());
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $deleteBook = author::find($id);
            $deleteBook->delete();
            return redirect()->back()->with('success','Book Deleted SucessFully');
        }catch (Exception $e){
            return redirect()->back()->with('error','Sorry! Could Not Delete.Error::'.$e->getMessage());
        } 
        

    }
}
