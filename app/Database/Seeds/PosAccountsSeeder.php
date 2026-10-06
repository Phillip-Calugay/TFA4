<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PosAccountsSeeder extends Seeder
{
    public function run()
    {
        $createdAt = '2026-09-22 09:00:00';

        $this->db->table('customers')->insertBatch([
            ['full_name' => 'Ana Reyes', 'email' => 'ana.reyes@example.com', 'phone' => '0917 123 4567', 'created_at' => $createdAt],
            ['full_name' => 'Ben Santos', 'email' => 'ben.santos@example.com', 'phone' => '0918 234 5678', 'created_at' => $createdAt],
            ['full_name' => 'Carla Cruz', 'email' => 'carla.cruz@example.com', 'phone' => '0919 345 6789', 'created_at' => $createdAt],
            ['full_name' => 'Daniel Lim', 'email' => 'daniel.lim@example.com', 'phone' => '0920 456 7890', 'created_at' => $createdAt],
            ['full_name' => 'Ella Garcia', 'email' => 'ella.garcia@example.com', 'phone' => '0921 567 8901', 'created_at' => $createdAt],
        ]);

        $this->db->table('users')->insertBatch([
            ['username' => 'admin', 'full_name' => 'Alex Mendoza', 'password' => password_hash('password', PASSWORD_DEFAULT), 'created_at' => $createdAt],
            ['username' => 'cashier1', 'full_name' => 'Carlos Ramos', 'password' => password_hash('password', PASSWORD_DEFAULT), 'created_at' => $createdAt],
            ['username' => 'cashier2', 'full_name' => 'Diane Torres', 'password' => password_hash('password', PASSWORD_DEFAULT), 'created_at' => $createdAt],
            ['username' => 'manager1', 'full_name' => 'Bianca Flores', 'password' => password_hash('password', PASSWORD_DEFAULT), 'created_at' => $createdAt],
            ['username' => 'stock1', 'full_name' => 'Ethan Bautista', 'password' => password_hash('password', PASSWORD_DEFAULT), 'created_at' => $createdAt],
        ]);
    }
}
