<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory(1)->admin()->create();
        \App\Models\User::factory(5)->registered_user()->create();
        \App\Models\Car::factory(5)->popular()->create();
        \App\Models\Car::factory(10)->create();
        \App\Models\Car::factory(7)->used()->create();
    }
}
