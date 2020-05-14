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
       $categories = ['business','entertainment','general','health','science','sports','technology'];

        foreach ($categories as $cat){

            DB::table('telegram_categories')->insert([
                'name' => $cat
            ]);
        }
    }
}
