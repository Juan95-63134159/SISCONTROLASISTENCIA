<?php

namespace Database\Seeders;

use App\Models\Miembro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MiembroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //creara 151 datos de factory
       Miembro::factory()->count(151)->create();
    }
}
