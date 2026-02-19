<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Book::query();
        
        
        if ($request->has('titulo')) {
            $query->where('title', 'like', '%' . $request->input('titulo') . '%');
        }
        
        
        if ($request->has('isbn')) {
            $query->where('isbn', 'like', '%' . $request->input('isbn') . '%');
        }
        
        
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }
        
        $books = $query->get();
        
        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
