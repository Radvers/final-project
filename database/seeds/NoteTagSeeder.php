 <?php

use Illuminate\Database\Seeder;

class NoteTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('note_tag')->insert([
            [
                'note_id' => 1,
                'tag_id' => 1,
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time())
            ],
            [
                'note_id' => 1,
                'tag_id' => 3,
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time())
            ],
            [
                'note_id' => 2,
                'tag_id' => 2,
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time())
            ],
        ]);
    }
}
