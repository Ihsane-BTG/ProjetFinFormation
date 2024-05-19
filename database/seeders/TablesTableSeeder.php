<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tables')->insert([
            [
                'name' => 'Table 1',
                'capacity' => 4,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Table 2',
                'capacity' => 2,
                'available' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Table 3',
                'capacity' => 6,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Table 4',
                'capacity' => 8,
                'available' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Table 5',
                'capacity' => 10,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
