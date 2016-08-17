<?php

use Illuminate\Database\Seeder;

class PeminjamanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Peminjaman::class,20)->create();
    }
}
