<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoanRequest;
use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoanController extends Controller
{
   
    public function store(StoreLoanRequest $request)
    {
        $book = Book::findOrFail($request->book_id);
        
        if ($book->available_copies <= 0) {
            return response()->json([
                'message' => 'No hay copias disponibles de este libro',
                'libro' => $book->title,
                'copias_disponibles' => $book->available_copies,
            ], 422);
        }
        
        $loan = Loan::create([
            'nombre' => $request->nombre,
            'fecha_hora_prestamo' => now(),
            'book_id' => $book->id,
        ]);
        
        $book->available_copies--;
        
        if ($book->available_copies === 0) {
            $book->status = false;
        }
        
        $book->save();
        
        return response()->json([
            'message' => 'Préstamo registrado exitosamente',
            'loan_id' => $loan->id,
            'libro' => $book->title,
            'copias_disponibles_ahora' => $book->available_copies,
        ], 201);
    }

    
    public function devolucion($loanId)
    {
        
        $loan = Loan::findOrFail($loanId);
        
        if ($loan->isDevoluto()) {
            return response()->json([
                'message' => 'Este préstamo ya fue devuelto',
                'fecha_devolucion_anterior' => $loan->fecha_hora_devolucion,
            ], 422);
        }
        
        $loan->fecha_hora_devolucion = now();
        $loan->save();
        
        $book = $loan->book;
        $book->available_copies++;
        
        if (!$book->status) {
            $book->status = true;
        }
        
        $book->save();
        
        return response()->json([
            'message' => 'Devolución registrada exitosamente',
            'loan_id' => $loan->id,
            'libro' => $book->title,
            'copias_disponibles_ahora' => $book->available_copies,
            'fecha_devolucion' => $loan->fecha_hora_devolucion,
        ], 200);
    }
}
