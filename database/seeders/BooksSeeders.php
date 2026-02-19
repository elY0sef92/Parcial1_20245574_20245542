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
        $path = database_path('data/libros.csv');
        
        if (!file_exists($path)) {
            $this->command->error("El archivo CSV no existe: $path");
            return;
        }
        
        $file = fopen($path, 'r');
        fgetcsv($file);
        
        while ($row = fgetcsv($file)) {
            if (!empty($row[0])) {
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
        
        Book::factory(90)->create();
        $this->command->info('✓ 90 libros adicionales generados automáticamente');
        
        $totalBooks = Book::count();
        $this->command->info("✓ Total de libros en la base de datos: $totalBooks");
    }
}
