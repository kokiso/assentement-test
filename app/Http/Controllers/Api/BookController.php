<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     * http://localhost:8000/api/books
     * method: GET
     */
    public function index()
    {
        $books = Book::all();
        return BookResource::collection($books);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * http://localhost:8000/api/books
     * method: POST
     */
    public function store(Request $request)
    {   
        $request->validate([
            'name'=>'required',
            'isbn'=>'required',
            'value'=>'required'
        ]);
        $books = Book::create($request->all());
        
        return new BookResource($books);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * http://localhost:8000/api/books/{id}
     * method: PUT
     */
    public function update(Request $request, $id)
    {   
        $book = Book::find($id);
        if($book){
            $book->update($request->all());
            return new BookResource($book);
        }else{
            return response()->json([
                'message' => 'Data not exists'
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     * http://localhost:8000/api/books/{id}
     * method: DELETE
     */
    public function destroy($id)
    {
        Book::destroy($id);

        return response()->json([
            'message' => 'Successfully deleted'
        ], 200);

    }
}
