<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marcas = [
            ['nome' => 'Honda'],
            ['nome' => 'Toyota'],
            ['nome' => 'Chevrolet'],
            ['nome' => 'Ford'],
            ['nome' => 'Mercedes'],
            ['nome' => 'BMW']
        ];

        Marca::insert($marcas);
    }
}
