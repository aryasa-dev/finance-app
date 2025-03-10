<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name'     => 'Arya',
            'email'    => 'arya@example.com',
            'password' => bcrypt('arya123'),
        ]);

        Category::factory()
            ->count(10)
            ->create();
            
        Transaction::factory()
            ->count(50)
            ->create();
    }
}
