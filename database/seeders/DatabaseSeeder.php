<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::create(
            ['name'=>'Administrator']
        );
        Role::create(
            ['name'=>'Manager']
        );
        Role::create(
            ['name'=>'Blogger']
        );
        Role::create(
            ['name'=>'Shop']
        );
        Role::create(
            ['name'=>'Customer']
        );
    }
}
