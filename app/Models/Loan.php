<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $table = 'Loans';
    
    protected $fillable = [
        'nombre',
        'fecha_hora_prestamo',
        'fecha_hora_devolucion',
        'book_id',
    ];
    
    protected $casts = [
        'fecha_hora_prestamo' => 'datetime',
        'fecha_hora_devolucion' => 'datetime',
    ];
    
    
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
    
   
    public function isDevoluto(): bool
    {
        return $this->fecha_hora_devolucion !== null;
    }
}
