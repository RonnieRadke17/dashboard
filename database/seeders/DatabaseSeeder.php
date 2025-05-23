<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Type;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Crear el rol de administrador
        Role::create([
            'name' => 'admin',
        ]);

        // Crear el rol de trabajador
        Role::create([
            'name' => 'worker',
        ]);

        // Insertar tipos de dispositivos
        $types = ['laptop', 'teléfono', 'tablet'];

        foreach ($types as $type) {
            Type::create(['typename' => $type]);
        }

        
        }
}
