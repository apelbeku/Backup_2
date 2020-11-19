<?php

use Illuminate\Database\Seeder;
use App\Model\Article;
use Faker\Factory;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::truncate();

        for ($i=0; $i < 10; $i++) { 
        	$faker = Factory::create();


        	Article::create([
        		'title' => $faker->realtext($maxNbChars = 200, $indexSize = 2),
        		'article' => $faker->text($maxNbChars = 200),
        		'image' => $faker->imageUrl($width = 640, $height = 400),
        	]);
        }
    }
}
