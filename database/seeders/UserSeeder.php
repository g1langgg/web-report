<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $engDept = Department::where('code', 'ENG')->first();
        $foDept = Department::where('code', 'FO')->first();

        $users = [
            [
                'name' => 'Admin Hotel',
                'email' => 'admin@hotel.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'department_id' => null,
            ],
            [
                'name' => 'General Manager',
                'email' => 'gm@hotel.com',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'department_id' => null,
            ],
            [
                'name' => 'Teknisi A',
                'email' => 'teknisi@hotel.com',
                'password' => Hash::make('password'),
                'role' => 'teknisi',
                'department_id' => $engDept?->id,
            ],
            [
                'name' => 'Pelapor A',
                'email' => 'pelapor@hotel.com',
                'password' => Hash::make('password'),
                'role' => 'pelapor',
                'department_id' => $foDept?->id,
            ],
        ];

        foreach ($users as $userData) {
            $role = $userData['role'];
            unset($userData['role']);
            
            $user = User::create($userData);
            $user->assignRole($role);
        }
    }
}
