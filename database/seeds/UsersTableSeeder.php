<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();       

        $user = new User;
        $user->name = 'Juan - Administrador';
        $user->email = 'pipe@gmail.com';
        $user->password = bcrypt('12345678');
        $user->is_staff = true;
        $user->pin = '0000';
        $user->save();

        $user = new User;
        $user->name = 'Andrea - Facturacion';
        $user->email = 'andrea@gmail.com';
        $user->password = bcrypt('12345678');
        $user->is_staff = true;
        $user->pin = '1234';
        $user->save();

        $user = new User;
        $user->name = 'Paola - Imagenes';
        $user->email = 'paola@gmail.com';
        $user->password = bcrypt('12345678');
        $user->is_staff = true;
        $user->pin = '1425';
        $user->save();

        $user = new User;
        $user->name = 'Diana - Manager';
        $user->email = 'diana@gmail.com';
        $user->password = bcrypt('12345678');
        $user->is_staff = true;
        $user->pin = '4321';

        $user->save();

        $user = new User;
        $user->id = 999;
        $user->name = 'GENERICO';
        $user->email = '';
        $user->password = bcrypt('PORTALES');
        $user->is_staff = true;
        $user->pin = '';
        $user->save();

    }
}
