<?php

use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_tag')->insert([
            'post_id' => mt_rand(1, App\Post::all()->count()),
            'tag_id' => mt_rand(1,5),
        ]);
    }
}