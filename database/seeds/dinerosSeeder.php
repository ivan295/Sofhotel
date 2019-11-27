<?php

use Illuminate\Database\Seeder;

class dinerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dineros')->insert([
            'dinero_disponible'=>1000,
            
        ]);
          }
}
