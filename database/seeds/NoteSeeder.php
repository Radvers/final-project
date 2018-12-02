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
                'title' => 'Lorem ipsum',
                'body' => 'Lorem ipsum dolor sit amet',
                'color_id' => 1,
                'days_to_delete' => 1,
                'created_at' => date('Y-m-d h:i:s', time())
            ],
            [
                'user_id' => 1,
                'title' => 'consectetur adipiscing elit',
                'body' => 'sed do eiusmod tempor',
                'color_id' => 2,
                'days_to_delete' => 1,
                'created_at' => date('Y-m-d h:i:s', time())
            ],
            [
                'user_id' => 1,
                'title' => 'Sed ut perspiciatis',
                'body' => 'unde omnis iste natus error',
                'color_id' => 3,
                'days_to_delete' => 15,
                'created_at' => date('Y-m-d h:i:s', time())
            ],
            [
                'user_id' => 1,
                'title' => 'sit voluptatem accusantium',
                'body' => 'doloremque laudantium, totam rem',
                'color_id' => 4,
                'days_to_delete' => 30,
                'created_at' => date('Y-m-d h:i:s', time())
            ],
            [
                'user_id' => 1,
                'title' => 'aperiam eaque',
                'body' => 'quae ab illo inventore veritatis et',
                'color_id' => 5,
                'days_to_delete' => 15,
                'created_at' => date('Y-m-d h:i:s', time())
            ],
            [
                'user_id' => 1,
                'title' => 'quasi architecto',
                'body' => 'ipsa beatae vitae dicta sunt, explicabo',
                'color_id' => 6,
                'days_to_delete' => 30,
                'created_at' => date('Y-m-d h:i:s', time())
            ],
            [
                'user_id' => 1,
                'title' => 'New note',
                'body' => 'Some interesting text here',
                'color_id' => 3,
                'days_to_delete' => 1,
                'created_at' => date('Y-m-d h:i:s', time())
            ],
        ]);
    }
}
