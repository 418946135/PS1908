<?php

use Illuminate\Database\Seeder;

class FileTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = \App\UserUploadedFile::get();

        foreach ($files as $file) {
            for($i = random_int(0, 20); $i < 20; $i += 1) {
                \App\FileTag::create([
                    'user_uploaded_file_id' => $file->id,
                    'name' => 'tag' . $i
                ]);
            }
        }
    }
}
