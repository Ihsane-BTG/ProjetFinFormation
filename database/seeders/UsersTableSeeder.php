<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleIds = Role::pluck('id')->all();

        $userData = [
            ['name' => 'John Doe', 'email' => 'john@example.com', 'username' => 'john_doe', 'password' => 'password', 'role_id' => $roleIds[0]],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'username' => 'jane_smith', 'password' => 'password', 'role_id' => $roleIds[1]],
        ];

        foreach ($userData as $data) {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'role_id' => $data['role_id'], 
            ]);
        }

        for ($i = 0; $i < 3; $i++) {
            User::factory()->create(['role_id' => $roleIds[array_rand($roleIds)]]);
        }

    }
}
