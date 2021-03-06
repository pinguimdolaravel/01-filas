<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name'  => 'Rafael',
            'email' => 'pinguim@dolaravel.com'
        ]);

        User::factory()->count(10000)->create();
    }
}
