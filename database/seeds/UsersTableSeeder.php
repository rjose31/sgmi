<?php

use App\User;
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
        //
        User::create([
            'username' => env('INITIAL_USER_ACCOUNT'),
            'name' => env('INITIAL_USER_NAME'),
            'email' => env('INITIAL_USER_EMAIL'),
            'id_carrera' => 1,
            'id_tipo_usuario' => 1,
            'cantidad_clases' => 0,
            'password' => Hash::make(env('INITIAL_USER_PASSWORD')),
        ]);
    }
}
