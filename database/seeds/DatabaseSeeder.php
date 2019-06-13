<?php

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
        // $this->call(UsersTableSeeder::class);
        DB::table('tipousuario')->insert([
        	'descripcion'=>'admin',
        ]);
        DB::table('users')->insert([
        	'nombre'=>'admin',
        	'apellido'=>'admin',
        	'cedula'=>'12345678',
        	'usuario'=>'admin',
        	'direccion'=>'admin',
        	'telefono'=>'091233123',
        	'email'=>'admin@sistema.com',
        	'password'=>bcrypt('12345678'),
        	'idtipoUsuario'=>'1',
        ]);
    }
}
