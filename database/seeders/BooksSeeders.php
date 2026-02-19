<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Importar 10 libros clásicos del CSV
        $path = database_path('data/libros.csv');
        
        if (!file_exists($path)) {
            $this->command->error("El archivo CSV no existe: $path");
            return;
        }
        
        $file = fopen($path, 'r');
        fgetcsv($file); // Salta encabezados
        
        while ($row = fgetcsv($file)) {
            if (!empty($row[0])) {
                // Convertir status a booleano (true si es "disponible")
                $status = strtolower(trim($row[5])) === 'disponible' ? true : false;
                
                Book::create([
                    'title' => $row[0],
                    'description' => $row[1],
                    'isbn' => $row[2],
                    'total_copies' => (int)$row[3],
                    'available_copies' => (int)$row[4],
                    'status' => $status,
                ]);
            }
        }
        fclose($file);
        $this->command->info('✓ 10 libros clásicos importados desde CSV');
        
        // 2. Generar 90 libros adicionales con el factory
        Book::factory(90)->create();
        $this->command->info('✓ 90 libros adicionales generados automáticamente');
        
        // 3. Validación
        $totalBooks = Book::count();
        $this->command->info("✓ Total de libros en la base de datos: $totalBooks");
    }
}
