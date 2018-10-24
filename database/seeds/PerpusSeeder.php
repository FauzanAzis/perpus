<?php

use Illuminate\Database\Seeder;

class PerpusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Buku::class,30)->create();
    }
}
