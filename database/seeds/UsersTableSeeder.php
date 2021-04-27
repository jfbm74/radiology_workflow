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
        $user->rol = 0;
        $user->pin = '0000';
        $user->save();

        $user = new User;
        $user->name = 'Estacion RX';
        $user->email = 'estacionrayosx@rxdent.co';
        $user->password = bcrypt('12345678');
        $user->is_staff = true;
        $user->rol = 5;
        $user->pin = '8888';
        $user->save();

        $user = new User;
        $user->name = 'Estacion Fotos';
        $user->email = 'estacionfotos@rxdent.co';
        $user->password = bcrypt('12345678');
        $user->is_staff = true;
        $user->rol = 5;
        $user->pin = '9999';
        $user->save();

        $user = new User;
        $user->name = 'Estacion Periapical';
        $user->email = 'estacionperiapical@rxdent.co';
        $user->password = bcrypt('12345678');
        $user->is_staff = true;
        $user->rol = 5;
        $user->pin = '9999';
        $user->save();

        $user = new User;
        $user->name = 'Andrea - Facturacion';
        $user->email = 'andrea@gmail.com';
        $user->password = bcrypt('12345678');
        $user->is_staff = true;
        $user->rol = 5;
        $user->pin = '1234';
        $user->save();

        $user = new User;
        $user->name = 'Paola - Imagenes';
        $user->email = 'paola@gmail.com';
        $user->password = bcrypt('12345678');
        $user->is_staff = true;
        $user->rol = 5;
        $user->pin = '1111';
        $user->save();

        $user = new User;
        $user->name = 'Dina - Imagenes';
        $user->email = 'paola@gmail.com';
        $user->password = bcrypt('12345678');
        $user->is_staff = true;
        $user->rol = 5;
        $user->pin = '2222';
        $user->save();

        $user = new User;
        $user->name = 'Khaterine - Imagenes';
        $user->email = 'paola@gmail.com';
        $user->password = bcrypt('12345678');
        $user->is_staff = true;
        $user->rol = 5;
        $user->pin = '3333';
        $user->save();

        $user = new User;
        $user->name = 'Jenny - Imagenes';
        $user->email = 'paola@gmail.com';
        $user->password = bcrypt('12345678');
        $user->is_staff = true;
        $user->rol = 5;
        $user->pin = '4444';
        $user->save();


        $user = new User;
        $user->name = 'Diana Quintero- Manager';
        $user->email = 'diana@gmail.com';
        $user->password = bcrypt('12345678');
        $user->is_staff = true;
        $user->rol = 0;
        $user->pin = '4321';

        $user->save();

        $user = new User;
        $user->id = 999;
        $user->name = 'GENERICO';
        $user->email = '';
        $user->password = bcrypt('PORTALES');
        $user->is_staff = false;
        $user->pin = '';
        $user->save();

        $user->save();

        $user = new User;
        $user->id = 369;
        $user->name = 'NATURAL SMILE';
        $user->legal_id = "901077262";
        $user->email = 'natural@smile.com';
        $user->password = bcrypt('12345678');
        $user->is_staff = false;
        $user->pin = '';
        $user->save();

        $user = new User;
        $user->id = 11;
        $user->name = 'USUARIO ANONIMO (NO BORRAR)';
        $user->legal_id = "";
        $user->email = 'usuariogen@rxdent.co';
        $user->password = bcrypt('123asdferASDA$(%$');
        $user->is_staff = false;
        $user->pin = '';
        $user->save();

    }
}
