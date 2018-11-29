<?php

use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            [
                'name' => 'Blue',
                'class' => 'text-white bg-primary',
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time())
            ],
            [
                'name' => 'Green',
                'class' => 'text-white bg-success',
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time())
            ],
            [
                'name' => 'Red',
                'class' => 'text-white bg-danger',
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time())
            ],
            [
                'name' => 'Yellow',
                'class' => 'text-white bg-warning',
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time())
            ],
            [
                'name' => 'White',
                'class' => 'bg-light',
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time())
            ],
            [
                'name' => 'Black',
                'class' => 'text-white bg-dark',
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time())
            ],
        ]);
    }
}
