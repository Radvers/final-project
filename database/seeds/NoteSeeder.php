<?php

use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notes')->insert([
            [
                'user_id' => 1,
                'title' => 'New note',
                'body' => 'Create new note for debug',
                'color_id' => 1,
                'days_to_delete' => 1,
                'created_at' => date('Y-m-d h:i:s', time())
            ],
            [
                'user_id' => 1,
                'title' => 'another New note',
                'body' => 'Another note from one user',
                'color_id' => 2,
                'days_to_delete' => 1,
                'created_at' => date('Y-m-d h:i:s', time())
            ]
        ]);
    }
}
