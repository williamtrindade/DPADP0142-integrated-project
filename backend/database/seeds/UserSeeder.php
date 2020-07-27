<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 70)->create();
        User::create([
            'name' => 'Admin Ponto Web',
            'email' => 'williamtrindade777@gmail.com',
            'password' => Hash::make('laravel'),
        ]);
    }
}
