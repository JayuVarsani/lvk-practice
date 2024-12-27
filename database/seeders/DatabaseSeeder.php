<?php

namespace Database\Seeders;

use App\Models\Moderator;
use App\Models\PurchaseOrder;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Moderator::factory(100)->create();
        PurchaseOrder::factory(10000)->create();
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'type' => 'admin',
            'password' => '123',
        ]);
        User::factory()->create([
            'name' => 'jayesh',
            'email' => 'varsanij638@gmail.com',
            'type' => 'admin',
            'password' => '123',
        ]);

    }
}
