<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'Front Office', 'code' => 'FO', 'description' => 'Resepsionis dan check-in/out'],
            ['name' => 'Housekeeping', 'code' => 'HK', 'description' => 'Kebersihan kamar dan area hotel'],
            ['name' => 'Food & Beverage', 'code' => 'F&B', 'description' => 'Restoran dan room service'],
            ['name' => 'Engineering', 'code' => 'ENG', 'description' => 'Maintenance dan perbaikan'],
            ['name' => 'Security', 'code' => 'SEC', 'description' => 'Keamanan hotel'],
            ['name' => 'Sales & Marketing', 'code' => 'S&M', 'description' => 'Penjualan dan pemasaran'],
            ['name' => 'Human Resources', 'code' => 'HR', 'description' => 'SDM dan administrasi'],
            ['name' => 'Finance', 'code' => 'FIN', 'description' => 'Keuangan dan akunting'],
        ];
        
        foreach ($departments as $dept) {
            Department::create($dept);
        }
    }
}
