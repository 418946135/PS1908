<?php

use Illuminate\Database\Seeder;

class UserUploadedFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::get();
        $faker =  Faker\Factory::create();;

        $iconFolder = 'images/icons/';
        $iconNames = [
            'daredevil',
            'deadpool',
            'ironman',
            'hulk',
            'groot',
            'joker',
            'spiderman',
            'nick-fury',
            'thor',
            'wolverine',
        ];

        foreach ($users as $user) {
            for ($i = 0; $i < 30; $i++) {
                if ($i % 2 == 0) {
                    $fileSuffix = 'xlxs';
                }
                else {
                    $fileSuffix = 'csv';
                }
                \App\UserUploadedFile::create([
                    'user_id'   =>  $user->id,
                    'folder'    =>  '/var/www/filehero/storage/public',
                    'name'      =>  "file($user->email)-" . $i . '.' .$fileSuffix,
                    'size'      =>  random_int(10, 1000),
                    'icon'      =>  $iconFolder . $iconNames[random_int(0, 9)] . '.png',
                    'type'      =>  $fileSuffix,
                    'customer_name'     =>  $faker->unique()->name,
                    'customer_number'   =>  $faker->unique()->isbn13,
                    'invoice_date'      =>  $faker->date(),
                    'invoice_number'    =>  $faker->unique()->isbn10,
                    'service_type'      =>  $faker->text(50),
                    'amount'    =>  $faker->numberBetween(100, 500000)
                ]);
            }
        }
    }
}
